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
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $title ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="<?= base_url() ?>assets/dashboard/images/logo/logo_koperasi.png">

    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
	
	<!-- DataTables CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
	<!-- jQuery -->
	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<!-- DataTables JS -->
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
	
	<!-- Tambahkan di bagian <head> atau sebelum penutup tag </body> -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

	<style>
		.modal-custom-size {
			max-width: 90%;
		}
			
		.circle-tile {
			margin-bottom: 15px;
			text-align: center;
		}
		.circle-tile-heading {
			border: 3px solid rgba(255, 255, 255, 0.3);
			border-radius: 100%;
			color: #FFFFFF;
			height: 80px;
			margin: 0 auto -40px;
			position: relative;
			transition: all 0.3s ease-in-out 0s;
			width: 80px;
		}
		.circle-tile-heading .fa {
			line-height: 80px;
		}
		.circle-tile-content {
			padding-top: 50px;
		}
		.circle-tile-number {
			font-size: 26px;
			font-weight: 700;
			line-height: 1;
			padding: 5px 0 15px;
		}
		.circle-tile-description {
			text-transform: uppercase;
		}
		.circle-tile-footer {
			background-color: rgba(0, 0, 0, 0.1);
			color: rgba(255, 255, 255, 0.5);
			display: block;
			padding: 5px;
			transition: all 0.3s ease-in-out 0s;
		}
		.circle-tile-footer:hover {
			background-color: rgba(0, 0, 0, 0.2);
			color: rgba(255, 255, 255, 0.5);
			text-decoration: none;
		}
		.circle-tile-heading.dark-blue:hover {
			background-color: #2E4154;
		}
		.circle-tile-heading.green:hover {
			background-color: #138F77;
		}
		.circle-tile-heading.orange:hover {
			background-color: #DA8C10;
		}
		.circle-tile-heading.blue:hover {
			background-color: #2473A6;
		}
		.circle-tile-heading.red:hover {
			background-color: #CF4435;
		}
		.circle-tile-heading.purple:hover {
			background-color: #7F3D9B;
		}
		.tile-img {
			text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
		}

		.dark-blue {
			background-color: #34495E;
		}
		.green {
			background-color: #16A085;
		}
		.blue {
			background-color: #2980B9;
		}
		.orange {
			background-color: #F39C12;
		}
		.red {
			background-color: #E74C3C;
		}
		.purple {
			background-color: #8E44AD;
		}
		.dark-gray {
			background-color: #7F8C8D;
		}
		.gray {
			background-color: #95A5A6;
		}
		.light-gray {
			background-color: #BDC3C7;
		}
		.yellow {
			background-color: #F1C40F;
		}
		.text-dark-blue {
			color: #34495E;
		}
		.text-green {
			color: #16A085;
		}
		.text-blue {
			color: #2980B9;
		}
		.text-orange {
			color: #F39C12;
		}
		.text-red {
			color: #E74C3C;
		}
		.text-purple {
			color: #8E44AD;
		}
		.text-faded {
			color: rgba(255, 255, 255, 0.7);
		}
		
	</style>

</head>
<body>