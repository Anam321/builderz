<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_m', 'models');
        check_user_role([1, 2, 3]);
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
        $user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $data['metaTitle'] = 'Profile - ' . $user['nama'];
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/users/profile';

        $this->load->view('main', $data);
    }

    public function edit()
    {
        $user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['metaTitle'] = 'Edit Profile - ' . $user['nama'];
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/users/profile_edit';
        $data['user'] = $user;
        $data['jabatan'] = $this->db->get('users_jabatan')->result();

        $this->load->view('main', $data);
    }
    public function edit_akun()
    {
        $user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['metaTitle'] = 'Edit Akun - ' . $user['nama'];
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/users/profile_edit_akun';
        $data['user'] = $user;


        $this->load->view('main', $data);
    }

    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'nama' => $this->input->post('nama'),
                'jabatan' => $this->input->post('jabatan'),
                'jk' => $this->input->post('jk'),
                'notlp' => $this->input->post('notlp'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
            );
            $update = $this->models->update(array('id' => $this->input->post('id')), $data);
            echo json_encode($update);
        }
    }
    public function updateDataAkun()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $this->input->post('username');
            $sql = $this->db->query("SELECT username FROM users where username='$username'");
            $cek_data = $sql->num_rows();
            $pass1 = $this->input->post('password');
            $pass2 = $this->input->post('password2');

            if ($username == $this->session->userdata('username')) {

                if ($pass1 == '') {
                    $r = array(
                        'status' => '00',
                        'type' => 'success',
                        'mess' => 'Success Update Data',
                    );
                    echo json_encode($r);
                } else {
                    if ($pass1 != $pass2) {
                        $r = array(
                            'status' => '01',
                            'type' => 'error',
                            'mess' => 'Please check your password again!',
                        );
                        echo json_encode($r);
                    } else {
                        $data = array(
                            'username' => $this->input->post('username'),
                            'password' => password_hash($pass1, PASSWORD_DEFAULT),
                        );
                        $this->session->set_userdata($data);
                        $update = $this->models->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode($update);
                    }
                }
            } else {
                if ($cek_data > 0) {
                    $r = array(
                        'status' => '01',
                        'type' => 'error',
                        'mess' => 'Username already exists!',
                    );
                    echo json_encode($r);
                } else {

                    if ($pass1 == '') {
                        $data = array(
                            'username' => $this->input->post('username'),
                        );
                        $this->session->set_userdata($data);
                        $update = $this->models->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode($update);
                    } else {
                        if ($pass1 != $pass2) {
                            $r = array(
                                'status' => '01',
                                'type' => 'error',
                                'mess' => 'Please check your password again!',
                            );
                            echo json_encode($r);
                        } else {
                            $data = array(
                                'username' => $this->input->post('username'),
                                'password' => password_hash($pass1, PASSWORD_DEFAULT),
                            );
                            $this->session->set_userdata($data);
                            $update = $this->models->update(array('id' => $this->input->post('id')), $data);
                            echo json_encode($update);
                        }
                    }
                }
            }
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
                    if ($this->input->post('old_images') == true) {
                        if (file_exists($path . $filename)) {
                            unlink($path . $filename);
                        }
                    }

                    $data = array(
                        'foto' => $image_data['file_name'],
                    );

                    $update = $this->models->update(array('id' => $this->input->post('id')), $data);
                    echo json_encode($update);
                }
            }
        }
    }
}
