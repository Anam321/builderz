<?php


function AppIdentitas($x)

{
    $ci = get_instance();

    $appData = $ci->db->get_where('set_app', ['id' => 1])->row_array();
    if ($x == 'logo') {
        $y = $appData['logo'];
    } elseif ($x == 'tlp') {
        $y = $appData['notlp'];
    } elseif ($x == 'email') {
        $y = $appData['email'];
    } elseif ($x == 'favicon') {
        $y = $appData['favicon'];
    } elseif ($x == 'title') {
        $y = $appData['title'];
    } elseif ($x == 'keyword') {
        $y = $appData['keyword'];
    } elseif ($x == 'tentang') {
        $y = $appData['tentang'];
    } elseif ($x == 'site') {
        $y = $appData['site'];
    } elseif ($x == 'nama_web') {
        $y = $appData['nama_web'];
    } elseif ($x == 'alamat') {
        $y = $appData['alamat'];
    } elseif ($x == 'lokasi') {
        $y = $appData['lokasi'];
    } elseif ($x == 'map') {
        $y = $appData['map'];
    }

    return $y;
}
function medsos($x)

{
    $ci = get_instance();

    $media = $ci->db->get_where('set_app_medsos', ['media' => $x])->row_array();
    if ($x == 'Facebook') {
        $y = $media['link'];
    } elseif ($x == 'Instagram') {
        $y = $media['link'];
    } elseif ($x == 'Youtube') {
        $y = $media['link'];
    }

    return $y;
}
function whatsappNav($x)

{
    $ci = get_instance();

    $appData = $ci->db->get_where('whatsap_navigasi', ['id' => 1])->row_array();
    if ($x == 'no') {
        $y = $appData['no'];
    } elseif ($x == 'title') {
        $y = $appData['text_title'];
    } elseif ($x == 'pesan') {
        $y = $appData['pesan'];
    }
    return $y;
}

function kategori($x, $y)

{
    $ci = get_instance();

    $catData = $ci->db->get_where('post_category', ['id' => $x])->row_array();
    if ($y == 'kategori') {
        $data = $catData['category'];
    } elseif ($y == 'slug') {
        $data = $catData['slug'];
    }
    return $data;
}
