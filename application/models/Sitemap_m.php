<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sitemap_m extends CI_Model
{

    public function get_data_fetch($table)
    {
        $query = $this->db->get($table)->result();
        return $query;
    }
}
