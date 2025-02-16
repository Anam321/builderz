<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error_404 extends CI_Controller
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
        $data['conten'] = 'web/section/error_404';

        $data['metaTitle'] = 'Pages Not Found';
        $data['metaKey'] = '';
        $data['metaDesk'] = '';
        $data['author'] =  AppIdentitas('site');
        $data['og_images'] = base_url('assets/upload/img/') .  AppIdentitas('logo');
        $data['og_images_alt'] =  AppIdentitas('nama_web');


        $this->load->view('main', $data);
    }
}
