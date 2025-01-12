<?php defined('BASEPATH') or exit('No direct script access allowed');

class Slide_m extends CI_Model
{

    var $table = 'set_slide'; //nama tabel dari database
    var $column_order = array(null, null, 'title', null,  null, null); //field yang ada di table user
    var $column_search = array('title'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'asc'); // default order 

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->database();
    // }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function PostData($data)
    {
        $r = $this->db->insert('pages_portfolio', $data);
        if ($r) {
            $res['status'] = '00';
            $res['type'] = 'success';
            $res['mess'] = 'Success Input Data';
        } else {
            $res['status'] = '01';
            $res['type'] = 'warning';
            $res['mess'] = 'Error Input Data, please try again...';
        }
        return $res;
    }
    public function get_service()
    {
        $query = $this->db->get('s_service')->result();
        return $query;
    }

    public function get_data_ById($val)
    {
        $this->db->select("*");
        $this->db->from('set_slide');
        $this->db->where('id', $val);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    public function update($id)
    {
        $slug = str_replace(' ', '-', $this->input->post('title'));
        $id = array('id' => $this->input->post('id'));
        if (!empty($_FILES["gambar"]["name"])) {
            $config['upload_path'] = './assets/upload/img/';
            $config['file_name'] = time();
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['overwrite'] = true;
            $config['max_size'] = 1024; // 1MB

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar')) {
                $res['status'] = '01';
                $res['type'] = 'error';
                $res['mess'] = 'Upload error. double check the photo file or photo size!';

                return ($res);
            } else {
                $image_data = $this->upload->data();
                //direktori file
                $path = './assets/upload/img/';
                $filename = $this->input->post('old_gambar');
                //hapus file
                if (file_exists($path . $filename)) {
                    unlink($path . $filename);
                }

                $data = array(
                    'gambar' => $image_data['file_name'],
                    'link' =>  $this->input->post('link'),
                    'title' => $this->input->post('title'),
                    'desk' => $this->input->post('desk'),

                );
            }
        } else {
            $data = array(
                'link' =>  $this->input->post('link'),
                'title' => $this->input->post('title'),
                'desk' => $this->input->post('desk'),

            );
        }

        $r = $this->db->update('set_slide', $data, $id);
        if ($r) {
            $res['status'] = '00';
            $res['type'] = 'success';
            $res['mess'] = 'Success Update Data';
        } else {
            $res['status'] = '01';
            $res['type'] = 'warning';
            $res['mess'] = 'Error Update Data, please try again...';
        }
        return $res;
    }
}
