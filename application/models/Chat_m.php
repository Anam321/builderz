<?php defined('BASEPATH') or exit('No direct script access allowed');

class Chat_m extends CI_Model
{



    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_users($exclude_id)
    {
        $this->db->where('id !=', $exclude_id);
        return $this->db->get('users')->result();
    }

    public function get_data_ById($id)
    {
        $this->db->select("*");
        $this->db->from('users');
        $this->db->where('id', $id);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }
    public function get_unread_count($user_id)
    {
        $this->db->select('user_from, COUNT(*) as unread_count');
        $this->db->where('user_to', $user_id);
        $this->db->where('is_read', 0);
        $this->db->group_by('user_from');

        return $this->db->get('chats')->result();
    }
    public function mark_as_read($user_from, $user_to)
    {
        $this->db->where('user_from', $user_from);
        $this->db->where('user_to', $user_to);
        $this->db->where('is_read', 0);
        $this->db->update('chats', ['is_read' => 1]);
    }
    public function get_messages($user_from, $user_to)
    {
        $this->db->where("(user_from = $user_from AND user_to = $user_to) OR (user_from = $user_to AND user_to = $user_from)");
        $this->db->order_by('timestamp', 'ASC');

        $messages = $this->db->get('chats')->result();

        // Format timestamp sebelum dikirim ke frontend
        foreach ($messages as &$msg) {
            $msg->formatted_time = date("H:i", strtotime($msg->timestamp)); // Format HH:MM (24 Jam)
        }

        return $messages;
    }

    public function insert_message($data)
    {
        return $this->db->insert('chats', $data);
    }
}
