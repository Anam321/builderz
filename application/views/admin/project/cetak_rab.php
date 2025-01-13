<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAB <?= $projek['nama_projek'] ?></title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        /* #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        } */

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
            background-color: #6c757d;
            color: white;
        }

        .border {
            border: 1px solid #ddd;
            padding: 5px;
        }

        .bt {
            border-top: 1px solid #ddd;
            padding: 5px;
        }

        .bb {
            border-bottom: 1px solid #ddd;
            padding: 5px;
        }

        .l_border {
            border-left: 1px solid #ddd;
            padding: 5px;
        }

        .r_border {
            border-right: 1px solid #ddd;
            padding: 5px;
        }

        .total {
            background-color: #FFEE58;
            color: #212121;
            padding: 5px;

        }
    </style>
</head>

<body>
    <div style="text-align:center">
        <h2>RAB <?= $projek['nama_projek'] ?></h2>
    </div>
    <table id="table">
        <thead>
            <tr style="height: 50px;">
                <th style="text-align: center; vertical-align: middle;" class="border">#</th>
                <th style="text-align: center; vertical-align: middle;" class="border">URAIAN PEKERJAAN</th>
                <th style="text-align: center; vertical-align: middle;" class="border">SPESIFIKASI BAHAN</th>
                <th style="text-align: center; vertical-align: middle;" class="border">VOLUME</th>
                <th style="text-align: center; vertical-align: middle;" class="border">SATUAN</th>
                <th style="text-align: center; vertical-align: middle;" class="border">HARGA SATUAN</th>
                <th style="text-align: center; vertical-align: middle;" class="border">TOTAL HARGA</th>

            </tr>
        </thead>
        <tbody>
            <?php $ab = 'A';
            $sub_total = 0;
            foreach ($uraian as $field) : ?>
                <tr>
                    <td class="l_border">
                    </td>
                    <td style="border: none; padding:10px;">
                        <?= $ab++ ?>. <?= $field->uraian ?>
                    <td style="border: none; ">
                    </td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td class="r_border"></td>
                </tr>
                <?php $no = 1;
                $total = 0;

                $this->db->where('id_uraian', $field->id);
                $query = $this->db->get('ref_projek_rab')->result();
                foreach ($query as $row) : ?>
                    <tr>
                        <td class="border"><?= $no++ ?></td>
                        <td class="border"><?= $row->uraian ?></td>
                        <td class="border"><?= $row->spesifikasi_bahan ?></td>
                        <td class="border"><?= $row->vol ?></td>
                        <td class="border"><?= $row->satuan ?></td>
                        <td class="border">Rp. <?= number_format($row->harga_satuan) ?></td>
                        <td class="border">Rp. <?= number_format($row->tot_harga) ?></td>
                    </tr>
                    <?php $total += $row->tot_harga; ?>
                <?php endforeach ?>


                <tr>
                    <td class="l_border bb"></td>
                    <td class="bb"></td>
                    <td class="bb"></td>
                    <td class="bb"></td>
                    <td class="bb"></td>
                    <td class="bb"></td>
                    <td class="r_border bb">
                        Rp. <?= number_format($total) ?>
                        <?php $sub_total += $total; ?>
                    </td>

                </tr>

            <?php endforeach ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="total">
                    SUB TOTAL
                <td class="total">
                    Rp. <?= number_format($sub_total) ?>
                </td>

            </tr>
        </tbody>
    </table>
</body>

</html>