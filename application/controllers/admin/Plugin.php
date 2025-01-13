<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plugin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('plugin_m', 'models');
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

        $data['metaTitle'] = ' Set Plugin';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/plugin';

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
            $row[] = $no;
            $row[] = $field->nama_plugin;
            // $row[] = $field->plugin;
            $row[] = $field->active;
            $row[] = '<button onclick="edit(' . $field->id . ')" type="button" class="btn btn-warning btn-sm "><i class="fas fa-edit me-2"></i>Edit</button>
                      <button onclick="deletes(' . $field->id . ')" type="button" class="btn btn-danger btn-sm "><i class="fas fa-trash me-2"></i>Delete</button>
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
    public function insertData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $insert = $this->models->insertData();
            echo json_encode($insert);
        }
    }

    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $update = $this->models->update(array('id' => $this->input->post('id')));
            echo json_encode($update);
        }
    }
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $this->models->delete($id);
        }
    }
}
