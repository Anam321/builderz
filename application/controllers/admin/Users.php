<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_m', 'models');
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

        $data['metaTitle'] = 'Data Users';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/users/index';

        $this->load->view('main', $data);
    }
    public function bio($x)
    {

        $data['metaTitle'] = 'Tambah Data Users';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/users/bio';
        $data['role'] = $this->models->get_role();
        $data['bio'] = $this->db->get_where('users', ['username' => $x])->row_array();
        $this->load->view('main', $data);
    }
    public function form()
    {

        $data['metaTitle'] = 'Tambah Data Users';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/users/form';
        $data['role'] = $this->models->get_role();
        $data['jabatan'] = $this->db->get('users_jabatan')->result();
        $this->load->view('main', $data);
    }
    public function edit($val)
    {
        $sql = $this->db->query("SELECT username FROM users where username='$val'");
        $cek_url = $sql->num_rows();

        if ($cek_url == false) {
            redirect('errors_404');
        }

        $data['metaTitle'] = 'Edit Data Users';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/users/edit';
        $data['role'] = $this->models->get_role();
        $data['jabatan'] = $this->db->get('users_jabatan')->result();
        $data['filed'] = $this->models->getBy($val);
        $this->load->view('main', $data);
    }

    function dataTables()
    {
        $list = $this->models->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $rol = $this->db->get_where('users_role', ['role_id' => $field->role_id])->row_array();
            $no++;
            $row = array();
            $row[] = $no;
            if ($field->foto == true) {
                $file = $field->foto;
            } else {
                $file = 'userdefault.png';
            }
            $row[] = '<img class="flex-shrink-0" src="' . base_url() . 'assets/upload/img/' . $file . '" alt="" style="height: 80px;">';
            $row[] = $field->nama;
            $row[] = $field->username;
            $row[] = $field->nohp;
            $row[] = $field->email;
            $row[] = $rol['role'];
            if ($field->status == 1) {
                $badge = '<span class="badge bg-success">Aktif</span>';
            } else {
                $badge = '<span class="badge bg-danger">Tidak Aktif</span>';
            }
            $row[] = $badge;

            if ($field->id == 1) {
                $btnhapus = '';
                $btnv = '';
            } else {
                $btnhapus = ' <button onclick="deletes(' . $field->id . ')" type="button" class="btn btn-danger btn-sm "><i class="fa fa-trash me-2"></i>Delete</button>';
                $btnv = ' <a href="' . base_url('app-admin/users/views/') . '' . $field->username . '"> <button type="button" class="btn btn-success btn-sm "><i class="fa fa-eye me-2"></i>View</button></a>';
            }
            $row[] = '' . $btnv . ' <a href="' . base_url('app-admin/users/edit/') . '' . $field->username . '"> <button type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button></a>
                        ' . $btnhapus . '';
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

            $pass = $this->input->post('password');
            $pass2 = $this->input->post('password2');
            $username = $this->input->post('username');
            $sql = $this->db->query("SELECT username FROM users where username='$username'");
            $cek_data = $sql->num_rows();

            if ($cek_data > 0) {
                $r = array(
                    'status' => '01',
                    'type' => 'error',
                    'mess' => 'Username Sudah Ada!...',
                );
                echo json_encode($r);
            } else {
                if ($pass != $pass2) {
                    $r = array(
                        'status' => '01',
                        'type' => 'error',
                        'mess' => 'Masukan Password Dengan Benar!...',
                    );
                    echo json_encode($r);
                } else {
                    $data = array(
                        'nama' => $this->input->post('nama'),
                        'jabatan' => $this->input->post('jabatan'),
                        'jk' => $this->input->post('jk'),
                        'alamat' => $this->input->post('alamat'),
                        'username' => $this->input->post('username'),
                        'role_id' => $this->input->post('role_id'),
                        'nohp' => $this->input->post('nohp'),
                        'email' => $this->input->post('email'),
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                        'status' => 1,
                        'creat_date' => date('Y-m-d'),
                    );

                    $response = $this->models->insertData($data);
                    echo json_encode($response);
                }
            }
        }
    }

    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pass = $this->input->post('password');
            $pass2 = $this->input->post('password2');

            if ($pass == '') {
                $data = array(
                    'nama' => $this->input->post('nama'),
                    'username' => $this->input->post('username'),
                    'role_id' => $this->input->post('role_id'),
                    'nohp' => $this->input->post('nohp'),
                    'email' => $this->input->post('email'),
                    'status' => $this->input->post('status'),
                    'jabatan' => $this->input->post('jabatan'),
                    'jk' => $this->input->post('jk'),
                    'alamat' => $this->input->post('alamat'),

                );
                $update = $this->models->update(array('id' => $this->input->post('id')), $data);
                echo json_encode($update);
            } else {
                if ($pass != $pass2) {
                    $r = array(
                        'status' => '01',
                        'type' => 'error',
                        'mess' => 'Masukan Password Dengan Benar!...',
                    );
                    echo json_encode($r);
                } else {
                    $data = array(
                        'nama' => $this->input->post('nama'),
                        'username' => $this->input->post('username'),
                        'role_id' => $this->input->post('role_id'),
                        'nohp' => $this->input->post('nohp'),
                        'email' => $this->input->post('email'),
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                        'status' => $this->input->post('status'),
                    );

                    $update = $this->models->update(array('id' => $this->input->post('id')), $data);
                    echo json_encode($update);
                }
            }
        }
    }

    public function delete_data($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $this->models->delete($id);
        }
    }
}
