<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_position extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_position_m', 'models');
        check_user_role([1]);
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

        $data['metaTitle'] = 'Users Position';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/user_position';

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
            $row[] = $field->jabatan;

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
            $t = htmlspecialchars($this->input->post('jabatan'));
            $c = array(' ');
            $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
            $s = str_replace($d, '', $t); // Hilangkan karakter yang telah disebutkan di array $d
            $slug = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua

            $sql = $this->db->query("SELECT slug FROM users_jabatan where slug='$slug'");
            $cek_data = $sql->num_rows();

            if ($cek_data > 0) {
                $r = array(
                    'status' => '01',
                    'type' => 'error',
                    'mess' => 'Data Jabatan already exists, the url must be unique!',
                );
                echo json_encode($r);
            } else {

                $data = array(
                    'jabatan' => $this->input->post('jabatan'),
                    'slug' => $slug,
                );

                $insert = $this->models->insertData($data);
                echo json_encode($insert);
            }
        }
    }

    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $t = htmlspecialchars($this->input->post('jabatan'));
            $c = array(' ');
            $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
            $s = str_replace($d, '', $t); // Hilangkan karakter yang telah disebutkan di array $d
            $slug = strtolower(str_replace($c, '-', $s));
            $data = array(
                'jabatan' => $this->input->post('jabatan'),
                'slug' => $slug,
            );

            $update = $this->models->update(array('id' => $this->input->post('id')), $data);
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
