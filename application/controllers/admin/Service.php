<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_m', 'models');
        is_logged_in();
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
        $data['metaTitle'] = 'Service';
        $data['componen'] = $this->componen();


        $data['conten'] = 'admin/service/index';
        $data['aboutData'] = $this->db->get_where('s_about', ['id' => 1])->row_array();

        $this->load->view('main', $data);
    }
    public function form()
    {
        $data['app'] = $this->db->get_where('set_app', ['id' => 1])->row_array();
        $data['metaTitle'] = 'Form Service';
        $data['componen'] = $this->componen();

        $data['conten'] = 'admin/service/form';
        $this->load->view('main', $data);
    }
    public function edit($x)
    {
        $data['field'] = $this->db->get_where('s_service', ['id' => $x])->row_array();
        $data['metaTitle'] = 'Edit Service';
        $data['componen'] = $this->componen();

        $data['conten'] = 'admin/service/edit';
        $this->load->view('main', $data);
    }
    function dataTables()
    {
        $table = 's_service'; //nama tabel dari database
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
            if ($field->file == '') {
                $file = '<i class="fas fa-times me-2"></i>Not File</button>';
            } else {
                $file = '<i class="fas fa-check-square me-2"></i>Publikasikan</button>' . $field->file;
            }
            $row[] = $file;

            $row[] = '<button  onclick="addfile(' . $field->id . ')" type="button" class="btn btn-info btn-sm "><i class="fas fa-file-alt me-2"></i>Add File</button>
                       <a href="' . base_url('app-admin/service/edit/') . '' . $field->id . '"> <button type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button></a>
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
                if ($this->input->post('seo_title') == '') {
                    $title = $this->input->post('title');
                } else {
                    $title = $this->input->post('seo_title');
                }

                if ($hasil['file_name'] == '') {
                    $data = array(

                        'slug' => $slg,
                        'title' => $this->input->post('title'),
                        'body' => $this->input->post('body'),
                        'seo_title' => $title,
                        'seo_deskripsi' => $this->input->post('seo_deskripsi'),
                        'seo_keyword' => $this->input->post('seo_keyword'),

                    );
                } else {
                    $data = array(
                        'images' => $hasil['file_name'],
                        'slug' => $slg,
                        'title' => $this->input->post('title'),
                        'body' => $this->input->post('body'),
                        'seo_title' => $title,
                        'seo_deskripsi' => $this->input->post('seo_deskripsi'),
                        'seo_keyword' => $this->input->post('seo_keyword'),
                    );
                }
            }
            // print_r($data);
            $response = $this->models->PostData('s_service', $data);
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
            if ($this->input->post('seo_title') == '') {
                $title = $this->input->post('title');
            } else {
                $title = $this->input->post('seo_title');
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
                    'body' => $this->input->post('body'),
                    'seo_title' => $title,
                    'seo_deskripsi' => $this->input->post('seo_deskripsi'),
                    'seo_keyword' => $this->input->post('seo_keyword'),
                );
            } else {
                $data = array(
                    'slug' => $slg,
                    'title' => $this->input->post('title'),
                    'body' => $this->input->post('body'),
                    'seo_title' => $title,
                    'seo_deskripsi' => $this->input->post('seo_deskripsi'),
                    'seo_keyword' => $this->input->post('seo_keyword'),
                );
            }

            // print_r($data);
            $update = $this->models->update(array('id' => $this->input->post('id')), $data, 's_service');
            echo json_encode($update);
        }
    }
    public function upload()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $config['upload_path'] = './assets/upload/file';
            $config['file_name'] = 'images' . time();
            $config['allowed_types'] = 'pdf|jpg|jpeg|png|webp';
            $config['overwrite'] = true;
            $config['max_size'] = 1024; // 1MB

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                $r = array(
                    'status' => '01',
                    'type' => 'error',
                    'mess' => 'Files must not exceed 1 MB',
                );
                echo json_encode($r);
            } else {

                $image_data = $this->upload->data();

                $qr = $this->db->get_where('s_service', ['id' => $this->input->post('id')])->row_array();
                $filename =  $qr['file'];
                if ($filename == true) {
                    file_exists('./assets/upload/file/' . $filename);
                }

                $data = array(
                    'file' => $image_data['file_name'],
                );
                $r = $this->db->update('s_service', $data, array('id' => $this->input->post('id')));
                if ($r) {
                    $res['status'] = '00';
                    $res['type'] = 'success';
                    $res['mess'] = 'Success Update Data';
                } else {
                    $res['status'] = '01';
                    $res['type'] = 'warning';
                    $res['mess'] = 'Error Update Data, please try again...';
                }

                echo json_encode($res);
            }
        }
    }
    public function delete_data($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $q = $this->db->query("select images from s_service where id = '$id'")->row();
            $foto = $q->images;

            // var_dump($foto);

            $path = './assets/upload/post/';
            // hapus file
            if (file_exists($path . $foto)) {
                unlink($path . $foto);
            }

            echo $this->models->delete('s_service', $id);
        }
    }
}
