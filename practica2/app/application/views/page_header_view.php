<?php
$titulo  = $titulo  ?? "";
$css     = $css     ?? array();
$refresh = $refresh ?? false;
?>
<!DOCTYPE html>
<html>
<head>
<?php
if ( $refresh ) :
?>
	<meta http-equiv="refresh" content="5">
<?php
endif;
?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $titulo ?></title>
	<link rel="shorcut icon" href="<?= base_url() ?>static/images/uteq.ico" />
	<link rel="stylesheet" href="<?= base_url() ?>static/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>static/fontawesome/css/all.min.css" />

<?php foreach ( $css as $archivo ) : ?>
	<link rel="stylesheet" href="<?= base_url() ?>static/css/<?= $archivo ?>.css" />
<?php endforeach; ?>

	<script src="<?= base_url() ?>static/js/jquery-3.7.1.min.js"></script>
	<script src="<?= base_url() ?>static/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container col-md-12">
	<h2><?= $titulo ?></h2>