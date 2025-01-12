<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'app';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['app-admin/login'] = 'auth/index';


$route['request/PostData'] = 'kontak/requestService';
$route['request/sendMessage'] = 'kontak/sendMessage';
$route['tentang'] = 'about/index';
$route['jasa'] = 'service/index';
$route['kontak'] = 'kontak/index';
$route['whatsapp/navigasi'] = 'kontak/whatsappNavigasi';

$route['jasa/(:any)'] = 'service/detail/$1';
$route['project/(:any)'] = 'project/detail/$1';
$route['blog/(:any)'] = 'blog/detail/$1';
$route['kategori/(:any)'] = 'blog/kategori/$1';
$route['request/download/pdf/(:any)'] = 'service/downloadFile/$1';


$route['app-admin/post/post_list'] = 'admin/post/index';
$route['app-admin/post/form'] = 'admin/post/form';
$route['app-admin/post/edit/(:any)'] = 'admin/post/edit/$1';

$route['app-admin/post/kategori'] = 'admin/post/kategori';
$route['app-admin/post/form_kategori'] = 'admin/post/form_kategori';
$route['app-admin/post/kategori/edit/(:any)'] = 'admin/post/editkategori/$1';

$route['app-admin/about'] = 'admin/about';
