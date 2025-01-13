<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Client_m', 'models');
    }
    function componen()
    {
        is_logged_in();

        $data['header'] = 'component/admin/header';
        $data['navbar'] = 'component/admin/navbar';
        $data['footer'] = 'component/admin/footer';
        return $data;
    }
    public function index()
    {
        is_logged_in();

        $data['metaTitle'] = 'Data Testomoni Client';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/client/index';

        $this->load->view('main', $data);
    }
    public function testform()
    {
        is_logged_in();
        $data['metaTitle'] = 'Data Testomoni Client';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/client/index';

        $this->load->view('main', $data);
    }
    public function form()
    {
        is_logged_in();
        $data['metaTitle'] = 'Tambah Testimoni Client';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/client/form';

        $this->load->view('main', $data);
    }
    public function list()
    {
        is_logged_in();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datalist = $this->models->data_client('pages_client a');

            $data = array();

            foreach ($datalist as $row) {

                $list = ' <div class="col-sm-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-2">
                                
                                    <button class="btn btn-secondary" onclick="deletes(' . $row->id . ')"  type="button" >
                                            <i class="fa fa-trash me-2"></i>Delete
                                    </button>
                                </div>

                                <div class="testimonial-item text-center">
                                    <img class="img-fluid rounded-circle mx-auto mb-4" src="' . base_url() . 'assets/upload/img/' . $row->foto . '" style="width: 100px; height: 100px;">
                                    <h5 class="mb-1">' . $row->nama_client . '</h5>
                                    <p>' . $row->nama_projek . '</p>
                                    <p class="mb-0">' . $row->testimoni . '</p>
                                </div>
                            </div>
                        </div>
                    </div>';

                $data[] = $list;
            }

            echo json_encode($data);
        }
    }

    function dataTables()
    {
        is_logged_in();
        $list = $this->models->get_datatables();
        $data = array();
        // $no = $_POST['start'];
        foreach ($list as $field) {
            // $no++;
            $row = array();
            $row[] = '<input class="check" type="checkbox" onclick="getData(' . $field->id_projek . ');">';
            $row[] = $field->nama_projek;
            $row[] = $field->nama_client;
            $row[] = $field->alamat;
            $row[] = $field->volume;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->models->count_all(),
            "recordsFiltered" => $this->models->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function testiform($id, $token)
    {


        if ($token != $this->session->scrf_token = hash('sha1', date('Y-m-d'))) {
            $this->output->set_status_header(403);
            show_error('Waktu session habis');
        } else {
            $data['metaTitle'] = 'Masukan Testimoni';
            $data['projek'] = $this->db->get_where('ref_projek', ['id_projek' => $id])->row_array();
            $data['token'] = $token;
            $this->load->view('admin/client/inputTesti', $data);
        }
    }
    public function requestTesti()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id_projek = $this->input->post('id_projek');
            $nama_client = $this->input->post('nama_client');
            $nohp = $this->input->post('nohp');
            $token = $this->session->scrf_token = hash('sha1', date('Y-m-d'));
            $sql = $this->db->query("SELECT id_projek FROM pages_client where id_projek='$id_projek'");
            $cek_data = $sql->num_rows();

            if ($cek_data > 0) {
                $r = array(
                    'status' => '01',
                    'type' => 'error',
                    'mess' => 'Testimoni dengan Project ini Sudah Ada...',
                );
                echo json_encode($r);
            } else {
                $phone = hp($nohp);
                $pesan = 'Hallo Bapak / Ibu ' . $nama_client . '. Bantu kami untuk memberikan penilainan dan kesan anda tentang hasil pengerjaan kami ini. klik link untuk memberikan penilaian ' . base_url('penilaian/client/testiform/') . '' . $id_projek . '/' . $token . '';
                $message = '&text=' . urlencode($pesan);

                $linkWA = 'https://api.whatsapp.com/send?phone=' . $phone . $message;
                $url = $linkWA;
                $response = array(
                    'status' => '00',
                    'type' => 'success',
                    'mess' => $url,
                );
                echo json_encode($response);
            }
        }
    }
    public function PostData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $token = $this->input->post('token');
            $id_projek = $this->input->post('id_projek');
            if ($token != $this->session->scrf_token = hash('sha1', date('Y-m-d'))) {
                $this->output->set_status_header(403);
                show_error('Waktu session habis');
            } else {

                $sql = $this->db->query("SELECT id_projek FROM pages_client where id_projek='$id_projek'");
                $cek_data = $sql->num_rows();

                if ($cek_data > 0) {
                    $r = array(
                        'status' => '01',
                        'type' => 'error',
                        'mess' => 'Seperti nya Testimoni sudah ada. Terimakasih...',
                    );
                    echo json_encode($r);
                } else {
                    $slug = str_replace(' ', '-', $this->input->post('nama_client'));
                    $config['upload_path'] = './assets/upload/img/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
                    $config['file_name'] = strtolower($slug) . time();
                    $config['overwrite'] = true;
                    $config['max_size'] = 1020; // 1MB

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('foto')) {
                        $res['status'] = '01';
                        $res['type'] = 'error';
                        $res['mess'] = 'Upload error. double check the photo file or photo size!';
                        return ($res);
                    } else {
                        $image_data = $this->upload->data();

                        $dataprojek = array(
                            'nama_client' => $this->input->post('nama_client'),
                        );
                        $datatesti = array(
                            'foto' => $image_data['file_name'],
                            'id_projek' => $this->input->post('id_projek'),
                            'testimoni' => $this->input->post('testimoni'),
                            'publik' => 1,
                        );
                        $this->models->updateProjek(array('id_projek' => $this->input->post('id_projek')), $dataprojek);
                        $response = $this->models->PostData($datatesti);
                        echo json_encode($response);
                    }
                }
            }
        }
    }
    public function get_data_ById($id)
    {
        is_logged_in();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById($id);
            echo json_encode($data);
        }
    }
    public function updateData()
    {
        is_logged_in();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $update = $this->models->update(array('id' => $this->input->post('id')));
            echo json_encode($update);
        }
    }

    public function delete_data($id)
    {
        is_logged_in();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $this->models->delete($id);
        }
    }
}
