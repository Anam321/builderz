<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
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
        $data['conten'] = 'web/blog';

        $q = $this->models->get_data_byId('pages_seo', 'pages', 'BLOG');

        $data['metaTitle'] = $q['title_seo'];
        $data['metaKey'] = $q['keyword_seo'];
        $data['metaDesk'] =  word_limiter($q['deskripsi_seo'], 120);
        $data['author'] =  AppIdentitas('site');
        $data['og_images'] = base_url('assets/upload/img/') .  $q['images'];
        $data['og_images_alt'] =  AppIdentitas('nama_web');



        $this->load->library('pagination');
        $config['base_url'] = base_url('blog/index');
        $config['total_rows'] = $this->models->get_CountblogLimit('post');
        $config['per_page'] = 12;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<nav class="justify-content-center d-flex"><ul class="pagination">';
        $config['full_tag_close'] = ' </ul></nav>';

        $config['first_link'] = 'first';
        $config['first_tag_open'] = ' <li class="page-item">';
        $config['first_tag_close'] = ' </li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = ' <li class="page-item">';
        $config['last_tag_close'] = ' </li>';


        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = ' <li class="page-item">';
        $config['next_tag_close'] = ' </li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = ' <li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = ' <li class="page-item active"><a href="#" class="page-link" aria-label="Previous">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = ' <li class="page-item">';
        $config['num_tag_close'] = ' </li>';

        $config['attributes'] = array('class' => 'page-link');

        // INISIALISASI
        $this->pagination->initialize($config);
        $data1['start'] = $this->uri->segment(3);

        $data['blog'] = $this->models->get_data_count($config['per_page'], $data1['start']);
        $data['paging'] = $this->pagination->create_links();


        $data['breadcrumb'] = $this->breadcrumb();
        $data['side'] = $this->sidebar_post();
        $this->load->view('main', $data);
    }
    public function kategori($t)
    {

        $c = array(' ');
        $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
        $s = str_replace($d, '-', $t); // Hilangkan karakter yang telah disebutkan di array $d
        $slug = strtolower(str_replace($c, '-', $s));


        // var_dump($slug);
        // die;

        $sql = $this->db->query("SELECT slug FROM post_category where slug='$slug'");
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
            $data['conten'] = 'web/kategori';

            $q = $this->models->get_data_byId('post_category', 'slug', $slug);

            $data['metaTitle'] = 'KATEGORI | ' . $q['category'];
            $data['metaKey'] = '';
            $data['metaDesk'] =  word_limiter($q['deskripsi'], 120);
            $data['author'] =  AppIdentitas('site');
            $data['og_images'] = '';
            $data['og_images_alt'] =  AppIdentitas('nama_web');



            $this->load->library('pagination');
            $config['base_url'] = base_url('kategori/' . $slug);
            $config['total_rows'] = $this->models->get_CountblogLimit('post', $this->db->where('categori', $q['id']));
            $config['per_page'] = 12;
            $config['num_links'] = 5;
            $config['full_tag_open'] = '<nav class="justify-content-center d-flex"><ul class="pagination">';
            $config['full_tag_close'] = ' </ul></nav>';

            $config['first_link'] = 'first';
            $config['first_tag_open'] = ' <li class="page-item">';
            $config['first_tag_close'] = ' </li>';

            $config['last_link'] = 'Last';
            $config['last_tag_open'] = ' <li class="page-item">';
            $config['last_tag_close'] = ' </li>';


            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = ' <li class="page-item">';
            $config['next_tag_close'] = ' </li>';

            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = ' <li class="page-item">';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = ' <li class="page-item active"><a href="#" class="page-link" aria-label="Previous">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open'] = ' <li class="page-item">';
            $config['num_tag_close'] = ' </li>';

            $config['attributes'] = array('class' => 'page-link');

            // INISIALISASI
            $this->pagination->initialize($config);
            $data1['start'] = $this->uri->segment(3);

            $data['blog'] = $this->models->get_data_count($config['per_page'], $data1['start'], $this->db->where('categori', $q['id']));
            $data['paging'] = $this->pagination->create_links();


            $data['breadcrumb'] = $this->breadcrumbkategori($slug);
            $data['side'] = $this->sidebar_post();
        }
        $data['componen'] = $this->componen();
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

        $sql = $this->db->query("SELECT slug FROM post where slug='$slug'");
        $cek_url = $sql->num_rows();
        $kat = $this->db->get_where('post', ['slug' => $slug])->row_array();

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
            $this->blog_visitors($slug);
            $data['conten'] = 'web/detail_blog';
            $q = $this->models->get_data_byId('post', 'slug', $slug);

            $data['metaTitle'] = $q['meta_title'];
            $data['metaKey'] = $q['meta_keyword'];
            $data['metaDesk'] =  word_limiter($q['meta_deskripsi'], 120);
            $data['author'] =  AppIdentitas('site');
            $data['og_images'] = base_url('assets/upload/img/') .  $q['images'];
            $data['og_images_alt'] =  AppIdentitas('nama_web');

            $data['side'] = $this->sidebar_post();
            $data['post_seo'] = $q;
            $data['r_post'] = $this->models->get_data('post', $this->db->where('categori', $kat['categori']));
        }

        $data['componen'] = $this->componen();

        $this->load->view('main', $data);
    }
    function breadcrumb()
    {
        $q = $this->models->get_data_byId('pages_seo', 'pages', 'BLOG');
        $data['title'] = 'Blog Post';
        $data['images'] = $q['images'];
        return $data;
    }
    function breadcrumbkategori($x)
    {
        $q = $this->models->get_data_byId('post_category', 'slug', $x);
        $data['title'] = 'Kategori';
        $data['images'] = $q['foto'];
        return $data;
    }
    function sidebar_post()
    {

        $data['side_post'] = $this->models->get_data_limit('post', '12', $this->db->order_by('visitor', 'DESC'));
        $data['kategori_post'] = $this->models->get_data('post_category', $this->db->order_by('id', 'DESC'));

        return $data;
    }

    function blog_visitors($url)
    {
        $ip    = $this->input->ip_address();
        $date  = date("Y-m-d");
        $user_agent = $this->input->user_agent();
        $time = time();
        $timeinsert = date("Y-m-d H:i:s");
        $post = $url;

        if (!$this->models->check_visitor($ip, $user_agent, $date)) {
            // Tambahkan pengunjung ke database
            $this->db->query("INSERT INTO post_visitors(ip, date, hits, online, time, post, user_agent) VALUES('" . $ip . "','" . $date . "','1','" . $time . "','" . $timeinsert . "','" . $post . "','" . $user_agent . "')");
            $this->db->query("UPDATE post SET visitor=visitor+1 WHERE link='" . $post . "' ");
        } else {
            $this->db->query("UPDATE post_visitors SET hits=hits+1, online='" . $time . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
            // $this->db->query("UPDATE post SET hits=hits+1 WHERE url='" . $post . "' ");
        }
    }
}
