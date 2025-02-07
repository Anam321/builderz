<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Post_m', 'models');
        check_user_role([1, 3]);
    }
    function componen()
    {
        $data['header'] = 'component/admin/header';
        $data['navbar'] = 'component/admin/navbar';
        $data['footer'] = 'component/admin/footer';
        return $data;
    }
    public function index()
    {
        $data['app'] = $this->db->get_where('set_app', ['id' => 1])->row_array();
        $data['metaTitle'] = 'Post List';
        $data['componen'] = $this->componen();


        $data['conten'] = 'admin/post/index';
        $this->load->view('main', $data);
    }
    public function form()
    {

        $data['metaTitle'] = 'Tambah Post';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/post/form';
        $data['kategori'] = $this->db->get('post_category')->result();
        $this->load->view('main', $data);
    }

    public function form_kategori()
    {

        $data['metaTitle'] = 'Tambah Kategori';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/post/form_kategori';
        $this->load->view('main', $data);
    }
    public function edit($id)
    {

        $data['metaTitle'] = 'Edit Post';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/post/edit';
        $data['kategori'] = $this->db->get('post_category')->result();
        $data['filed'] = $this->models->getByid('post', 'id', $id);
        $this->load->view('main', $data);
    }
    public function editkategori($id)
    {

        $data['metaTitle'] = 'Edit Post';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/post/editkategori';

        $data['filed'] = $this->models->getByid('post_category', 'id', $id);
        $this->load->view('main', $data);
    }
    public function comment()
    {

        $data['metaTitle'] = 'Blog Commment';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/post/coment';

        $this->load->view('main', $data);
    }

    public function kategori()
    {

        $data['metaTitle'] = 'Kategori Post';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/post/kategori';

        $this->load->view('main', $data);
    }

    function dataTables()
    {
        $table = 'post'; //nama tabel dari database
        $column_order = array(null, 'images', 'title', null, null); //field yang ada di table user
        $column_search = array('images', 'title'); //field yang diizin untuk pencarian 
        $order = array('id' => 'DESC'); // default order 

        $list = $this->models->get_datatables($table, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<img class="flex-shrink-0" src="' . base_url() . 'assets/upload/post/' . $field->images . '" alt="" style="height: 80px;">';
            $row[] = $field->title;
            $row[] = date_indo($field->date);

            $row[] = '  <a target="_blank" href="' . base_url('blog/') . '' . $field->slug . '"> <button type="button" class="btn btn-info btn-sm "><i class="fa fa-eye me-2"></i>View</button></a>
                       <a href="' . base_url('app-admin/post/edit/') . '' . $field->id . '"> <button type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button></a>
                        <button onclick="deletes(' . $field->id . ')" type="button" class="btn btn-danger btn-sm "><i class="fa fa-trash me-2"></i>Delete</button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->models->count_all($table),
            "recordsFiltered" => $this->models->count_filtered($table, $column_order, $column_search, $order),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function dataTablesKategori()
    {
        $table = 'post_category'; //nama tabel dari database
        $column_order = array(null, 'category', 'slug', null, null); //field yang ada di table user
        $column_search = array('category', 'slug'); //field yang diizin untuk pencarian 
        $order = array('id' => 'DESC'); // default order 

        $list = $this->models->get_datatables($table, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $field->category;
            $row[] = $field->slug;

            $row[] = '  
                       <a href="' . base_url('app-admin/post/kategori/edit/') . '' . $field->id . '"> <button type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button></a>
                        <button onclick="deletes(' . $field->id . ')" type="button" class="btn btn-danger btn-sm "><i class="fa fa-trash me-2"></i>Delete</button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->models->count_all($table),
            "recordsFiltered" => $this->models->count_filtered($table, $column_order, $column_search, $order),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function PostData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $t = htmlspecialchars($this->input->post('title'));
            $c = array(' ');
            $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
            $s = str_replace($d, '', $t); // Hilangkan karakter yang telah disebutkan di array $d
            $slug = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua

            $sql = $this->db->query("SELECT slug FROM post where slug='$slug'");
            $cek_data = $sql->num_rows();

            if ($cek_data > 0) {
                $r = array(
                    'status' => '01',
                    'type' => 'error',
                    'mess' => 'Data Blog already exists, the url must be unique!',
                );
                echo json_encode($r);
            } else {
                $app = $this->models->getByid('set_app', 'id', 1);
                $config['upload_path'] = './assets/upload/post/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['file_name'] = strtolower($slug);
                $config['overwrite'] = true;
                $config['max_size'] = 1020; // 1MB

                $this->load->library('upload', $config);
                $this->upload->do_upload('images');
                $hasil = $this->upload->data();

                $config['source_image'] = 'asset/upload/post/' . $hasil['file_name'];
                $config['wm_text'] = $app['nama_web'];
                $config['wm_type'] = 'text';
                $config['wm_font_path'] = './system/fonts/texb.ttf';
                $config['wm_font_size'] = '26';
                $config['wm_font_color'] = 'ffffff';
                $config['wm_vrt_alignment'] = 'middle';
                $config['wm_hor_alignment'] = 'center';
                $config['wm_padding'] = '20';
                $this->load->library('image_lib', $config);
                $this->image_lib->watermark();


                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->input->post('slug') == '') {
                    $slg = $slug;
                } else {
                    $slg = $this->input->post('slug');
                }
                if ($this->input->post('meta_title') == '') {
                    $title = $this->input->post('title');
                } else {
                    $title = $this->input->post('meta_title');
                }

                if ($hasil['file_name'] == '') {
                    $data = array(

                        'slug' => $slg,
                        'title' => $this->input->post('title'),
                        'categori' => $this->input->post('categori'),
                        'body' => $this->input->post('body'),
                        'video' => $this->input->post('video'),
                        'meta_title' => $title,
                        'meta_deskripsi' => $this->input->post('meta_deskripsi'),
                        'meta_keyword' => $this->input->post('meta_keyword'),
                        'date' => date('Y-m-d H:i:s'),
                        // 'publik' => 1,
                    );
                } else {
                    $data = array(
                        'images' => $hasil['file_name'],
                        'slug' => $slg,
                        'title' => $this->input->post('title'),
                        'categori' => $this->input->post('categori'),
                        'body' => $this->input->post('body'),
                        'video' => $this->input->post('video'),
                        'meta_title' => $title,
                        'meta_deskripsi' => $this->input->post('meta_deskripsi'),
                        'meta_keyword' => $this->input->post('meta_keyword'),
                        'date' => date('Y-m-d H:i:s'),
                        // 'publik' => 1,
                    );
                }
            }
            // print_r($data);
            $response = $this->models->PostData('post', $data);
            echo json_encode($response);
        }
    }

    public function PostKategori()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $t = htmlspecialchars($this->input->post('category'));
            $c = array(' ');
            $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
            $s = str_replace($d, '', $t); // Hilangkan karakter yang telah disebutkan di array $d
            $slug = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua

            $sql = $this->db->query("SELECT slug FROM post_category where slug='$slug'");
            $cek_data = $sql->num_rows();

            if ($cek_data > 0) {
                $r = array(
                    'status' => '01',
                    'type' => 'error',
                    'mess' => 'Data Kategori already exists, the url must be unique!',
                );
                echo json_encode($r);
            } else {
                $data = array(
                    'slug' => $slg,
                    'category' => $this->input->post('category'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    // 'publik' => 1,
                );
            }
            // print_r($data);
            $response = $this->models->PostData('post_category', $data);
            echo json_encode($response);
        }
    }
    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $t = htmlspecialchars($this->input->post('title'));
            $c = array(' ');
            $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
            $s = str_replace($d, '', $t); // Hilangkan karakter yang telah disebutkan di array $d
            $slug = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua

            if ($this->input->post('slug') == '') {
                $slg = $slug;
            } else {
                $slg = $this->input->post('slug');
            }
            if ($this->input->post('meta_title') == '') {
                $title = $this->input->post('title');
            } else {
                $title = $this->input->post('meta_title');
            }
            if (!empty($_FILES["images"]["name"])) {
                $app = $this->models->getByid('set_app', 'id', 1);
                $config['upload_path'] = './assets/upload/post/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['file_name'] = strtolower($slug);
                // $config['overwrite'] = true;
                $config['max_size'] = 1020; // 1MB

                $this->load->library('upload', $config);
                $this->upload->do_upload('images');
                $hasil = $this->upload->data();

                $config['source_image'] = 'asset/upload/post/' . $hasil['file_name'];
                $config['wm_text'] = $app['nama_web'];
                $config['wm_type'] = 'text';
                $config['wm_font_path'] = './system/fonts/texb.ttf';
                $config['wm_font_size'] = '26';
                $config['wm_font_color'] = 'ffffff';
                $config['wm_vrt_alignment'] = 'middle';
                $config['wm_hor_alignment'] = 'center';
                $config['wm_padding'] = '20';
                $this->load->library('image_lib', $config);
                $this->image_lib->watermark();

                if ($this->input->post('old_images') == true) {
                    $path = './assets/upload/post/';
                    $filename = $this->input->post('old_images');
                    if (file_exists($path . $filename)) {
                        unlink($path . $filename);
                    }
                }


                $data = array(
                    'images' => $hasil['file_name'],
                    'slug' => $slg,
                    'title' => $this->input->post('title'),
                    'categori' => $this->input->post('categori'),
                    'body' => $this->input->post('body'),
                    'video' => $this->input->post('video'),
                    'meta_title' => $title,
                    'meta_deskripsi' => $this->input->post('meta_deskripsi'),
                    'meta_keyword' => $this->input->post('meta_keyword'),

                );
            } else {
                $data = array(

                    'slug' => $slg,
                    'title' => $this->input->post('title'),
                    'categori' => $this->input->post('categori'),
                    'body' => $this->input->post('body'),
                    'video' => $this->input->post('video'),
                    'meta_title' => $title,
                    'meta_deskripsi' => $this->input->post('meta_deskripsi'),
                    'meta_keyword' => $this->input->post('meta_keyword'),

                );
            }

            // print_r($data);
            $update = $this->models->update(array('id' => $this->input->post('id')), $data, 'post');
            echo json_encode($update);
        }
    }
    public function updateKategori()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $t = htmlspecialchars($this->input->post('category'));
            $c = array(' ');
            $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
            $s = str_replace($d, '', $t); // Hilangkan karakter yang telah disebutkan di array $d
            $slug = strtolower(str_replace($c, '-', $s));
            if ($this->input->post('slug') == '') {
                $slg = $slug;
            } else {
                $slg = $this->input->post('slug');
            }
            $data = array(
                'slug' => $slg,
                'category' => $this->input->post('category'),
                'deskripsi' => $this->input->post('deskripsi'),
                // 'publik' => 1,
            );

            // print_r($data);
            $update = $this->models->update(array('id' => $this->input->post('id')), $data, 'post_category');
            echo json_encode($update);
        }
    }
    public function switching($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $q = $this->db->get_where('pages_blog', ['id' => $id])->row_array();
            $status = $q['publik'];
            if ($status == 1) {
                $d_status = 0;
            } else {
                $d_status = 1;
            }
            $data = array(
                'publik' => $d_status,
            );
        }
        $update = $this->models->switch($id, $data);
        echo json_encode($update);
    }
    public function delete_data($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $q = $this->db->query("select images from post where id = '$id'")->row();
            $foto = $q->images;

            // var_dump($foto);

            $path = './assets/upload/post/';
            // hapus file
            if (file_exists($path . $foto)) {
                unlink($path . $foto);
            }

            echo $this->models->delete('post', $id);
        }
    }
    public function delete_kategori($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo $this->models->delete('post_category', $id);
        }
    }
}
