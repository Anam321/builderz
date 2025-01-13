<?php defined('BASEPATH') or exit('No direct script access allowed');

class Project_m extends CI_Model
{


    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->database();
    // }
    function fetch_data()
    {
        $this->db->where('status', 0);
        $this->db->order_by('id_projek', 'DESC');
        $query = $this->db->get('ref_projek')->result();
        return $query;
    }
    public function dataTable()
    {

        $this->db->select("*");
        $this->db->from('ref_projek');
        $this->db->order_by('id_projek', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }
    public function get_anggaran($id)
    {
        $uraian = $this->get_uraian($id);
        $sub_total = 0;
        foreach ($uraian as $field) {
            $total = 0;
            $this->db->where('id_uraian', $field->id);
            $query = $this->db->get('ref_projek_rab')->result();

            foreach ($query as $row) {
                $total += $row->tot_harga;
            }
            $sub_total += $total;
        }
        return $sub_total;
    }

    public function get_kategori()
    {
        $q = $this->db->get('post_category')->result();
        return $q;
    }

    public function data_images($id, $table)
    {
        $this->db->where('id_projek', $id);
        $q = $this->db->get($table)->result();
        return $q;
    }
    public function get_uraian($id)
    {
        $this->db->where('id_projek', $id);
        $q = $this->db->get('ref_projek_uraian')->result();
        return $q;
    }
    public function get_uraian_rab($id)
    {
        $uraian = $this->get_uraian($id);

        foreach ($uraian as $row) {
            $this->db->where('id_uraian', $row->id);
            $query = $this->db->get('ref_projek_rab')->result();
            return $query;
        }
    }



    public function data_byid($id)
    {
        $q = $this->db->get_where('ref_projek', ['id_projek' => $id])->row_array();
        return $q;
    }

    public function get_data_ById($id, $where, $table)
    {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where, $id);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }



    public function select_projek($table)
    {

        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('status', 0);
        $this->db->order_by('id_projek', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }





    public function get_data($limit, $start)
    {

        $this->db->order_by('id', 'DESC');
        return $this->db->get('pages_portfolio', $limit, $start)->result();
    }
    public function get_countblogLimit()
    {
        return $this->db->get('pages_portfolio')->num_rows();
    }
    public function getByid($tabel, $where, $value)
    {

        $query = $this->db->get_where($tabel, [$where => $value])->row_array();
        return $query;
    }

    public function get_data_projek($table, $where)
    {

        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('ref_projek b', 'a.id_projek=b.id_projek');
        $this->db->where('link', $where);
        $this->db->limit(6);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function PostData($data, $table)
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

    public function delete_images($id)
    {

        $q = $this->db->query("select images from ref_projek_images where id = '$id'")->row();
        $foto = $q->images;
        $path = './assets/upload/img/';
        if (file_exists($path . $foto)) {
            unlink($path . $foto);
        }

        $this->db->where('id', $id);
        $r = $this->db->delete('ref_projek_images');

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
    public function delete_data($id, $where, $table)
    {
        $this->db->where($where, $id);
        $r = $this->db->delete($table);

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
