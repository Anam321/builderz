<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsnav extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

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

        $data['metaTitle'] = 'Whatsapp Navigasi';
        $data['componen'] = $this->componen();


        $data['conten'] = 'admin/whatsnav';
        $data['aboutData'] = $this->db->get_where('whatsap_navigasi', ['id' => 1])->row_array();

        $this->load->view('main', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $data = array(
                'text_title' => $this->input->post('text_title'),
                'no' => $this->input->post('no'),
                'pesan' => $this->input->post('pesan'),

            );
            $r = $this->db->update('whatsap_navigasi', $data, array('id' => 1));
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
