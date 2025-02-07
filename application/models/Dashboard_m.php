<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_m extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }

    public function jumlah_data($table, $where, $val)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where, $val);
        $query = $this->db->get_where()->num_rows();
        return $query;
    }
    public function get_unique_visitors_count($date)
    {

        $this->db->where('date', $date);
        $this->db->distinct();
        $this->db->select('ip, user_agent');
        $query = $this->db->get('visitors');

        return $query->num_rows();
    }
    public function cartvisitor($bulan)
    {

        $this->db->select('*');
        $this->db->from('visitors_chart');
        $this->db->where('MONTH(date)', $bulan);

        $query = $this->db->get()->result();
        return $query;
    }
    public function online()
    {
        $bataswaktu = time() - 300;
        $query  = $this->db->query("SELECT * FROM visitors WHERE online > '" . $bataswaktu . "'")->num_rows();
        return $query;
    }
    public function jmlprojekbln($bulan, $tahun)
    {

        $this->db->select('*');
        $this->db->from('ref_projek');
        $this->db->where('MONTH(tgl_mulai)', $bulan);
        $this->db->where('YEAR(tgl_mulai)', $tahun);

        $query = $this->db->get()->num_rows();
        return $query;
    }



    public function chart_projek($years)
    {

        $cahrtprj = array(
            array(
                'bulan' => 'Januari',
                'jmlprj' => $this->jmlprojekbln('1', $years),
            ),
            array(
                'bulan' => 'Februari',
                'jmlprj' => $this->jmlprojekbln('2', $years),
            ),
            array(
                'bulan' => 'Maret',
                'jmlprj' => $this->jmlprojekbln('3', $years),
            ),
            array(
                'bulan' => 'April',
                'jmlprj' => $this->jmlprojekbln('4', $years),
            ),
            array(
                'bulan' => 'Mei',
                'jmlprj' => $this->jmlprojekbln('5', $years),
            ),
            array(
                'bulan' => 'Juni',
                'jmlprj' => $this->jmlprojekbln('6', $years),
            ),
            array(
                'bulan' => 'Juli',
                'jmlprj' => $this->jmlprojekbln('7', $years),
            ),
            array(
                'bulan' => 'Agustus',
                'jmlprj' => $this->jmlprojekbln('8', $years),
            ),
            array(
                'bulan' => 'September',
                'jmlprj' => $this->jmlprojekbln('9', $years),
            ),
            array(
                'bulan' => 'Oktober',
                'jmlprj' => $this->jmlprojekbln('10', $years),
            ),
            array(
                'bulan' => 'November',
                'jmlprj' => $this->jmlprojekbln('11', $years),
            ),
            array(
                'bulan' => 'Desember',
                'jmlprj' => $this->jmlprojekbln('12', $years),
            ),
        );
        return $cahrtprj;
    }

    public function get_populer_blog($table)
    {
        $this->db->limit('5');
        $this->db->order_by('visitor', 'DESC');
        return $this->db->get($table)->result();
    }

    public function get_online_users()
    {
        $time_limit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $this->db->where('last_activity >', $time_limit);
        return $this->db->get('users')->result();
    }
}
