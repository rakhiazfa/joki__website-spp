<?php

require_once __DIR__ . '/../config/konfigurasi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Website SPP</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo BASE_URL . '/assets/plugins/fontawesome-free/css/all.min.css' ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo BASE_URL . '/assets/dist/css/adminlte.min.css' ?>">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="assets/index2.html" class="h1"><b>Website SPP</a>
			</div>
			<div class="card-body">
				<form action="<?php echo BASE_URL . '/siswa/proses_login.php' ?>" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="nisn" placeholder="Masukan NISN anda">
					</div>

					<div class="row">
						<div class="col-8">
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Sign In</button>
						</div>
						<!-- /.col -->
					</div>
				</form>

			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="<?php echo BASE_URL . '/assets/plugins/jquery/jquery.min.js' ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo BASE_URL . '/assets/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo BASE_URL . '/assets/dist/js/adminlte.min.js' ?>"></script>
</body>

</html>