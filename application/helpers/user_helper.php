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


function check_user_role($allowed_roles = [])
{
    $ci = get_instance();

    // Pastikan user sudah login
    if (!$ci->session->userdata('username')) {
        redirect(base_url('app-admin/login'));
    }

    // Ambil role user dari session
    $user_role = $ci->session->userdata('role_id');
    $user_id = $ci->session->userdata('id');

    // Cek apakah role user ada dalam daftar yang diizinkan
    if (!in_array($user_role, $allowed_roles)) {
        show_error('Anda tidak memiliki akses ke halaman ini.', 403);
    }
    $ci->db->where('id', $user_id)->update('users', ['last_activity' => date('Y-m-d H:i:s')]);
}

function jabatan($x)
{
    $ci = get_instance();
    $j = $ci->db->get_where('users_jabatan', ['slug' => $x])->row_array();
    $y = $j['jabatan'];
    return $y;
}

function get_db($table)

{
    $ci = get_instance();
    $ci->db->where('active', 0);
    $ci->db->order_by('id', 'DESC');
    $q = $ci->db->get($table)->result();
    return $q;
}
