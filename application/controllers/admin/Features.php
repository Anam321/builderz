<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Features extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Features_m', 'models');
        is_logged_in();
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
        $data['metaTitle'] = 'Features';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/features';

        $this->load->view('main', $data);
    }
    public function get_data_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById('s_chose_us', $id);
            echo json_encode($data);
        }
    }
    public function get_data_ByIdfeat($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById('s_feature', $id);
            echo json_encode($data);
        }
    }
    function dataTables()
    {
        $table = 's_chose_us'; //nama tabel dari database
        $column_order = array(null, 'title', 'deskripsi', 'icon', 'position', null, null); //field yang ada di table user
        $column_search = array('title', 'deskripsi', 'icon', 'position'); //field yang diizin untuk pencarian 
        $order = array('id' => 'DESC'); // default order 

        $list = $this->models->get_datatables($table, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->title;
            $row[] = $field->deskripsi;
            $row[] = ' <i class="' . $field->icon . '"></i>';
            $row[] = $field->position;

            $row[] = ' 
                       <button onclick="editwhy(' . $field->id . ')" type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button>
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

    function dataTablesFet()
    {
        $table = 's_feature'; //nama tabel dari database
        $column_order = array(null, 'title', 'deskripsi', 'icon', null, null); //field yang ada di table user
        $column_search = array('title', 'deskripsi', 'icon'); //field yang diizin untuk pencarian 
        $order = array('id' => 'DESC'); // default order 

        $list = $this->models->get_datatables($table, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->title;
            $row[] = $field->deskripsi;
            $row[] = ' <i class="' . $field->icon . '"></i>';

            $row[] = ' <button onclick="editfeat(' . $field->id . ')" type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button>
                       ';
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


            $data = array(
                'title' => $this->input->post('title'),
                'deskripsi' => $this->input->post('deskripsi'),
                'icon' => $this->input->post('icon'),
                'position' => $this->input->post('position'),
            );

            // print_r($data);
            $response = $this->models->PostData('s_chose_us', $data);
            echo json_encode($response);
        }
    }
    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $data = array(
                'title' => $this->input->post('title'),
                'deskripsi' => $this->input->post('deskripsi'),
                'icon' => $this->input->post('icon'),
                'position' => $this->input->post('position'),
            );

            // print_r($data);
            $update = $this->models->update(array('id' => $this->input->post('id')), $data, 's_chose_us');
            echo json_encode($update);
        }
    }

    public function updateDataf()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $data = array(
                'title' => $this->input->post('titles'),
                'deskripsi' => $this->input->post('deskripsis'),
                'icon' => $this->input->post('icons'),
            );

            $update = $this->models->update(array('id' => $this->input->post('idf')), $data, 's_feature');
            echo json_encode($update);
        }
    }

    public function delete_data($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $this->models->delete('s_chose_us', $id);
        }
    }
}
