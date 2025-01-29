<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navigasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }


    public function colorheadlogo($color)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = array(
                'color' => $color,
            );
        }
        $update = $this->db->update('template_color', $data, array('id' => 1));
        echo json_encode($update);
    }
    public function colornav($color)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = array(
                'color' => $color,
            );
        }
        $update = $this->db->update('template_color', $data, array('id' => 2));
        echo json_encode($update);
    }
    public function colorside($color)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = array(
                'color' => $color,
            );
        }
        $update = $this->db->update('template_color', $data, array('id' => 3));
        echo json_encode($update);
    }
}
