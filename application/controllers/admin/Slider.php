<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Slide_m', 'models');
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
        $data['metaTitle'] = 'Slider';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/slider/index';
        $data['service'] = $this->models->get_service();
        $this->load->view('main', $data);
    }
    public function get_data_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById($id);
            echo json_encode($data);
        }
    }
    function dataTables()
    {
        $list = $this->models->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $no++;
            $row = array();
            $row[] = '<h5 class="mb-0">Slider ' . $field->id . '</h5>';
            $row[] = '<img class="flex-shrink-0" src="' . base_url() . 'assets/upload/img/' . $field->gambar . '" alt="" style="height: 80px;">';
            $row[] = $field->title;
            $row[] = $field->desk;
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
    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $update = $this->models->update(array('id' => $this->input->post('id')));
            echo json_encode($update);
        }
    }
}
