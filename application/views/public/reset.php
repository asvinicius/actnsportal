<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set("display_errors", 0 );
?>
<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Portal - Redefinir senha</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>

	<body class="bg-gradient-primary">

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-6 col-lg-12 col-md-9">
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<div class="row">
								<div class="col-lg-12">
									<div class="p-5">
										<div class="text-center">
											<h1 class="h4 text-gray-900 mb-2">Esqueceu sua senha?</h1>
											<p class="mb-4">Acontece! Informe seu e-mail abaixo e enviaremos um link para redefinir sua senha!</p>
										</div>
										<?php if ($alert != null) { ?>
											<div class="alert alert-<?php echo $alert["class"]; ?>"> <?php echo $alert["message"]; ?> </div>
										<?php } ?>
										<form method="post" action="<?= base_url('redefinir/reset');?>">
											<div class="form-group">
												<input type="email" class="form-control form-control-user" id="resetemail" name="resetemail" aria-describedby="emailHelp" placeholder="Informe seu e-mail" required>
											</div>
											<button type="submit" class="btn btn-primary btn-user btn-block">
												Enviar
											</button>
										</form>
										<hr>
										<div class="text-center">
											<a class="small" href="<?= base_url('cadastro'); ?>">Crie uma conta!</a>
										</div>
										<div class="text-center">
											<a class="small" href="<?= base_url('login'); ?>">Já possui uma conta? Faça Login!</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
		<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
		<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
		<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

	</body>

</html>
