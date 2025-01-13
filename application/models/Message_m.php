<?php defined('BASEPATH') or exit('No direct script access allowed');

class Message_m extends CI_Model
{


    public function data_message($table)
    {
        $query = $this->db->select('*')
            ->from($table)
            ->order_by('id', 'desc')
            ->get();

        return $query->result();
    }

    public function message_detail($table, $where)
    {
        $query = $this->db->get_where($table, ['id' => $where])->row_array();
        return $query;
    }

    public function update($id, $data)
    {

        $r = $this->db->update('ref_message', $data, $id);
        return $r;
    }
    public function delete($id)
    {

        $this->db->where('id', $id);
        $r = $this->db->delete('ref_message');

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
