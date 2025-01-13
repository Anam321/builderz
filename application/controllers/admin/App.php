<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Apps_m', 'models');
        is_logged_in();
        role_superadmin();
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
        $data['metaTitle'] = 'Set App';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/app';
        $this->load->view('main', $data);
    }

    public function get_data_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById('set_app', $id);
            echo json_encode($data);
        }
    }
    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_FILES["favicon"]["name"])) {
                $config['upload_path'] = './assets/upload/img';
                $config['file_name'] = 'favicon' . time();
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['overwrite'] = true;
                $config['max_size'] = 1024; // 1MB

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('favicon')) {
                    $res['status'] = '01';
                    $res['type'] = 'error';
                    $res['mess'] = 'Upload error. double check the photo file or photo size!';

                    return ($res);
                } else {
                    $image_data = $this->upload->data();
                    //direktori file
                    $path = './assets/upload/img/';
                    $filename = $this->input->post('old_favicon');
                    //hapus file
                    if (file_exists($path . $filename)) {
                        unlink($path . $filename);
                    }

                    $data = array(
                        'favicon' => $image_data['file_name'],
                        'title' => $this->input->post('title'),
                        'nama_web' => $this->input->post('nama_web'),
                        'tentang' => $this->input->post('tentang'),
                        'notlp' => $this->input->post('notlp'),
                        'email' => $this->input->post('email'),
                        'lokasi' => $this->input->post('lokasi'),
                        'map' => $this->input->post('map'),
                        'alamat' => $this->input->post('alamat'),
                        'kota' => $this->input->post('kota'),
                        'provinsi' => $this->input->post('provinsi'),
                        'pos' => $this->input->post('pos'),
                        'site' => $this->input->post('site'),
                        'keyword' => $this->input->post('keyword'),
                    );
                }
            } else {
                $data = array(
                    'title' => $this->input->post('title'),
                    'nama_web' => $this->input->post('nama_web'),
                    'tentang' => $this->input->post('tentang'),
                    'notlp' => $this->input->post('notlp'),
                    'email' => $this->input->post('email'),
                    'lokasi' => $this->input->post('lokasi'),
                    'map' => $this->input->post('map'),
                    'alamat' => $this->input->post('alamat'),
                    'kota' => $this->input->post('kota'),
                    'provinsi' => $this->input->post('provinsi'),
                    'pos' => $this->input->post('pos'),
                    'site' => $this->input->post('site'),
                    'keyword' => $this->input->post('keyword'),

                );
            }
            $update = $this->models->update(array('id' => $this->input->post('id')), $data, 'set_app');
            echo json_encode($update);
        }
    }
    public function upload()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!empty($_FILES["logo"]["name"])) {
                $config['upload_path'] = './assets/upload/img/';
                $config['file_name'] = 'logo' . time();
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['overwrite'] = true;
                $config['max_size'] = 1024; // 1MB

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('logo')) {
                    $r = array(
                        'status' => '01',
                        'type' => 'error',
                        'mess' => 'Files must not exceed 1 MB',
                    );
                    echo json_encode($r);
                } else {

                    $image_data = $this->upload->data();
                    //direktori file
                    $path = './assets/upload/img/';

                    $filename = $this->input->post('old_logo');
                    if (file_exists($path . $filename)) {
                        unlink($path . $filename);
                    }

                    $data = array(

                        'logo' => $image_data['file_name'],
                    );

                    $update = $this->models->updatefile(array('id' => $this->input->post('id')), $data);
                    echo json_encode($update);
                }
            }
        }
    }
}
