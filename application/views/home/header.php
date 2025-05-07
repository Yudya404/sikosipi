<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?= base_url() ?>assets/dashboard/images/logo/logo_koperasi.png">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script>
        function passwordShowUnshow() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
	
	<style>
		.bg-image {
			background-image: url('assets/datakoperasi/logo_koperasi.png');
			/* Atur properti background lainnya jika diperlukan */
		}
        .login-form {
            background-color: rgba(255, 255, 255, 0.8); /* White with 80% opacity */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .login-form .form-control {
            background-color: rgba(255, 255, 255, 0.6); /* White with 60% opacity */
            border: none;
            box-shadow: none;
        }
    </style>

</head>
<body class="bg-dark">
    <script src="<?= base_url() ?>assets/dashboard/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/dashboard/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/dashboard/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/dashboard/assets/js/main.js"></script>