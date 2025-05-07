<?php
function formatTanggal($tanggal) {
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    // Ubah format tanggal ke format timestamp
    $timestamp = strtotime($tanggal);

    $tahun = date('Y', $timestamp);
    $bulanIndex = (int)date('m', $timestamp);
    $hari = date('d', $timestamp);

    return $hari . ' ' . $bulan[$bulanIndex] . ' ' . $tahun;
}
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/bootstrap/dist/css/bootstrap.min.css">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body onload="window.print()" style="border: 3px solid black; padding: 10px;">
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td rowspan="3" width="16%" class="text-center">
                    <img src="<?= base_url() ?>assets/dashboard/images/logo/logo_koperasi.png" width="90">
                </td>
                <td class="text-center">
                    <h3></h3>
                </td>
                <td rowspan="3" width="16%">&nbsp;</td>
            </tr>
            <tr>
                <td class="text-center">
                    <span style="line-height: 1.6; font-weight: bold;">KOPERASI SIMPAN PINJAM MITRA ARTHA<br>
                        Jl. Gajah Mada No.114, Sukorejo Lor, Sukorejo<br>
                        BOJONEGORO
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>