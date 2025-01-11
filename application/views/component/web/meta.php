<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $app = $this->db->get_where('set_app', ['id' => 1])->row_array(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $metaTitle ?></title>
<meta content="<?= $metaKey ?>" name="keywords" />
<meta content="<?= $metaDesk ?>" name="description" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<meta name="robots" content="all, index, follow" />
<meta name="author" content="CV.ANUGRAH ALMUNIUM" />
<meta http-equiv="Content-Language" content="id-ID" />
<meta NAME="Distribution" CONTENT="Global" />

<link rel="canonical" href="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />


<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= $metaTitle ?>">
<meta name="twitter:description" content="<?= $metaDesk ?>">
<meta name="twitter:image" content="<?= $og_images_alt ?>">


<meta name="og:description" content="<?= $metaDesk ?>" data-dynamic="true" />
<meta name="og:image" content="<?= $og_images ?>" data-dynamic="true">
<meta name="og:image:alt" content="<?= $og_images_alt ?>" data-dynamic="true" />
<meta name="og:image:height" content="630" data-dynamic="true" />
<meta name="og:image:secure_url" content="<?= $og_images_alt ?>" data-dynamic="true" />
<meta name="og:image:width" content="1200" data-dynamic="true" />
<meta name="og:locale" content="en_US" data-dynamic="true" />
<meta name="og:site_name" content="<?= $og_images_alt ?>" data-dynamic="true" />
<meta name="og:title" content="<?= $metaTitle ?>" data-dynamic="true" />
<meta name="og:type" content="website" data-dynamic="true" />
<meta name="og:url" content="<?= $author ?>" data-dynamic="true" />

<meta name="geo.region" content="indonesia" />
<meta name="twitter:card" content="summary_large_image" />