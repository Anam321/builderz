<?php defined('BASEPATH') or exit('No direct script access allowed');

class Portfolio_m extends CI_Model
{

    var $table = 's_portfolio'; //nama tabel dari database
    var $column_order = array(null, 'foto', 'title', null,  null); //field yang ada di table user
    var $column_search = array('foto', 'title'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

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
        $r = $this->db->insert('s_portfolio', $data);
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
    public function update($id)
    {
        $slug = str_replace(' ', '-', $this->input->post('title'));
        $id = array('id' => $this->input->post('id'));
        if (!empty($_FILES["images"]["name"])) {
            $config['upload_path'] = './assets/upload/img/';
            $config['file_name'] = strtolower($slug);
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['overwrite'] = true;
            $config['max_size'] = 1024; // 1MB

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('images')) {
                $res['status'] = '01';
                $res['type'] = 'error';
                $res['mess'] = 'Upload error. double check the photo file or photo size!';

                return ($res);
            } else {
                $image_data = $this->upload->data();
                //direktori file
                $path = './assets/upload/img/';
                $filename = $this->input->post('old_images');
                //hapus file
                if (file_exists($path . $filename)) {
                    unlink($path . $filename);
                }

                $data = array(
                    'images' => $image_data['file_name'],
                    'link' => strtolower($slug),
                    'title' => $this->input->post('title'),
                    'desk' => $this->input->post('desk'),
                    'keyword' => $this->input->post('keyword'),
                    'video' => $this->input->post('video'),
                );
            }
        } else {
            $data = array(
                'link' => strtolower($slug),
                'title' => $this->input->post('title'),
                'desk' => $this->input->post('desk'),
                'keyword' => $this->input->post('keyword'),
                'video' => $this->input->post('video'),
            );
        }

        $r = $this->db->update('pages_portfolio', $data, $id);
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
    public function delete($id)
    {

        $q = $this->db->query("select images from pages_portfolio where id = '$id'")->row();
        $foto = $q->images;

        // var_dump($foto);

        $path = './assets/upload/img/';
        // hapus file
        if (file_exists($path . $foto)) {
            unlink($path . $foto);
        }


        $this->db->where('id', $id);
        $r = $this->db->delete('pages_portfolio');

        if ($r) {
            $res['status'] = '00';
            $res['type'] = 'success';
            $res['mess'] = 'Succes Delete Data';
        } else {
            $res['status'] = '01';
            $res['type'] = 'warning';
            $res['mess'] = 'Error Delete Data';
        }
        return json_encode($res);
    }



    public function select_projek($table)
    {

        $this->db->select('*');
        $this->db->from($table);

        $this->db->order_by('id_projek', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_images($url)
    {
        $data = $this->get_data_projek('pages_portfolio a', $url);
        $id = $data['id_projek'];

        $this->db->where('id_projek', $id);
        $query = $this->db->get('ref_projek_images')->result();
        return $query;
    }

    public function get_data($limit, $start)
    {

        $this->db->order_by('id', 'DESC');
        return $this->db->get('pages_portfolio', $limit, $start)->result();
    }
    public function get_countblogLimit()
    {
        return $this->db->get('pages_portfolio')->num_rows();
    }
    public function getByid($tabel, $where, $value)
    {

        $query = $this->db->get_where($tabel, [$where => $value])->row_array();
        return $query;
    }
    public function get_data_testimoni($table)
    {

        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('ref_projek b', 'a.id_projek=b.id_projek');

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_data_projek($table, $where)
    {

        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('ref_projek b', 'a.id_projek=b.id_projek');
        $this->db->where('link', $where);
        $this->db->limit(6);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->row_array();
        return $query;
    }
}
