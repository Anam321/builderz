<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $app = $this->db->get_where('set_app', ['id' => 1])->row_array(); ?>

<head>
    <title><?= $title_pdf ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/upload/img/<?= $app['favicon'] ?>" />

    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>assets/upload/img/<?= $app['favicon'] ?>" />
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/backend/lib/print/css/960.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/lib/print/css/screen.css" type="text/css"
        media="screen" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/lib/print/css/print.css" type="text/css"
        media="print" />
    <link rel="shortcut icon" href="<?= base_url() ?>assets/upload/logo/" />
    <script src="<?= base_url() ?>assets/backend/lib/print/js/jquery.tools.min.js"></script>
    <script src="<?= base_url() ?>assets/backend/lib/print/js/jquery.print-preview.js" type="text/javascript"
        charset="utf-8"></script> -->

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 2px;
            padding: 2px;
            background: #fff;
            color: #000;
            font-size: 12px;
            font-family: cambria, "times new roman", arial;
        }

        h1 {
            font-size: 18px;
        }

        h3 {
            font-size: 18px;
        }

        h4 {
            font-size: 14px;
        }

        h5 {
            font-size: 13px;
        }

        label {
            display: inline-block;
        }

        .nowrap {
            white-space: nowrap;
        }

        #body {
            padding: 0px;
        }

        #ktp {
            width: 500px;
            margin: 0px;
            border: 2px solid #000;
            padding: 5px;
        }

        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin: -5px auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table.border {
            border: 1px solid #000;
        }

        table.border.thick {
            border: 2px solid #000;
        }

        table.data {
            font-size: 12px;
        }

        table.border tr {
            border-bottom: 1px solid #aaa;
        }

        tr.thick,
        thead tr.thick {
            border-bottom: 2px solid #000 !important;
        }

        table.border td {
            padding: 2px 5px;
            border: 1px solid #aaa !important;
        }

        th {
            text-transform: uppercase;
            padding: 2px;
            border: 1px solid #000 !important;
            background: #eee;
        }

        tr.footer {
            text-transform: uppercase;
            font-weight: bold;
            padding: 2px;
            border-top: 1px solid #000 !important;
            background: #eee;
        }

        th.thick,
        td.thick {
            border: solid #000;
            border-width: 0 2px;
        }

        td.top {
            vertical-align: top;
        }

        table.noborder * {
            border: none !important;
        }

        td.bilangan,
        th.bilangan,
        td.no_urut {
            text-align: center;
        }

        img.logo {
            width: 100px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .judul {
            text-transform: uppercase;
            text-align: center;
        }

        th.padat,
        td.padat {
            width: 1px;
            white-space: nowrap;
            text-align: center;
        }

        .text-center,
        th {
            text-align: center;
        }

        td.textx {
            mso-number-format: "\@";
        }

        hr.garis {
            border-bottom: 2px solid #000000;
            height: 0px;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .textx {
            mso-number-format: "\@";
        }

        td,
        th {
            font-size: 9pt;
        }

        table#ttd td {
            text-align: center;
            white-space: nowrap;
        }

        .underline {
            text-decoration: underline;
        }

        #print-modal {
            background: #FFF;
            position: absolute;
            left: 50%;
            margin: 0 0 0 -465px;
            padding: 0 68px;
            width: 794px;
            box-shadow: 0 0 20px #000;
            -moz-box-shadow: 0 0 20px #000;
            -webkit-box-shadow: 0 0 10px #000;
        }

        hr {
            border: 2px;
            color: #000;
            background: #000;
            height: 1px;
        }

        #print-modal-content {
            margin: 68px 0;
            border: none;
            height: 100%;
            overflow: hidden;
            width: 100%;
        }

        #print-modal-controls {
            border: 1px solid #ccc;
            border-radius: 8px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            top: 15px;
            left: 50%;
            margin: 0 0 0 -81px;
            position: fixed;
            padding: 5px 0;
            background: rgba(250, 250, 250, 0.75);
        }

        #print-modal-controls a {
            color: #FFF;
            display: block;
            float: left;
            height: 32px;
            text-decoration: none;
            text-indent: -999em;
            width: 80px;
        }

        #print-modal-controls a:hover {
            opacity: 0.75;
        }

        #print-modal-controls a.print {
            background: url(../images/icon-print.png) no-repeat 50% 50%;
        }

        #print-modal-controls a.close {
            background: url(../images/icon-close.png) no-repeat 50% 50%;
        }
    </style>

    <!-- TODO: Pindahkan ke external css -->
    <style>
        .textx {
            mso-number-format: "\@";
        }

        td,
        th {
            font-size: 6.5pt;
            mso-number-format: "\@";
        }
    </style>
</head>

<body>
    <div id="container">
        <!-- Print Body -->
        <div id="body">
            <?php if ($bulan == '0') {
                $b = 'All Bulan';
            } elseif ($bulan == '01') {
                $b = 'Januari';
            } elseif ($bulan == '02') {
                $b = 'Februari';
            } elseif ($bulan == '03') {
                $b = 'Maret';
            } elseif ($bulan == '04') {
                $b = 'April';
            } elseif ($bulan == '05') {
                $b = 'Mei';
            } elseif ($bulan == '06') {
                $b = 'Juni';
            } elseif ($bulan == '07') {
                $b = 'Juli';
            } elseif ($bulan == '08') {
                $b = 'Agustus';
            } elseif ($bulan == '09') {
                $b = 'September';
            } elseif ($bulan == '10') {
                $b = 'Oktober';
            } elseif ($bulan == '11') {
                $b = 'November';
            } elseif ($bulan == '12') {
                $b = 'Desember';
            } ?>
            <div class="header" align="center">
                <br>
                <br>
                <h3>Data Stock Keluar Barang</h3>
                <h3>Bulan <?= $b ?> / <?= $tahun ?></h3>
                <label align="left"><?= $app['nama_web'] ?> : <?= $app['alamat'] ?> </label>
                <br>
                <br>
            </div>
            <br>
            <table class="border thick">
                <thead>
                    <tr class="border thick">
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Stock</th>
                        <th>Satuan</th>
                        <th>Tanggal Stock Masuk</th>
                        <th>Nama Penerima</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($stock_keluar as $row): ?>
                        <?php $q = $this->db->get_where('tbl_barang', ['id_barang' => $row['id_barang']])->row_array(); ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $q['nama_barang'] ?></td>
                            <td><?= $row['stock_keluar'] ?></td>
                            <td><?= $q['satuan'] ?></td>
                            <td><?= date_indo($row['tanggal_keluar'])  ?></td>
                            <td><?= $row['nama_penerima'] ?></td>
                            <td><?= $row['note'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <br>

        <label>Tanggal cetak : &nbsp; </label>
        <?= date_indo(date('Y-m-d')) ?>
    </div>



</body>

</html>