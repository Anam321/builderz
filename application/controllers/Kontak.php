<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('app_m', 'models');
        visitors();
    }

    function componen()
    {
        $data['header'] = 'component/web/header';
        $data['navbar'] = 'component/web/navbar';
        $data['footer'] = 'component/web/footer';
        return $data;
    }
    public function index()
    {
        $data['componen'] = $this->componen();
        $data['conten'] = 'web/contact';

        $q = $this->models->get_data_byId('s_about', 'id', '1');

        $data['metaTitle'] = $q['heading_2'];
        $data['metaKey'] = AppIdentitas('keyword');
        $data['metaDesk'] =  word_limiter($q['text'], 120);
        $data['author'] =  AppIdentitas('site');
        $data['og_images'] = base_url('assets/upload/img/') .  $q['images'];
        $data['og_images_alt'] =  AppIdentitas('nama_web');

        $data['vendor'] = $this->models->get_data('quote');
        $data['about'] = $this->about();
        $data['breadcrumb'] = $this->breadcrumb();
        $this->load->view('main', $data);
    }
    function about()
    {
        $q = $this->models->get_data_byId('s_about', 'id', '1');
        $data['heading_1'] = $q['heading_1'];
        $data['heading_2'] = $q['heading_2'];
        $data['text'] = word_limiter($q['text'], 120);
        $data['images'] = $q['images'];
        return $data;
    }
    function breadcrumb()
    {
        $q = $this->models->get_data_byId('pages_seo', 'pages', 'KONTAK');
        $data['title'] = 'Kontak';
        $data['images'] = $q['images'];
        return $data;
    }

    public function requestService()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'telpon' => htmlspecialchars($this->input->post('telpon', true)),
                'service' => htmlspecialchars($this->input->post('service', true)),
                'message' => htmlspecialchars($this->input->post('message', true)),

                'date' => date('Y-m-d'),
                'hit' => 1,
            );
            // print_r($data);
            $insert = $this->models->inputData('project_request', $data);
            echo json_encode($insert);
        }
    }
    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'nohp' => htmlspecialchars($this->input->post('nohp', true)),
                'subject' => htmlspecialchars($this->input->post('subject', true)),
                'message' => htmlspecialchars($this->input->post('message', true)),

                'date' => date('Y-m-d'),
                'hit' => 1,
            );
            // print_r($data);
            $insert = $this->models->inputData('ref_message', $data);
            echo json_encode($insert);
        }
    }

    public function whatsappNavigasi()
    {
        $ip = $this->input->ip_address();
        $date = date("Y-m-d");
        $time = time(); //
        $timeinsert = date("Y-m-d H:i:s");


        $s = $this->db->query("SELECT * FROM klikwa WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
        $ss = isset($s) ? ($s) : 0;

        if ($ss == 0) {
            $this->db->query("INSERT INTO klikwa(ip, date, hits, online, time, wa) VALUES('" . $ip . "','" . $date . "','1','" . $time . "','" . $timeinsert . "','1')");
        } else {
            $this->db->query("UPDATE klikwa SET hits=hits+1, online='" . $time . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
        }

        $no = whatsappNav('no');
        $text = whatsappNav('pesan');
        $c = array(' ');
        $d = array(' ',);
        $s = str_replace($d, '+', $text); // Hilangkan karakter yang telah disebutkan di array $d
        $pesan = strtolower(str_replace($c, '+', $s));

        $url = 'https://wa.me/' . $no . '?text=' . $pesan . '';

        redirect($url, 'refresh');
    }
}
