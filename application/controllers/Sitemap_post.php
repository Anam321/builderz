<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Sitemap_post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Sitemap_m', 'models');
    }

    public function index()
    {
        $data['blog'] = $this->models->get_data_fetch('post');
        $this->load->view('sitemap_post', $data);
    }
    public function portfolio()
    {
        $data['portfolio'] = $this->models->get_data_fetch('s_portfolio');
        $this->load->view('sitemap_portfolio', $data);
    }
    public function service()
    {
        $data['service'] = $this->models->get_data_fetch('s_service');
        $this->load->view('sitemap_service', $data);
    }
    public function pages()
    {
        $this->load->view('sitemap_pages');
    }
}
