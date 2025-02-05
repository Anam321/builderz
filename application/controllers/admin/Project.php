<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Project extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_m', 'models');
        is_logged_in();
        role_superadmin();
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

        $data['metaTitle'] = 'Data Project';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/project/index';

        $this->load->view('main', $data);
    }

    public function form()
    {

        $data['metaTitle'] = 'Tambah Data Project';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/project/form';
        $data['kategori'] = $this->models->get_kategori();
        $this->load->view('main', $data);
    }
    public function form_rab($id_projek, $id_point)
    {

        $data['metaTitle'] = 'Tambah Data RAB';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/project/form_rab';
        $data['point'] = $this->db->get_where('ref_projek_uraian', ['id' => $id_point])->row_array();
        $data['projek'] = $this->db->get_where('ref_projek', ['id_projek' => $id_projek])->row_array();

        $this->load->view('main', $data);
    }
    public function edit($id)
    {

        $data['metaTitle'] = 'Edit Data Project';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/project/edit';
        $data['kategori'] = $this->models->get_kategori();
        $data['field'] = $this->models->data_byid($id);
        $this->load->view('main', $data);
    }
    public function edit_rab($id_projek, $id_point, $id_list)
    {

        $data['metaTitle'] = 'Tambah Data RAB';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/project/edit_rab';
        $data['point'] = $this->db->get_where('ref_projek_uraian', ['id' => $id_point])->row_array();
        $data['projek'] = $this->db->get_where('ref_projek', ['id_projek' => $id_projek])->row_array();
        $data['field'] = $this->db->get_where('ref_projek_rab', ['id' => $id_list])->row_array();

        $this->load->view('main', $data);
    }
    public function rab($id)
    {

        $data['metaTitle'] = 'RAB Project';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/project/rab';
        $data['projek'] = $this->db->get_where('ref_projek', ['id_projek' => $id])->row_array();
        $data['uraian'] = $this->models->get_uraian($id);
        $data['rab'] = $this->models->get_uraian_rab($id);
        $data['id_projek'] = $id;
        $this->load->view('main', $data);
    }

    public function confirm($id)
    {
        $prj = $this->models->dataTable();
        foreach ($prj as $field) {
            $query = $this->models->get_anggaran($field->id_projek);
            $anggaran = $query;
        }

        $data['anggaran'] = $anggaran;
        $data['metaTitle'] = 'Konfirmasi Project';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/project/conf';
        $data['projek'] = $this->db->get_where('ref_projek', ['id_projek' => $id])->row_array();
        $data['uraian'] = $this->models->get_uraian($id);
        // $data['rab'] = $this->models->get_uraian_rab($id);

        $this->load->view('main', $data);
    }
    public function get_uraian_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById($id, 'id', 'ref_projek_uraian');
            echo json_encode($data);
        }
    }
    public function datatable()
    {
        $da = $this->models->dataTable();
        $no = 1;

        foreach ($da as $field) {

            $anggaran = $this->models->get_anggaran($field->id_projek);
            $awal  = new DateTime($field->tgl_mulai);
            $akhir = new DateTime($field->tgl_akhir);
            $diff  = date_diff($awal, $akhir);

            $timeline = $diff->format('%a hari');
            $row = array();
            $row[] = $no++;
            $row[] = $field->nama_projek;
            $row[] = $field->nama_client;
            $row[] = $field->alamat;
            $row[] = $field->volume;
            $row[] = 'Rp. ' . number_format($anggaran) . '';
            $row[] = $timeline;
            $row[] = date_indo($field->tgl_mulai);
            $row[] = date_indo($field->tgl_akhir);
            if ($field->status == 1) {
                $badge = '<span class="badge bg-warning text-dark">Sedang Di kerjakan</span>';
            } else {
                $badge = '<span class="badge bg-success text-dark">Selesai</span>';
            }
            $row[] = $badge;

            $row[] = ' <a  href="' . base_url('admin/project/rab/') . '' . $field->id_projek . '"> <button type="button" class="btn btn-secondary btn-sm "><i class="fa fa-file me-2"></i>RAB</button></a>            
                        <div class="btn-group"><button type="button" class="btn btn-warning btn-sm dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-edit me-2"></i>Edit</button> 
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="' . base_url('admin/project/edit/') . '' . $field->id_projek . '">Edit Data</a></li>
                                <li><a class="dropdown-item" href="' . base_url('admin/project/confirm/') . '' . $field->id_projek . '">Konfirmasi Status</a></li>
                                 
                            </ul>
                        </div>
                        <button onclick="deletes(' . $field->id_projek . ')" type="button" class="btn btn-danger btn-sm "><i class="fa fa-trash me-2"></i>Delete</button>';
            $data[] = $row;
        }
        if ($da) {
            echo json_encode(array('data' => $data));
        } else {
            echo json_encode(array('data' => 0));
        }
    }
    public function list($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datalist = $this->models->data_images($id, 'ref_projek_images');

            $data = array();

            foreach ($datalist as $row) {

                $list = ' <div class="col-sm-6 mb-3">
                        <div class="card">
                         <img class="img-fluid rounded" src="' . base_url() . 'assets/upload/img/' . $row->images . '"  ">
                         <button class="btn btn-secondary" onclick="deletes(' . $row->id . ')"  type="button" >
                                            <i class="fa fa-trash me-2"></i>Delete
                                    </button>
                           
                        </div>
                    </div>';

                $data[] = $list;
            }

            echo json_encode($data);
        }
    }

    public function PostData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = array(
                'nama_projek' => $this->input->post('nama_projek'),
                'nama_client' => $this->input->post('nama_client'),
                'email' => $this->input->post('email'),
                'nohp' => $this->input->post('nohp'),
                'id_kategori' => $this->input->post('kategori'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
                'alamat' => $this->input->post('alamat'),
                'keterangan' => $this->input->post('keterangan'),
                'volume' => $this->input->post('volume'),
                'status' => 1,
            );

            $response = $this->models->PostData($data, 'ref_projek');
            echo json_encode($response);
        }
    }
    public function input_uraian()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = array(
                'uraian' => $this->input->post('uraian'),
                'id_projek' => $this->input->post('id_projek'),
            );

            $response = $this->models->PostData($data, 'ref_projek_uraian');
            echo json_encode($response);
        }
    }
    public function Post_rab()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vol = $this->input->post('vol');
            $satuan_harga = $this->input->post('harga_satuan');
            $jumlah = $vol * $satuan_harga;
            $data = array(
                'id_uraian' => $this->input->post('id_uraian'),
                'spesifikasi_bahan' => $this->input->post('spesifikasi_bahan'),
                'vol' => $this->input->post('vol'),
                'satuan' => $this->input->post('satuan'),
                'harga_satuan' => $this->input->post('harga_satuan'),
                'uraian' => $this->input->post('uraian'),
                'tot_harga' => $jumlah,
            );
            // print_r($data);
            $response = $this->models->PostData($data, 'ref_projek_rab');
            echo json_encode($response);
        }
    }
    public function upload()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $config['upload_path'] = './assets/upload/img/';
            $config['file_name'] = 'project' . time();
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['overwrite'] = true;
            $config['max_size'] = 1024; // 1MB

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                $r = array(
                    'status' => '01',
                    'type' => 'error',
                    'mess' => 'Files must not exceed 1 MB',
                );
                echo json_encode($r);
            } else {

                $image_data = $this->upload->data();
                $data = array(
                    'images' => $image_data['file_name'],
                    'id_projek' => $this->input->post('id_projek'),
                );

                $response = $this->models->PostData($data, 'ref_projek_images');
                echo json_encode($response);
            }
        }
    }
    public function updateData()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'nama_projek' => $this->input->post('nama_projek'),
                'nama_client' => $this->input->post('nama_client'),
                'email' => $this->input->post('email'),
                'nohp' => $this->input->post('nohp'),
                'id_kategori' => $this->input->post('kategori'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $this->input->post('tgl_akhir'),
                'alamat' => $this->input->post('alamat'),
                'keterangan' => $this->input->post('keterangan'),
                'volume' => $this->input->post('volume'),

            );

            $update = $this->models->update(array('id_projek' => $this->input->post('id_projek')), $data, 'ref_projek');
            echo json_encode($update);
        }
    }
    public function update_uraian()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'uraian' => $this->input->post('uraian'),
                'id_projek' => $this->input->post('id_projek'),
            );

            $update = $this->models->update(array('id' => $this->input->post('id_uraian')), $data, 'ref_projek_uraian');
            echo json_encode($update);
        }
    }
    public function update_rab()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $vol = $this->input->post('vol');
            $satuan_harga = $this->input->post('harga_satuan');
            $jumlah = $vol * $satuan_harga;
            $data = array(
                'spesifikasi_bahan' => $this->input->post('spesifikasi_bahan'),
                'vol' => $this->input->post('vol'),
                'satuan' => $this->input->post('satuan'),
                'harga_satuan' => $this->input->post('harga_satuan'),
                'uraian' => $this->input->post('uraian'),
                'tot_harga' => $jumlah,
            );

            $update = $this->models->update(array('id' => $this->input->post('id')), $data, 'ref_projek_rab');
            echo json_encode($update);
        }
    }

    public function done_project($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'status' => 0,
            );

            $update = $this->models->update(array('id_projek' => $id), $data, 'ref_projek');
            echo json_encode($update);
        }
    }
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $d_point = $this->db->query("SELECT id_projek FROM ref_projek_uraian where id_projek='$id'");
            $cek_point = $d_point->num_rows();
            if ($cek_point > 0) {

                $point = $this->db->get_where('ref_projek_uraian', ['id_projek' => $id])->row_array();
                $id_uraian = $point['id'];

                $rab = $this->db->query("SELECT id_uraian FROM ref_projek_rab where id_uraian='$id_uraian'");
                $cek_rab = $rab->num_rows();
                if ($cek_rab > 0) {
                    $this->db->where('id_uraian', $id_uraian);
                    $this->db->delete('ref_projek_rab');
                }

                $this->db->where('id_projek', $id);
                $this->db->delete('ref_projek_uraian');
            }

            $images = $this->db->query("SELECT id_projek FROM ref_projek_images where id_projek='$id'");
            $cek_images = $images->num_rows();
            if ($cek_images > 0) {
                $q = $this->db->query("select images from ref_projek_images where id_projek = '$id'")->row();
                $foto = $q->images;
                $path = './assets/upload/img/';
                if (file_exists($path . $foto)) {
                    unlink($path . $foto);
                }

                $this->db->where('id_projek', $id);
                $this->db->delete('ref_projek_images');
            }

            $portfolio = $this->db->query("SELECT projek FROM s_portfolio where projek='$id'");
            $cek_portfolio = $portfolio->num_rows();
            if ($cek_portfolio > 0) {
                $this->db->where('projek', $id);
                $this->db->delete('s_portfolio');
            }

            $testi = $this->db->query("SELECT id_projek FROM pages_client where id_projek='$id'");
            $cek_testi = $testi->num_rows();
            if ($cek_testi > 0) {
                $this->db->where('id_projek', $id);
                $this->db->delete('pages_client');
            }
            echo $this->models->delete_data($id, 'id_projek', 'ref_projek');
        }
    }
    public function delete_uraian($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql = $this->db->query("SELECT id_uraian FROM ref_projek_rab where id_uraian='$id'");
            $cek_data = $sql->num_rows();
            if ($cek_data > 0) {
                $this->db->where('id_uraian', $id);
                $this->db->delete('ref_projek_rab');
            }
            echo $this->models->delete_data($id, 'id', 'ref_projek_uraian');
        }
    }
    public function delete_list($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo $this->models->delete_data($id, 'id', 'ref_projek_rab');
        }
    }
    public function delete_images($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo $this->models->delete_images($id);
        }
    }

    public function export_projek()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach (range('A', 'F') as $coulumID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($coulumID)->setAutosize(true);
        }
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'NAMA');
        $sheet->setCellValue('C1', 'USERNAME');


        // $projek = $this->models->dataTable();
        $projek = $this->db->query("SELECT * FROM users")->result_array();

        $x = 2; //start from row 2
        $no = 1;
        foreach ($projek as $row) {

            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row['nama']);
            $sheet->setCellValue('C' . $x, $row['username']);


            $x++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'data_pegawai.xlsx';
        $writer->save($fileName);  //this is for save in folder


        /* for force download */
        header('Content-Type: appliction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        $writer->save('php://output');
        /* force download end */
    }

    public function exportRab_pdf($id)
    {
        $this->load->library('pdfgenerator');

        $prj = $this->db->get_where('ref_projek', ['id_projek' => $id])->row_array();

        $this->data['projek'] = $this->db->get_where('ref_projek', ['id_projek' => $id])->row_array();
        $this->data['uraian'] = $this->models->get_uraian($id);
        $this->data['rab'] = $this->models->get_uraian_rab($id);

        $file_pdf = 'RAB ' . $prj['nama_projek'];
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('admin/project/cetak_rab', $this->data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
    public function exportProject_pdf()
    {
        $this->load->library('pdfgenerator');

        $prj = $this->models->dataTable();
        foreach ($prj as $field) {
            $query = $this->models->get_anggaran($field->id_projek);
            $anggaran = $query;
        }

        $this->data['title_pdf'] = 'Laporan Data Project';
        $this->data['projek'] = $this->models->dataTable();
        $this->data['anggaran'] = $anggaran;

        $file_pdf = 'laporan_Data_Project';
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('admin/project/cetak_projek', $this->data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function print_project()
    {
        $prj = $this->models->dataTable();
        foreach ($prj as $field) {
            $query = $this->models->get_anggaran($field->id_projek);
            $anggaran = $query;
        }
        $data['title'] = 'DATA PROJECT';
        $data['projek'] = $this->models->dataTable();
        $data['anggaran'] = $anggaran;
        $this->load->view('admin/project/print_projek', $data);
    }
    public function print_rab($id)
    {
        $data['projek'] = $this->db->get_where('ref_projek', ['id_projek' => $id])->row_array();
        $data['uraian'] = $this->models->get_uraian($id);
        $data['rab'] = $this->models->get_uraian_rab($id);
        $data['title'] = 'DATA RAB';


        $this->load->view('admin/project/print_rab', $data);
    }
}
