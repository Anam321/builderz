<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Portfolio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Portfolio_m', 'models');
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

        $data['metaTitle'] = 'Data Portfolio';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/portfolio/index';

        $this->load->view('main', $data);
    }

    public function form()
    {

        $data['metaTitle'] = 'Tambah Data Portfolio';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/portfolio/form';
        $data['projek'] = $this->models->select_projek('ref_projek');
        $this->load->view('main', $data);
    }
    public function edit($id)
    {


        $data['metaTitle'] = 'Edit Data Portfolio';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/portfolio/edit';
        $data['projek'] = $this->models->select_projek('ref_projek');
        $data['filed'] = $this->models->getByid('pages_portfolio', 'id', $id);
        $this->load->view('main', $data);
    }

    function dataTables()
    {
        $list = $this->models->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $projek = $this->db->get_where('ref_projek', ['id_projek' => $field->projek])->row_array();
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<img class="flex-shrink-0" src="' . base_url() . 'assets/upload/img/' . $field->foto . '" alt="" style="height: 80px;">';
            $row[] = $field->title;
            $row[] = $projek['nama_client'];
            $row[] = $projek['alamat'];
            $row[] = ' <a target="_blank" href="' . base_url('project/') . '' . $field->slug . '"> <button type="button" class="btn btn-info btn-sm "><i class="fa fa-eye me-2"></i>View</button></a>
                       <a href="' . base_url('admin/portfolio/edit/') . '' . $field->id . '"> <button type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button></a>
                        <button onclick="deletes(' . $field->id . ')" type="button" class="btn btn-danger btn-sm "><i class="fa fa-trash me-2"></i>Delete</button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->models->count_all(),
            "recordsFiltered" => $this->models->count_filtered(),
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
            $projek = $this->input->post('id_projek');
            $sql = $this->db->query("SELECT slug FROM s_portfolio where slug='$slug'");
            $cek_data = $sql->num_rows();
            $projeksql = $this->db->query("SELECT projek FROM s_portfolio where projek='$projek'");
            $cek_projek = $projeksql->num_rows();

            if ($cek_data > 0) {
                $r = array(
                    'status' => '01',
                    'type' => 'error',
                    'mess' => 'Data title already exists, the url must be unique!',
                );
                echo json_encode($r);
            } else {

                if ($cek_projek > 0) {
                    $r = array(
                        'status' => '01',
                        'type' => 'error',
                        'mess' => 'Data projek already exists, the url must be unique!',
                    );
                    echo json_encode($r);
                } else {
                    $config['upload_path'] = './assets/upload/img/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                    $config['file_name'] = strtolower($slug);
                    $config['overwrite'] = true;
                    $config['max_size'] = 1020; // 1MB

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('images')) {
                        $res['status'] = '01';
                        $res['type'] = 'error';
                        $res['mess'] = 'Upload error. double check the photo file or photo size!';
                        return ($res);
                    } else {
                        $image_data = $this->upload->data();
                        $data = array(
                            'foto' => $image_data['file_name'],
                            'slug' => strtolower($slug),
                            'title' => $this->input->post('title'),
                            'body' => $this->input->post('body'),

                            'meta_deskripsi' => $this->input->post('meta_deskripsi'),
                            // // 'video' => $this->input->post('video'),
                            'meta_keyword' => $this->input->post('meta_keyword'),
                            'projek' => $this->input->post('id_projek'),
                        );
                        // print_r($data);
                        $response = $this->models->PostData($data);
                        echo json_encode($response);
                    }
                }
            }
        }
    }
    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $update = $this->models->update(array('id' => $this->input->post('id')));
            echo json_encode($update);
        }
    }

    public function delete_data($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $this->models->delete($id);
        }
    }
}
