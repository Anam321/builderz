<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_m extends CI_Model
{



    var $table = 'users'; //nama tabel dari database
    var $column_order = array(null, 'foto', 'nama', 'username', null, 'email', null, null, null); //field yang ada di table user
    var $column_search = array('foto', 'nama', 'username',); //field yang diizin untuk pencarian 
    var $order = array('id' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function get_role()
    {
        $q = $this->db->get('users_role')->result();
        return $q;
    }

    public function data_user($username)
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $query = $this->db->query($sql, array($username));
        return $query->row_array();
    }
    public function record_login_attempt($username)
    {
        $data = array(
            'username' => $username,
            'ip_address' => $this->input->ip_address(),
            'attempt_time' => date('Y-m-d H:i:s')
        );
        return $this->db->insert('login_attempts', $data);
    }
    public function get_login_attemptsl($ip_address, $limit_time)
    {
        $sql = "SELECT COUNT(*) AS attempts FROM login_attempts WHERE  ip_address = ?  AND attempt_time > ?";
        $query = $this->db->query($sql, array($ip_address, $limit_time));
        return $query->row()->attempts;
    }

    public function get_login_attempts($username, $limit_time)
    {
        $ip_address = $this->input->ip_address();
        $sql = "SELECT COUNT(*) AS attempts FROM login_attempts WHERE  ip_address = ? AND username = ? AND attempt_time > ?";
        $query = $this->db->query($sql, array($ip_address, $username, $limit_time));
        return $query->row()->attempts;
    }

    public function clear_login_attempts($username)
    {
        $this->db->delete('login_attempts', array('username' => $username));
    }



    public function getBy($val)
    {
        $q = $this->db->get_where('users', ['username' => $val])->row_array();
        return $q;
    }
    public function insertData($data)
    {

        $r = $this->db->insert('users', $data);
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
    public function update($id, $data)
    {

        $r = $this->db->update('users', $data, $id);
        if ($r) {
            $res['status'] = '00';
            $res['type'] = 'success';
            $res['mess'] = 'Success Update Data';
        } else {
            $res['status'] = '01';
            $res['type'] = 'warning';
            $res['mess'] = 'Error Update Data, please try again...';
        }
        return $res;
    }

    public function delete($id)
    {


        $this->db->where('id', $id);
        $r = $this->db->delete('users');

        if ($r) {
            $res['status'] = '00';
            $res['type'] = 'success';
            $res['mess'] = 'Succes Delete Data';
        } else {
            $res['status'] = '01';
            $res['type'] = 'warning';
            $res['mess'] = 'Error Delete Data';
        }
        return json_encode($res);
    }
}
