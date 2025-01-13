<?php defined('BASEPATH') or exit('No direct script access allowed');

class Apps_m extends CI_Model
{


    var $table = 'set_app_medsos'; //nama tabel dari database
    var $column_order = array('media', 'username', 'link', null); //field yang ada di table user
    var $column_search = array('media', 'username', 'link'); //field yang diizin untuk pencarian 
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



    public function get_data_ById($table, $id)
    {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where('id', $id);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }




    public function get_data($table)
    {
        $this->db->limit(6);
        $query = $this->db->get($table)->result();
        return $query;
    }

    public function get_nicePages($where)
    {

        $query = $this->db->get_where('nice_pages', ['pages' => $where])->row_array();
        return $query;
    }

    public function get_whredata($table, $where, $value)
    {

        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where, $value);
        $this->db->limit(6);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_pagesAbout()
    {

        $query = $this->db->get_where('pages_about', ['id' => 1])->row_array();
        return $query;
    }
    public function get_post($table)
    {

        $this->db->select('*');
        $this->db->from($table);
        $this->db->limit(6);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query;
    }
    public function get_data_projek($table)
    {

        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('ref_projek b', 'a.id_projek=b.id_projek');
        $this->db->limit(6);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query;
    }



    public function update($id, $data, $table)
    {

        $r = $this->db->update($table, $data, $id);
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
    public function updatefile($id, $data)
    {
        $r = $this->db->update('set_app', $data, $id);
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
}
