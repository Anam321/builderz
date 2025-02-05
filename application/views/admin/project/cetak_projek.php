<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 11px;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* #table tr:nth-child(even) {
            background-color: #f2f2f2;
        } */

        /* #table tr:hover {
            background-color: #ddd;
        } */

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #3C5B6F;
            color: white;
        }
    </style>
</head>

<body>
    <div style="text-align:center">
        <h2> <?= $title_pdf ?></h2>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th style="text-align: center; vertical-align: middle;">No.</th>
                <th style="text-align: center; vertical-align: middle;">NAMA PROJECT</th>
                <th style="text-align: center; vertical-align: middle;">NAMA CLIENT</th>
                <th style="text-align: center; vertical-align: middle;">ALAMAT</th>
                <th style="text-align: center; vertical-align: middle;">VOLUME</th>
                <th style="text-align: center; vertical-align: middle;">ANGGARAN</th>
                <th style="text-align: center; vertical-align: middle;">TIMELINE</th>
                <th style="text-align: center; vertical-align: middle;">TANGGAL MULAI</th>
                <th style="text-align: center; vertical-align: middle;">TANGGAL AKHIR</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($projek as $pk) : ?>
                <?php
                $awal  = new DateTime($pk->tgl_mulai);
                $akhir = new DateTime($pk->tgl_akhir);
                $diff  = date_diff($awal, $akhir);

                $timeline = $diff->format('%a hari');
                ?>
                <tr>
                    <td scope="row"><?= $no++ ?></td>
                    <td><?= $pk->nama_projek ?></td>
                    <td><?= $pk->nama_client ?></td>
                    <td><?= $pk->alamat ?></td>
                    <td><?= $pk->volume ?></td>
                    <td>Rp. <?= number_format($anggaran) ?></td>
                    <td><?= $timeline ?></td>
                    <td><?= date_indo($pk->tgl_mulai) ?></td>
                    <td><?= date_indo($pk->tgl_akhir) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>