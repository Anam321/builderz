<?php defined('BASEPATH') or exit('No direct script access allowed');

class Ncp_m extends CI_Model
{

    public function get_nicePages($where)
    {

        $query = $this->db->get_where('pages_seo', ['pages' => $where])->row_array();
        return $query;
    }
    public function get_data_ById($val)
    {
        $this->db->select("*");
        $this->db->from('pages_seo');
        $this->db->where('pages', $val);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    public function update($id)
    {


        if (!empty($_FILES["images"]["name"])) {
            $config['upload_path'] = './assets/upload/img/';
            $config['file_name'] = time();
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
                $path = './assets/upload/img/';
                $filename = $this->input->post('old_images');
                if (file_exists($path . $filename)) {
                    unlink($path . $filename);
                }

                $data = array(
                    'images' => $image_data['file_name'],
                    'title_seo' => $this->input->post('title'),
                    'deskripsi_seo' => $this->input->post('desk'),
                    'keyword_seo' => $this->input->post('keyword_seo'),
                );
            }
        } else {
            $data = array(
                'title_seo' => $this->input->post('title'),
                'deskripsi_seo' => $this->input->post('desk'),
                'keyword_seo' => $this->input->post('keyword_seo'),

            );
        }
        // print_r($data);
        $p = $this->input->post('pages');
        $r = $this->db->update('pages_seo', $data, $id);
        if ($r) {
            $res['status'] = '00';
            $res['pages'] = $p;
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
