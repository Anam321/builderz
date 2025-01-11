<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
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
        $data['conten'] = 'web/about';

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
        $q = $this->models->get_data_byId('s_about', 'id', '1');
        $data['title'] = 'Tentang';
        $data['images'] = $q['images'];
        return $data;
    }
}
