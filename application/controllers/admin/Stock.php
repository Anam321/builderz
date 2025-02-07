<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Stock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Stock_m', 'models');
        check_user_role([1, 2]);
    }
    function componen()
    {

        $data['header'] = 'component/admin/header';
        $data['navbar'] = 'component/admin/navbar';
        $data['footer'] = 'component/admin/footer';
        return $data;
    }
    public function data_barang()
    {

        $data['metaTitle'] = 'Data Barang';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/stock/data_barang';

        $this->load->view('main', $data);
    }

    public function in_stock()
    {

        $data['metaTitle'] = 'Stock Masuk Barang';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/stock/in_stock';
        $data['get_barang'] = $this->models->get_dataTable('tbl_barang');

        $this->load->view('main', $data);
    }
    public function out_stock()
    {

        $data['metaTitle'] = 'Stock Masuk Barang';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/stock/out_stock';
        $data['get_barang'] = $this->models->get_dataTable('tbl_barang');

        $this->load->view('main', $data);
    }



    function dataTable()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dataTable = $this->models->get_dataTable('tbl_barang');
            $no = 1;
            foreach ($dataTable as $row) {
                $tbody = array();

                $tbody[] = $no++;
                $tbody[] = $row['nama_barang'];
                $tbody[] = $row['stock'];
                $tbody[] = $row['satuan'];
                $tbody[] = $row['note'];

                $tbody[] = '
                     <button onclick="edit_barang(' . $row['id_barang'] . ')" type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button>
                        <button onclick="deletes(' . $row['id_barang'] . ')" type="button" class="btn btn-danger btn-sm "><i class="fa fa-trash me-2"></i>Delete</button>';

                $data[] = $tbody;
            }
            if ($dataTable) {
                echo json_encode(array('data' => $data));
            } else {
                echo json_encode(array('data' => 0));
            }
        } else {
            $this->output->set_status_header(403);
            show_error('Url tidak di temukan');
        }
    }
    function dataTableStockIn()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            if ($bulan == 0) {
                $filter = 0;
            } else {
                $filter = $bulan;
            }
            $dataTable = $this->models->dataTableStockIn('tbl_in_stock', $filter, $tahun);
            $no = 1;
            foreach ($dataTable as $row) {
                $tbody = array();
                $get_barang = $this->db->get_where('tbl_barang', ['id_barang' => $row['id_barang']])->row_array();
                $tbody[] = $no++;
                $tbody[] = $get_barang['nama_barang'];
                $tbody[] = $row['stock_masuk'];
                $tbody[] = $get_barang['satuan'];
                $tbody[] = date_indo($row['tanggal_masuk']);
                $tbody[] = $row['note'];

                $tbody[] = '
                     <button onclick="edit_stock_masuk(' . $row['id'] . ')" type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button>
                        <button onclick="deletes(' . $row['id'] . ')" type="button" class="btn btn-danger btn-sm "><i class="fa fa-trash me-2"></i>Delete</button>';

                $data[] = $tbody;
            }
            if ($dataTable) {
                echo json_encode(array('data' => $data));
            } else {
                echo json_encode(array('data' => 0));
            }
        } else {
            $this->output->set_status_header(403);
            show_error('Url tidak di temukan');
        }
    }
    function dataTableStockout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            if ($bulan == 0) {
                $filter = 0;
            } else {
                $filter = $bulan;
            }
            $dataTable = $this->models->dataTableStockOut('tbl_out_stock', $filter, $tahun);
            $no = 1;
            foreach ($dataTable as $row) {
                $tbody = array();
                $get_barang = $this->db->get_where('tbl_barang', ['id_barang' => $row['id_barang']])->row_array();
                $tbody[] = $no++;
                $tbody[] = $get_barang['nama_barang'];
                $tbody[] = $row['stock_keluar'];
                $tbody[] = $get_barang['satuan'];
                $tbody[] = date_indo($row['tanggal_keluar']);
                $tbody[] = $row['nama_penerima'];
                $tbody[] = $row['note'];

                $tbody[] = '
                     <button onclick="edit_stock_keluar(' . $row['id'] . ')" type="button" class="btn btn-warning btn-sm "><i class="fa fa-edit me-2"></i>Edit</button>
                        <button onclick="deletes(' . $row['id'] . ')" type="button" class="btn btn-danger btn-sm "><i class="fa fa-trash me-2"></i>Delete</button>';

                $data[] = $tbody;
            }
            if ($dataTable) {
                echo json_encode(array('data' => $data));
            } else {
                echo json_encode(array('data' => 0));
            }
        } else {
            $this->output->set_status_header(403);
            show_error('Url tidak di temukan');
        }
    }

    public function get_data_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById($id, 'id_barang', 'tbl_barang');
            echo json_encode($data);
        }
    }
    public function get_data_in_stock_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById($id, 'id', 'tbl_in_stock');
            echo json_encode($data);
        }
    }
    public function get_data_out_stock_ById($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->models->get_data_ById($id, 'id', 'tbl_out_stock');
            echo json_encode($data);
        }
    }

    public function insertDataBarang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = array(
                'nama_barang' => $this->input->post('nama_barang'),
                'stock' => $this->input->post('stock'),
                'satuan' => $this->input->post('satuan'),
                'note' => $this->input->post('note'),

            );

            $response = $this->models->PostData('tbl_barang', $data);
            echo json_encode($response);
        }
    }
    public function insertInStock()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id_barang = $this->input->post('id_barang');
            $get_barang = $this->db->get_where('tbl_barang', ['id_barang' => $id_barang])->row_array();

            $startStock = $this->input->post('stock_masuk');
            $stockAwal = $get_barang['stock'];
            $newStock = $startStock + $stockAwal;

            $data1 = array(
                'stock' => $newStock,
            );
            $this->db->update('tbl_barang', $data1, array('id_barang' => $this->input->post('id_barang')));
            $data2 = array(
                'id_barang' => $this->input->post('id_barang'),
                'stock_masuk' => $this->input->post('stock_masuk'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'note' => $this->input->post('note'),

            );

            $response = $this->models->PostData('tbl_in_stock', $data2);
            echo json_encode($response);
        }
    }
    public function insertOutStock()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id_barang = $this->input->post('id_barang');
            $get_barang = $this->db->get_where('tbl_barang', ['id_barang' => $id_barang])->row_array();

            $startStock = $this->input->post('stock_keluar');
            $stockAwal = $get_barang['stock'];
            $newStock = $stockAwal - $startStock;

            $data1 = array(
                'stock' => $newStock,
            );
            $this->db->update('tbl_barang', $data1, array('id_barang' => $this->input->post('id_barang')));
            $data2 = array(
                'id_barang' => $this->input->post('id_barang'),
                'stock_keluar' => $this->input->post('stock_keluar'),
                'tanggal_keluar' => $this->input->post('tanggal_keluar'),
                'nama_penerima' => $this->input->post('nama_penerima'),
                'note' => $this->input->post('note'),

            );

            $response = $this->models->PostData('tbl_out_stock', $data2);
            echo json_encode($response);
        }
    }


    public function updateDataBarang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'nama_barang' => $this->input->post('nama_barang'),
                'stock' => $this->input->post('stock'),
                'satuan' => $this->input->post('satuan'),
                'note' => $this->input->post('note'),

            );

            $update = $this->models->updatedata(array('id_barang' => $this->input->post('id')), $data, 'tbl_barang');
            echo json_encode($update);
        }
    }
    public function updateInStock()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id_barang = $this->input->post('id_barang');
            $get_barang = $this->db->get_where('tbl_barang', ['id_barang' => $id_barang])->row_array();

            $old_stock = $this->input->post('old_stock');
            $stockAwal = $get_barang['stock'];
            $newStockup = $stockAwal - $old_stock;

            $startStockup = $this->input->post('stock_masuk');
            $newStock = $startStockup + $newStockup;

            $data1 = array(
                'stock' => $newStock,
            );
            $this->db->update('tbl_barang', $data1, array('id_barang' => $this->input->post('id_barang')));

            $data2 = array(

                'stock_masuk' => $this->input->post('stock_masuk'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
                'note' => $this->input->post('note'),

            );

            $update = $this->models->updatedata(array('id' => $this->input->post('id')), $data2, 'tbl_in_stock');
            echo json_encode($update);
        }
    }

    public function updateOutStock()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id_barang = $this->input->post('id_barang');
            $get_barang = $this->db->get_where('tbl_barang', ['id_barang' => $id_barang])->row_array();

            $old_stock = $this->input->post('old_stock');
            $stockAwal = $get_barang['stock'];
            $newStockup = $stockAwal + $old_stock;

            $startStockup = $this->input->post('stock_keluar');
            $newStock = $newStockup - $startStockup;

            $data1 = array(
                'stock' => $newStock,
            );
            $this->db->update('tbl_barang', $data1, array('id_barang' => $this->input->post('id_barang')));

            $data2 = array(

                'stock_keluar' => $this->input->post('stock_keluar'),
                'tanggal_keluar' => $this->input->post('tanggal_keluar'),
                'nama_penerima' => $this->input->post('nama_penerima'),
                'note' => $this->input->post('note'),

            );

            $update = $this->models->updatedata(array('id' => $this->input->post('id')), $data2, 'tbl_out_stock');
            echo json_encode($update);
        }
    }

    public function delete_data($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $this->models->delete('tbl_barang', 'id_barang', $id);
        }
    }
    public function delete_data_in_stock($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $get_in_stock = $this->db->get_where('tbl_in_stock', ['id' => $id])->row_array();
            $get_barang = $this->db->get_where('tbl_barang', ['id_barang' => $get_in_stock['id_barang']])->row_array();

            $stok_masuk = $get_in_stock['stock_masuk'];
            $stockAwal = $get_barang['stock'];
            $newStockup = $stockAwal - $stok_masuk;

            $data1 = array(
                'stock' => $newStockup,
            );
            $this->db->update('tbl_barang', $data1, array('id_barang' => $get_barang['id_barang']));
            echo $this->models->delete('tbl_in_stock', 'id', $id);
        }
    }
    public function delete_data_out_stock($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $get_out = $this->db->get_where('tbl_out_stock', ['id' => $id])->row_array();
            $get_barang = $this->db->get_where('tbl_barang', ['id_barang' => $get_out['id_barang']])->row_array();

            $stok_masuk = $get_out['stock_keluar'];
            $stockAwal = $get_barang['stock'];
            $newStockup = $stockAwal + $stok_masuk;

            $data1 = array(
                'stock' => $newStockup,
            );
            $this->db->update('tbl_barang', $data1, array('id_barang' => $get_barang['id_barang']));
            echo $this->models->delete('tbl_out_stock', 'id', $id);
        }
    }
    public function print_data_barang()
    {
        $data['title'] = 'DATA STOCK BARANG';
        $data['Stock_barang'] = $this->models->get_dataTable('tbl_barang');
        $this->load->view('admin/stock/print_data_barang', $data);
    }
    public function print_stock_masuk($b, $t)
    {
        if ($b == 0) {
            $filter = 0;
        } else {
            $filter = $b;
        }

        $data['title'] = 'DATA STOCK MASUK BARANG ANUGRAH ALMUNIUM';
        $data['bulan'] = $b;
        $data['tahun'] = $t;
        $data['stock_masuk'] = $this->models->dataTableStockIn('tbl_in_stock', $filter, $t);
        $this->load->view('admin/stock/print_stock_masuk', $data);
    }
    public function print_stock_keluar($b, $t)
    {
        if ($b == 0) {
            $filter = 0;
        } else {
            $filter = $b;
        }

        $data['title'] = 'DATA STOCK KELUAR BARANG ANUGRAH ALMUNIUM';
        $data['bulan'] = $b;
        $data['tahun'] = $t;
        $data['stock_keluar'] = $this->models->dataTableStockOut('tbl_out_stock', $filter, $t);
        $this->load->view('admin/stock/print_stock_keluar', $data);
    }
    public function export_pdf_data_barang()
    {
        $this->load->library('pdfgenerator');

        $this->data['title_pdf'] = 'DATA STOCK BARANG';
        $this->data['Stock_barang'] = $this->models->get_dataTable('tbl_barang');

        $file_pdf = 'DATA STOCK BARANG-' . date_indo(date('Y-m-d'));
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('admin/stock/export_pdf_data_barang', $this->data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
    public function export_pdf_stock_masuk_barang($b, $t)
    {
        $this->load->library('pdfgenerator');
        if ($b == 0) {
            $filter = 0;
        } else {
            $filter = $b;
        }
        $this->data['title_pdf'] = 'DATA STOCK BARANG';
        $this->data['stock_masuk'] = $this->models->dataTableStockIn('tbl_in_stock', $filter, $t);
        $this->data['bulan'] = $b;
        $this->data['tahun'] = $t;
        $file_pdf = 'DATA STOCK MASUK BARANG-' . $b . '' . $t;
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('admin/stock/export_pdf_stock_masuk_barang', $this->data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
    public function export_pdf_stock_keluar($b, $t)
    {
        $this->load->library('pdfgenerator');
        if ($b == 0) {
            $filter = 0;
        } else {
            $filter = $b;
        }
        $this->data['title_pdf'] = 'DATA STOCK BARANG';
        $this->data['stock_keluar'] = $this->models->dataTableStockOut('tbl_out_stock', $filter, $t);
        $this->data['bulan'] = $b;
        $this->data['tahun'] = $t;
        $file_pdf = 'DATA STOCK KELUAR BARANG-' . $b . '' . $t;
        $paper = 'A4';
        $orientation = "landscape";
        $html = $this->load->view('admin/stock/export_pdf_stock_keluar_barang', $this->data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }


















    public function export_excel_all_nota($b, $t)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach (range('A', 'F') as $coulumID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($coulumID)->setAutosize(true);
        }
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'NAMA');
        $sheet->setCellValue('C1', 'USERNAME');

        if (
            $b == 0
        ) {
            $filter = 0;
        } else {
            $filter = $b;
        }

        // $projek = $this->models->dataTable();
        $nota_transaksi = $this->models->get_transaksi('ref_transaksi', $filter, $t);

        $x = 2; //start from row 2
        $no = 1;
        foreach ($nota_transaksi as $row) {

            $sheet->setCellValue('A' . $x, $no++);
            $sheet->setCellValue('B' . $x, $row['nama_transaksi']);
            $sheet->setCellValue('C' . $x, $row['tanggal_transaksi']);
            $x++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'DATA-NOTA-TRANSAKSI-' . $b . '-' . $t . '.xlsx';
        $writer->save($fileName);  //this is for save in folder


        /* for force download */
        header('Content-Type: appliction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        $writer->save('php://output');
        /* force download end */
    }
}
