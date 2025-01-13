<?php
header('Content-type: application/xml; charset="ISO-8859-1"', true);
$datetime1 = new DateTime(date('Y-m-d H:i:s'));
?>


<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <?php foreach ($portfolio as $B) : ?>
        <url>
            <loc><?php echo base_url('project/') . $B->slug ?></loc>
            <lastmod><?= $datetime1->format(DATE_ATOM); ?></lastmod>
            <priority>0.5</priority>
            <changefreq>daily</changefreq>
        </url>
    <?php endforeach ?>
</urlset>