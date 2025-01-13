<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Message extends CI_Controller
{
    function waktu_lalu($timestamp)
    {
        $selisih = time() - strtotime($timestamp);
        $detik = $selisih;
        $menit = round($selisih / 60);
        $jam = round($selisih / 3600);
        $hari = round($selisih / 86400);
        $minggu = round($selisih / 604800);
        $bulan = round($selisih / 2419200);
        $tahun = round($selisih / 29030400);
        if ($detik <= 60) {
            $waktu = $detik . ' detik yang lalu';
        } else if ($menit <= 60) {
            $waktu = $menit . ' menit yang lalu';
        } else if ($jam <= 24) {
            $waktu = $jam . ' jam yang lalu';
        } else if ($hari <= 7) {
            $waktu = $hari . ' hari yang lalu';
        } else if ($minggu <= 4) {
            $waktu = date_indo($timestamp);
        } else if ($bulan <= 12) {
            $waktu = date_indo($timestamp);
        } else {
            $waktu = date_indo($timestamp);
        }
        return $waktu;
    }
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Message_m', 'models');
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

        $data['metaTitle'] = 'Message';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/message/index';

        $this->load->view('main', $data);
    }


    public function detail($id)
    {

        $hits = array('hit' => 0);
        $this->models->update(array('id' => $id), $hits);

        $data['metaTitle'] = 'Detail Message';
        $data['componen'] = $this->componen();
        $data['conten'] = 'admin/message/detail';
        $data['message'] = $this->models->message_detail('ref_message', $id);
        $this->load->view('main', $data);
    }

    public function list()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datalist = $this->models->data_message('ref_message');

            $data = array();

            foreach ($datalist as $row) {
                if ($row->hit == 1) {
                    $badge = 'unread';
                } else {
                    $badge = '';
                }
                $list = '<inbox>
                            <inbox-list>
                          
                                <message-item class="' . $badge . '">
                               
                               
                               
                                       <a href="' . base_url('admin/message/detail/') . '' . $row->id . '"><header>
                                        <div class="sender-info">
                                            <span class="subject">' . $row->nama . '</span>
                                            <span class="from">' . $row->subject . '</span>
                                        </div>
                                        <span class="time">' .  $this->waktu_lalu($row->date) . '</span>
                                    </header>
                                    <main>
                                        <p>' . word_limiter($row->message, 25)  . '</p>
                                    </main> </a>
                                </message-item>
                               
                            </inbox-list>
                        </inbox>';

                $data[] = $list;
            }

            echo json_encode($data);
        }
    }


    public function delete_data($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo $this->models->delete($id);
        }
    }
}
