<?php


function is_logged_in()

{
    $ci = get_instance();

    if (!$ci->session->userdata('username')) {
        redirect(base_url('app-admin/login'));
    } else {
        $role_id = $ci->session->userdata('role');
        $menu = $ci->session->userdata('role');
    }
}
function role_superadmin()

{
    $ci = get_instance();

    if ($ci->session->userdata('role_id') != 1) {
        $ci->output->set_status_header(403);
        show_error('Halaman Tidak di kenal');
    }
}

function get_db($table)

{
    $ci = get_instance();
    $ci->db->where('active', 0);
    $ci->db->order_by('id', 'DESC');
    $q = $ci->db->get($table)->result();
    return $q;
}
