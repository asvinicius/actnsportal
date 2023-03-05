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

		<title>Portal - Cadastro</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>

	<body class="bg-gradient-primary">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-12 col-lg-12 col-md-9">
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<div class="row">
								<div class="col-lg-4 d-none d-lg-block text-center">
									<img src="<?= base_url('assets/img/loginimage.png'); ?>" width="300px">
								</div>
								<div class="col-lg-8">
									<div class="p-5">
										<div class="text-center">
											<h1 class="h4 text-gray-900 mb-4">Crie uma conta!</h1>
										</div>
										<?php if ($alert != null) { ?>
											<div class="alert alert-<?php echo $alert["class"]; ?>"> <?php echo $alert["message"]; ?> </div>
										<?php } ?>
										<form action="<?= base_url('cadastro/salvar'); ?>" method="post">
											<div class="form-group row">
												<div class="col-sm-6 mb-3 mb-sm-0">
													<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Nome" onkeypress="charMask();" minlength="7" required>
												</div>
												<div class="col-sm-6">
													<input type="text" class="form-control form-control-user" id="userphone" name="userphone" placeholder="Telefone" onkeyup="PhoneMask(this);" onkeypress="integerMask();" minlength="14" maxlength="15" required>
												</div>
											</div>
											<div class="form-group">
												<input type="email" class="form-control form-control-user" id="useremail" name="useremail" placeholder="E-mail" minlength="7" required>
											</div>
											<div class="form-group row">
												<div class="col-sm-6 mb-3 mb-sm-0">
													<input type="password" class="form-control form-control-user" id="validatepassword" name="userpassword" placeholder="Senha" required>
												</div>
												<div class="col-sm-6">
													<input type="password" class="form-control form-control-user" id="confirmpassword" name="confirmpassword" placeholder="Confirma senha" required>
												</div>
											</div>
											<button type="submit" href="login.html" class="btn btn-primary btn-user btn-block">
												Cadastrar
											</button>
										</form>
										<hr>
										<div class="text-center">
											<a class="small" href="<?= base_url('redefinir'); ?>">Esqueceu a senha?</a>
										</div>
										<div class="text-center">
											<a class="small" href="<?= base_url('login'); ?>">Já possui uma conta? Faça Login!</a>
										</div>
										<div class="text-center">
											<a class="small" href="<?= base_url('termos'); ?>" target="_blank">Termos da Liga</a>
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
		<script src="<?= base_url('assets/js/lr-maskvalid.js'); ?>" type="text/javascript"></script>
		<script src="<?= base_url('assets/js/lr-passconfirm.min.js'); ?>" type="text/javascript"></script>

	</body>

</html>
