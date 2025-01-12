<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quote extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Quote_m', 'models');
        is_logged_in();
    }
    function componen()
    {
        $data['header'] = 'component/admin/header';
        $data['navbar'] = 'component/admin/navbar';
        $data['footer'] = 'component/admin/footer';
        return $data;
    }
    public function index()
    {
        $data['app'] = $this->db->get_where('set_app', ['id' => 1])->row_array();
        $data['metaTitle'] = 'Quote';
        $data['componen'] = $this->componen();


        $data['conten'] = 'admin/quote';
        $data['aboutData'] = $this->db->get_where('s_about', ['id' => 1])->row_array();

        $this->load->view('main', $data);
    }

    function dataTables()
    {
        $table = 'quote'; //nama tabel dari database
        $column_order = array(null, 'title', null); //field yang ada di table user
        $column_search = array('title'); //field yang diizin untuk pencarian 
        $order = array('id' => 'DESC'); // default order 

        $list = $this->models->get_datatables($table, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->title;
            $row[] = '<img class="flex-shrink-0" src="' . base_url() . 'assets/upload/img/' . $field->file . '" alt="" style="height: 80px;">';
            $row[] = '
                    <button onclick="edit(' . $field->id . ')"  type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button>
                    <button onclick="deletes(' . $field->id . ')" type="button" class="btn btn-danger btn-sm "><i class="fa fa-trash me-2"></i>Delete</button>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->models->count_all($table),
            "recordsFiltered" => $this->models->count_filtered($table, $column_order, $column_search, $order),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    public function PostData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $slug = htmlspecialchars($this->input->post('title'));

            $config['upload_path'] = './assets/upload/img/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['file_name'] = strtolower($slug);
            $config['overwrite'] = true;
            $config['max_size'] = 1020; // 1MB

            $this->load->library('upload', $config);
            $this->upload->do_upload('file');
            $hasil = $this->upload->data();

            $config['source_image'] = 'asset/upload/img/' . $hasil['file_name'];

            $config['wm_type'] = 'text';
            $config['wm_font_path'] = './system/fonts/texb.ttf';
            $config['wm_font_size'] = '26';
            $config['wm_font_color'] = 'ffffff';
            $config['wm_vrt_alignment'] = 'middle';
            $config['wm_hor_alignment'] = 'center';
            $config['wm_padding'] = '20';
            $this->load->library('image_lib', $config);
            $this->image_lib->watermark();

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($hasil['file_name'] == '') {
                $data = array(
                    'title' => $this->input->post('title'),
                );
            } else {
                $data = array(
                    'file' => $hasil['file_name'],
                    'title' => $this->input->post('title'),
                );
            }
        }
        // print_r($data);
        $response = $this->models->PostData('quote', $data);
        echo json_encode($response);
    }
    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            if (!empty($_FILES["images"]["name"])) {
                $slug = htmlspecialchars($this->input->post('title'));
                $config['upload_path'] = './assets/upload/img/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                $config['file_name'] = strtolower($slug);
                // $config['overwrite'] = true;
                $config['max_size'] = 1020; // 1MB

                $this->load->library('upload', $config);
                $this->upload->do_upload('file');
                $hasil = $this->upload->data();

                $config['source_image'] = 'asset/upload/img/' . $hasil['file_name'];

                $config['wm_type'] = 'text';
                $config['wm_font_path'] = './system/fonts/texb.ttf';
                $config['wm_font_size'] = '26';
                $config['wm_font_color'] = 'ffffff';
                $config['wm_vrt_alignment'] = 'middle';
                $config['wm_hor_alignment'] = 'center';
                $config['wm_padding'] = '20';
                $this->load->library('image_lib', $config);
                $this->image_lib->watermark();

                if ($this->input->post('old_file') == true) {
                    $path = './assets/upload/img/';
                    $filename = $this->input->post('old_file');
                    if (file_exists($path . $filename)) {
                        unlink($path . $filename);
                    }
                }


                $data = array(
                    'images' => $hasil['file_name'],
                    'title' => $this->input->post('title'),
                );
            } else {
                $data = array(
                    'title' => $this->input->post('title'),
                );
            }

            // print_r($data);
            $update = $this->models->update(array('id' => $this->input->post('id')), $data, 'quote');
            echo json_encode($update);
        }
    }
    public function get_data_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById('quote', $id);
            echo json_encode($data);
        }
    }
    public function delete_data($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $q = $this->db->query("select file from quote where id = '$id'")->row();
            $foto = $q->file;

            // var_dump($foto);

            $path = './assets/upload/img/';
            // hapus file
            if (file_exists($path . $foto)) {
                unlink($path . $foto);
            }

            echo $this->models->delete('quote', $id);
        }
    }
}
