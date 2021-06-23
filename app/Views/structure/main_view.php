<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PeRa DK<?= $this->renderSection('title') ?></title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>/public/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/public/dist/css/adminfabian.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<?= $this->renderSection('css') ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<?= $this->renderSection('preloader') ?>
		
		<?= $this->include('structure/navbar') ?>
		<?= $this->include('structure/sidebar') ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<?= $this->renderSection('content') ?>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<?= $this->include('structure/footer') ?>

	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="<?= base_url() ?>/public/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?= base_url() ?>/public/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<!-- Bootstrap 4 -->
	<script src="<?= base_url() ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="<?= base_url() ?>/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url() ?>/public/dist/js/adminlte.js"></script>
	<?= $this->renderSection('js') ?>
</body>

</html>