<?php defined('BASEPATH') or exit('No direct script access allowed');

class Post_m extends CI_Model
{

    var $table = 'post'; //nama tabel dari database
    var $column_order = array(null, 'images', 'title', 'date_post', 'publik', null); //field yang ada di table user
    var $column_search = array('images', 'title', 'date_post', 'publik'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awalpost
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
        $r = $this->db->insert('post', $data);
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



    // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< DATA MODEL FRON END >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< DATA MODEL FRON END >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< DATA MODEL FRON END >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>



    function check_visitor($ip, $user_agent, $date)
    {
        $this->db->where('ip', $ip);
        $this->db->where('user_agent', $user_agent);
        $this->db->where('date', $date);
        $query = $this->db->get('pages_blog_visitors');

        return $query->num_rows() > 0;
    }


    public function get_data($limit, $start)
    {
        $this->db->where('publik', 1);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('pages_blog', $limit, $start)->result();
    }
    public function get_databyurl($table, $where, $url, $ordey, $rol)
    {
        $this->db->where('publik', 1);
        if ($rol == 'coment') {
            $this->db->where($where, $url);
        }

        $this->db->order_by($ordey, 'DESC');
        return $this->db->get($table)->result();
    }
    public function get_populer_blog($table)
    {
        $this->db->limit('20');
        $this->db->order_by('visitor', 'DESC');
        return $this->db->get($table)->result();
    }
    public function get_countblogLimit()
    {
        $this->db->where('publik', 1);
        return $this->db->get('pages_blog')->num_rows();
    }

    public function getByid($tabel, $where, $value)
    {

        $query = $this->db->get_where($tabel, [$where => $value])->row_array();
        return $query;
    }
    public function get_jmlcom($url)
    {

        $this->db->where('publik', 1);
        $this->db->where('blog', $url);
        $this->db->order_by('id', 'DESC');
        return $this->db->get('pages_blog_coment')->num_rows();
    }
    public function insertData()
    {
        $data = array(
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'web' => htmlspecialchars($this->input->post('web', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'coment' => htmlspecialchars($this->input->post('coment', true)),
            'blog' => htmlspecialchars($this->input->post('blog', true)),
            'date' => date('Y-m-d H:i:s'),
            'publik' => 1,
        );

        $r = $this->db->insert('pages_blog_coment', $data);
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

    public function update($id, $data)
    {

        $r = $this->db->update('post', $data, $id);
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
    public function switch($id, $data)
    {

        $this->db->where('id', $id);
        $r = $this->db->update('pages_blog', $data);
        if ($r) {
            $res['status'] = '00';
            $res['type'] = 'success';
            $res['mess'] = 'Data Berhasil Update';
        } else {
            $res['status'] = '01';
            $res['type'] = 'warning';
            $res['mess'] = 'Gagal Update Data';
        }
        return $res;
    }
    public function delete($id)
    {

        $q = $this->db->query("select images from pages_blog where id = '$id'")->row();
        $foto = $q->images;

        // var_dump($foto);

        $path = './assets/upload/blog/';
        // hapus file
        if (file_exists($path . $foto)) {
            unlink($path . $foto);
        }


        $this->db->where('id', $id);
        $r = $this->db->delete('pages_blog');

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
}
