<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_m', 'models');
        $this->load->model('Chat_m');
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
        $data['app'] = $this->db->get_where('set_app', ['id' => 1])->row_array();
        $data['metaTitle'] = 'Dashboard';
        $data['componen'] = $this->componen();

        $data['users_online'] = $this->models->get_online_users();
        $data['conten'] = 'admin/dashboard';
        $data['jmlblog'] = $this->db->get('post')->num_rows();
        $data['populerblog'] = $this->models->get_populer_blog('post');

        // $data['users'] = $this->Chat_m->get_users($this->session->userdata('id'));
        $user_id = $this->session->userdata('id');
        $data['unread'] = $this->Chat_m->get_unread_count($user_id);
        $this->load->view('main', $data);
    }

    public function get_data()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $year = $this->input->post('year');
            $data = $this->models->chart_projek($year);
            echo json_encode($data);
        }
    }
    public function activityUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $list =  array(
                'jlmvisit' => $this->models->get_unique_visitors_count(date('Y-m-d')),
                'online' => $this->models->online(),
                'klik' => $this->db->get_where('klikwa', ['date' => date('Y-m-d')])->num_rows(),
            );
            // $data[] = $list;
        }
        echo json_encode($list);
    }
    public function get_visitorscahrt()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $bulanvisit = $this->input->post('bulanvisit');
            $data = $this->models->cartvisitor($bulanvisit);
            echo json_encode($data);
        }
    }

    public function data_chart()
    {
        $tahun = date('Y'); //Mengambil tahun saat ini
        $bulan = $this->input->post('bulanvisit'); //Mengambil bulan saat ini
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        for ($i = 1; $i < $tanggal + 1; $i++) {
            $this->db->select('*');
            $this->db->from('visitors');
            $this->db->where('MONTH(date)', $bulan);
            $this->db->where('DAY(date)', $i);
            $query = $this->db->get()->num_rows();

            $list =  array(
                'date' => $i,
                'hits' => $query,
            );
            $data[] = $list;
        }

        echo json_encode($data);
    }

    public function get_users()
    {
        $users = $this->Chat_m->get_users($this->session->userdata('id'));
        echo json_encode($users);
    }



    public function mark_messages_as_read($user_from)
    {
        $user_to = $this->session->userdata('id');
        $this->Chat_m->mark_as_read($user_from, $user_to);
    }

    public function get_messages($user_to)
    {

        $messages = $this->Chat_m->get_messages($this->session->userdata('id'), $user_to);
        echo json_encode($messages);
    }

    public function send_message()
    {
        $data = [
            'user_from' => $this->session->userdata('id'),
            'user_to' => $this->input->post('user_to'),
            'message' => $this->input->post('message'),
            'is_read' => 0,
        ];
        $this->Chat_m->insert_message($data);
        echo json_encode(['status' => 'success']);
    }
    public function get_data_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->Chat_m->get_data_ById($id);
            echo json_encode($data);
        }
    }
}
