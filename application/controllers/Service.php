<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
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
        $data['conten'] = 'web/service';

        $q = $this->models->get_data_byId('pages_seo', 'pages', 'SERVICE');

        $data['metaTitle'] = $q['title_seo'];
        $data['metaKey'] = $q['keyword_seo'];
        $data['metaDesk'] =  word_limiter($q['deskripsi_seo'], 120);
        $data['author'] =  AppIdentitas('site');
        $data['og_images'] = base_url('assets/upload/img/') .  $q['images'];
        $data['og_images_alt'] =  AppIdentitas('nama_web');

        $data['vendor'] = $this->models->get_data('quote');
        $data['whychose_r'] = $this->models->get_data_where('s_chose_us', 'position', 'RIGHT');
        $data['whychose_l'] = $this->models->get_data_where('s_chose_us', 'position', 'LEFT');
        $data['service'] = $this->models->get_data('s_service');
        $data['testimoni'] = $this->models->get_data_limit('pages_client', '12');
        $data['breadcrumb'] = $this->breadcrumb();
        $this->load->view('main', $data);
    }
    public function detail($t)
    {

        $c = array(' ');
        $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
        $s = str_replace($d, '-', $t); // Hilangkan karakter yang telah disebutkan di array $d
        $slug = strtolower(str_replace($c, '-', $s));


        // var_dump($slug);
        // die;

        $sql = $this->db->query("SELECT slug FROM s_service where slug='$slug'");
        $cek_url = $sql->num_rows();

        if ($cek_url == false) {
            $data['conten'] = 'web/section/error_404';
            $data['conten'] = 'web/section/error_404';
            $data['metaTitle'] = '';
            $data['metaKey'] = '';
            $data['metaDesk'] =  '';
            $data['author'] =  '';
            $data['og_images'] = '';
            $data['og_images_alt'] = '';
        } else {
            $data['conten'] = 'web/detail_service';
            $q = $this->models->get_data_byId('s_service', 'slug', $slug);

            $data['metaTitle'] = $q['seo_title'];
            $data['metaKey'] = $q['seo_keyword'];
            $data['metaDesk'] =  word_limiter($q['seo_deskripsi'], 120);
            $data['author'] =  AppIdentitas('site');
            $data['og_images'] = base_url('assets/upload/img/') .  $q['images'];
            $data['og_images_alt'] =  AppIdentitas('nama_web');

            $data['vendor'] = $this->models->get_data('quote');

            $data['service'] = $this->models->get_data('s_service');
            $data['data_service'] = $q;
        }

        $data['componen'] = $this->componen();

        $this->load->view('main', $data);
    }
    function breadcrumb()
    {
        $q = $this->models->get_data_byId('pages_seo', 'pages', 'SERVICE');
        $data['title'] = 'LAYANAN';
        $data['images'] = $q['images'];
        return $data;
    }
    public function downloadFile($file)
    {
        if ($file == '') {
            redirect('forbiden404');
        }
        force_download('assets/upload/file/' . $file, NULL);
    }
}
