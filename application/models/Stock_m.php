<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Stock_m extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        // $this->load->library('Excel');
    }

    public function get_dataTable($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('id_barang', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function dataTableStockIn($table, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($bulan > 0) {
            $this->db->where('MONTH(tanggal_masuk)', $bulan);
        }
        $this->db->where('YEAR(tanggal_masuk)', $tahun);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function dataTableStockOut($table, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from($table);
        if ($bulan > 0) {
            $this->db->where('MONTH(tanggal_keluar)', $bulan);
        }
        $this->db->where('YEAR(tanggal_keluar)', $tahun);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_datatablenoserverside($table, $id)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('id_transaksi', $id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result_array();
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

    public function PostData($table, $data)
    {
        $r = $this->db->insert($table, $data);

        if ($r) {
            $res['status'] = '00';
            $res['type'] = 'success';
            $res['mess'] = 'Data berhasil di tambahkan';
        } else {
            $res['status'] = '01';
            $res['type'] = 'warning';
            $res['mess'] = 'Data gagal di Tambahkan. Kesalahan saat menyimpan data !';
        }
        return $res;
    }

    public function updatedata($id, $data, $table)
    {
        $r = $this->db->update($table, $data, $id);
        if ($r) {
            $res['status'] = '00';
            $res['type'] = 'success';
            $res['mess'] = 'Berhasil Update Data';
        } else {
            $res['status'] = '01';
            $res['type'] = 'warning';
            $res['mess'] = 'Gagal Update Data';
        }
        return $res;
    }

    public function delete($table, $where, $id)
    {
        $this->db->where($where, $id);
        $r = $this->db->delete($table);

        if ($r) {
            $res['status'] = '00';
            $res['type'] = 'success';
            $res['mess'] = 'Berhasil Hapus Data';
        } else {
            $res['status'] = '01';
            $res['type'] = 'warning';
            $res['mess'] = 'Gagal Hapus Data';
        }
        return json_encode($res);
    }
}
