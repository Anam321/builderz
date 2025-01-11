<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
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
        $data['conten'] = 'web/index';

        $data['metaTitle'] = AppIdentitas('title');
        $data['metaKey'] = AppIdentitas('keyword');
        $data['metaDesk'] =  word_limiter(AppIdentitas('tentang'), 190);
        $data['author'] =  AppIdentitas('site');
        $data['og_images'] = base_url('assets/upload/img/') .  AppIdentitas('logo');
        $data['og_images_alt'] =  AppIdentitas('nama_web');


        $data['slide'] = $this->models->get_data('set_slide');
        $data['service'] = $this->models->get_data('s_service');
        $data['features'] = $this->models->get_data('s_feature');
        $data['whychose_r'] = $this->models->get_data_where('s_chose_us', 'position', 'RIGHT');
        $data['whychose_l'] = $this->models->get_data_where('s_chose_us', 'position', 'LEFT');
        $data['projek'] = $this->models->get_data_limit('s_portfolio', '6');
        $data['testimoni'] = $this->models->get_data_limit('pages_client', '12');
        $data['posts'] = $this->models->get_data_limit('post', '6');
        $data['vendor'] = $this->models->get_data('quote');
        $data['about'] = $this->about();
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
}
