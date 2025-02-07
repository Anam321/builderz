<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'app';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['app-admin/login'] = 'auth/index';
$route['app-admin/logout'] = 'auth/logout';

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
$route['app-admin/pages_seo'] = 'admin/pages_seo';

$route['app-admin/service'] = 'admin/service';
$route['app-admin/service/form'] = 'admin/service/form';
$route['app-admin/service/edit/(:any)'] = 'admin/service/edit/$1';

$route['app-admin/slider'] = 'admin/slider';
$route['app-admin/features'] = 'admin/features';

$route['app-admin/quote'] = 'admin/quote';
$route['app-admin/request'] = 'admin/request';

$route['app-admin/message'] = 'admin/message';
$route['app-admin/project'] = 'admin/project';
$route['app-admin/stock/data_barang'] = 'admin/stock/data_barang';
$route['app-admin/stock/in_stock'] = 'admin/stock/in_stock';
$route['app-admin/stock/out_stock'] = 'admin/stock/out_stock';
$route['app-admin/client'] = 'admin/client';
$route['app-admin/app'] = 'admin/app';
$route['app-admin/app_medsos'] = 'admin/app_medsos';
$route['app-admin/users'] = 'admin/users';
$route['app-admin/portfolio'] = 'admin/portfolio';
$route['app-admin/whatsnav'] = 'admin/whatsnav';
$route['app-admin/whatsnav'] = 'admin/whatsnav';

$route['app-admin/profile'] = 'admin/profile/index';
$route['app-admin/profile/edit'] = 'admin/profile/edit';
$route['app-admin/profile/edit_akun'] = 'admin/profile/edit_akun';

$route['sitemap-post\.xml'] = "Sitemap_post/index";
$route['sitemap-portfolio\.xml'] = "Sitemap_post/portfolio";
$route['sitemap-service\.xml'] = "Sitemap_post/service";
$route['sitemap-pages\.xml'] = "Sitemap_post/pages";
