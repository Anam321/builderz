<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages_seo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ncp_m', 'models');
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
        $data['metaTitle'] = 'Pages Seo';
        $data['componen'] = $this->componen();


        $data['conten'] = 'admin/pages_seo';
        $data['aboutData'] = $this->db->get_where('s_about', ['id' => 1])->row_array();

        $this->load->view('main', $data);
    }

    public function get_data_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById($id);
            echo json_encode($data);
        }
    }

    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $update = $this->models->update(array('pages' => $this->input->post('pages')));
            echo json_encode($update);
        }
    }

    function dataTables()
    {
        $list = $this->models->get_datatables();
        $data = array();

        foreach ($list as $field) {

            $row = array();
            $row[] = '<input class="check" type="checkbox" onclick="getData(' . $field->id . ');">';
            $row[] = '<img class="flex-shrink-0" src="' . base_url() . 'assets/upload/img/' . $field->images . '" alt="" style="height: 80px;">';
            $row[] = $field->title;

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
}
