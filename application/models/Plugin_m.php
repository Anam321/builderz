<?php defined('BASEPATH') or exit('No direct script access allowed');

class Plugin_m extends CI_Model
{

    var $table = 'set_plugin'; //nama tabel dari database
    var $column_order = array(null,  'nama_plugin',  null); //field yang ada di table user
    var $column_search = array('nama_plugin'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

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





    public function get_data_ById($id)
    {
        $this->db->select("*");
        $this->db->from('set_plugin');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    public function insertData()
    {
        $data = array(
            'nama_plugin' => $this->input->post('nama_plugin'),
            'plugin' => $this->input->post('plugin'),
            'active' => 0,
        );

        $r = $this->db->insert('set_plugin', $data);
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

    public function update($id)
    {

        $data = array(
            'nama_plugin' => $this->input->post('nama_plugin'),
            'plugin' => $this->input->post('plugin'),
            'active' => 0,
        );


        $r = $this->db->update('set_plugin', $data, $id);
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
        $r = $this->db->delete('set_plugin');

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
