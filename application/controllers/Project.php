<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
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
        $data['conten'] = 'web/project';

        $q = $this->models->get_data_byId('pages_seo', 'pages', 'PROJECT');

        $data['metaTitle'] = $q['title_seo'];
        $data['metaKey'] = $q['keyword_seo'];
        $data['metaDesk'] =  word_limiter($q['deskripsi_seo'], 120);
        $data['author'] =  AppIdentitas('site');
        $data['og_images'] = base_url('assets/upload/img/') .  $q['images'];
        $data['og_images_alt'] =  AppIdentitas('nama_web');

        $data['vendor'] = $this->models->get_data('quote');
        $data['whychose_r'] = $this->models->get_data_where('s_chose_us', 'position', 'RIGHT');
        $data['whychose_l'] = $this->models->get_data_where('s_chose_us', 'position', 'LEFT');
        $data['projek'] = $this->models->get_data_limit('s_portfolio', '6');
        $data['testimoni'] = $this->models->get_data_limit('pages_client', '12');
        $data['breadcrumb'] = $this->breadcrumb();
        $this->load->view('main', $data);
    }

    function breadcrumb()
    {
        $q = $this->models->get_data_byId('pages_seo', 'pages', 'PROJECT');
        $data['title'] = 'PROJECT';
        $data['images'] = $q['images'];
        return $data;
    }

    public function detail($t)
    {

        $c = array(' ');
        $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
        $s = str_replace($d, '-', $t); // Hilangkan karakter yang telah disebutkan di array $d
        $slug = strtolower(str_replace($c, '-', $s));


        // var_dump($slug);
        // die;

        $sql = $this->db->query("SELECT slug FROM s_portfolio where slug='$slug'");
        $cek_url = $sql->num_rows();
        $data['componen'] = $this->componen();
        if ($cek_url == false) {
            $data['conten'] = 'web/section/error_404';
            $data['metaTitle'] = '';
            $data['metaKey'] = '';
            $data['metaDesk'] =  '';
            $data['author'] =  '';
            $data['og_images'] = '';
            $data['og_images_alt'] = '';
        } else {
            $data['conten'] = 'web/detail_projek';



            $q = $this->models->get_data_byId('s_portfolio', 'slug', $slug);

            $data['metaTitle'] = $q['meta_title'];
            $data['metaKey'] = $q['meta_keyword'];
            $data['metaDesk'] =  word_limiter($q['meta_deskripsi'], 120);
            $data['author'] =  AppIdentitas('site');
            $data['og_images'] = base_url('assets/upload/img/') .  $q['foto'];
            $data['og_images_alt'] =  AppIdentitas('nama_web');

            $data['vendor'] = $this->models->get_data('quote');

            // $data['service'] = $this->models->get_data('s_service');
            $data['data_projek'] = $q;
            $data['projeck'] = $this->models->get_data_byId('ref_projek', 'id_projek', $q['projek']);
            $data['client'] = $this->models->get_data_byId('pages_client', 'id_projek', $q['projek']);
            $data['projek_foto'] = $this->models->get_data_where('ref_projek_images', 'id_projek', $q['projek']);
        }



        $this->load->view('main', $data);
    }
}
