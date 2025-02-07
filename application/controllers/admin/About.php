<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
        $data['metaTitle'] = 'About';
        $data['componen'] = $this->componen();


        $data['conten'] = 'admin/about';
        $data['aboutData'] = $this->db->get_where('s_about', ['id' => 1])->row_array();

        $this->load->view('main', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $data = array(
                'heading_1' => $this->input->post('heading_1'),
                'heading_2' => $this->input->post('heading_2'),
                'text' => $this->input->post('text'),

            );
            $r = $this->db->update('s_about', $data, array('id' => 1));
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

    public function upload()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $config['upload_path'] = './assets/upload/img';
            $config['file_name'] = 'images' . time();
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
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

                $filename = $this->input->post('old_images');
                file_exists('./assets/upload/img/' . $filename);
                $data = array(
                    'images' => $image_data['file_name'],
                );
                $r = $this->db->update('s_about', $data, array('id' => 1));
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
}
