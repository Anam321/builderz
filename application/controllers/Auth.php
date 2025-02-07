<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    private $max_attempts = 3;
    private $lockout_time = 900; // 15 minutes
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_m', 'models');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('admin/dashboard');
        } else {
            $ip_address = $this->input->ip_address();

            $limit_time = date('Y-m-d H:i:s', time() - $this->lockout_time);
            $attempts = $this->models->get_login_attemptsl($ip_address, $limit_time);
            if ($attempts >= $this->max_attempts) {
                $sess = 1;
            } else {
                $sess = 0;
            }
            $data['sess'] = $sess;
            $data['app'] = $this->db->get_where('set_app', ['id' => 1])->row_array();
            $this->load->view('login', $data);
        }
    }

    public function login_admin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');

            if ($this->form_validation->run() == FALSE) {
                $r = array(
                    'status' => '01',
                    'type' => 'error',
                    'mess' => 'Login Error, Priksa kmbali informasi login !',
                );
                echo json_encode($r);
            } else {
                if (htmlspecialchars($this->input->post('token', true)) != $this->session->csrf_token) {
                    $r = array(
                        'status' => '01',
                        'type' => 'error',
                        'mess' => 'Akses Tidak Di Ijinkan!',
                    );
                    echo json_encode($r);
                } else {

                    $username = htmlspecialchars($this->input->post('username', true));
                    $password = htmlspecialchars($this->input->post('password', true));


                    // Check login attempts
                    $limit_time = date('Y-m-d H:i:s', time() - $this->lockout_time);
                    $attempts = $this->models->get_login_attempts($username, $limit_time);
                    if ($attempts >= $this->max_attempts) {
                        $r = array(
                            'status' => '01',
                            'type' => 'error',
                            'mess' => 'Kamu 3 kali gagal login. Kembai lagi setelah 15 menit',
                        );
                        echo json_encode($r);
                    } else {
                        $user = $this->models->data_user($username);
                        if ($user && password_verify($password, $user['password'])) {
                            if ($user['status'] == 1) {

                                $data = [
                                    'username' => $user['username'],
                                    'role_id' => $user['role_id'],
                                    'id' => $user['id'],
                                ];
                                $this->session->set_userdata($data);
                                $r = array(
                                    'status' => '00',
                                    'type' => 'success',
                                    'mess' => 'Login Berhasil, Mohon Tunggu !',
                                );
                                echo json_encode($r);
                            } else {
                                $r = array(
                                    'status' => '01',
                                    'type' => 'error',
                                    'mess' => 'Account Tidak aktif!',
                                );
                                echo json_encode($r);
                            }
                        } else {
                            $this->models->record_login_attempt($username);
                            $r = array(
                                'status' => '01',
                                'type' => 'error',
                                'mess' => 'Username atau password salah!...',
                            );
                            echo json_encode($r);
                        }
                    }
                }
            }
        } else {
            $this->output->set_status_header(403);
            show_error('Url tidak di temukan');
        }
    }

    public function logout()
    {
        // hapus session
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        // redirect ke halaman login
        redirect('app-admin/login');
    }
}
