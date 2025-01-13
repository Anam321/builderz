<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App_medsos extends CI_Controller
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
        $data['metaTitle'] = 'Set Media Sosial';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/app_medsos';
        $this->load->view('main', $data);
    }


    function dataTables()
    {
        $list = $this->models->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $no++;
            $row = array();

            $row[] = $field->media;
            $row[] = $field->username;
            $row[] = $field->link;
            $row[] = ' 
                      <button onclick="edit(' . $field->id . ')" type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button>
                      ';
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

    public function get_data_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById('set_app_medsos', $id);
            echo json_encode($data);
        }
    }


    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'username' => $this->input->post('username'),
                'link' => $this->input->post('link'),
            );
            $update = $this->models->update(array('id' => $this->input->post('id')), $data, 'set_app_medsos');
            echo json_encode($update);
        }
    }
}
