<?php defined('BASEPATH') or exit('No direct script access allowed');

class App_m extends CI_Model
{



    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_countblogLimit($table)
    {

        return $this->db->get($table)->num_rows();
    }
    public function get_data_count($limit, $start)
    {

        $this->db->order_by('id', 'DESC');
        return $this->db->get('post', $limit, $start)->result();
    }


    public function get_data($table)
    {
        $query = $this->db->get($table)->result();
        return $query;
    }
    public function get_data_where($table, $where, $filed)
    {
        $this->db->where($where, $filed);
        $query = $this->db->get($table)->result();
        return $query;
    }
    public function get_data_limit($table, $limit)
    {
        $this->db->limit($limit);
        $query = $this->db->get($table)->result();
        return $query;
    }
    public function get_data_byId($table, $where, $id)
    {
        $query = $this->db->get_where($table, [$where => $id])->row_array();
        return $query;
    }

    function check_visitor($ip, $user_agent, $date)
    {
        $this->db->where('ip', $ip);
        $this->db->where('user_agent', $user_agent);
        $this->db->where('date', $date);
        $query = $this->db->get('pages_blog_visitors');

        return $query->num_rows() > 0;
    }
    public function inputData($table, $data)
    {
        $r = $this->db->insert($table, $data);
        if ($r) {
            $res['status'] = '00';
            $res['type'] = 'success';
            $res['mess'] = 'Success Input Data';
        } else {
            $res['status'] = '01';
            $res['type'] = 'warning';
            $res['mess'] = 'Error Input Data, please try again...';
        }
        return $res;
    }
}
