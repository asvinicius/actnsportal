<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set("display_errors", 0 );
?>
<!DOCTYPE html>
<html lang="pt">

	<head>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Portal - Alterar senha</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>
					<div class="container-fluid">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Alterar senha</h1>
							<!--
							<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
							    <i class="fas fa-download fa-sm text-white-50"></i> 
							    Generate Report
							</a>
							-->
						</div>
						<div class="row">
                            <div class="col-xl-12 col-lg-5">
                                <div class="card shadow mb-4">
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Altere sua senha</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url('editasenha/atualizar'); ?>" method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="currentpass">Senha atual</label>
                                                <input class="form-control" id="currentpass" name="currentpass" type="password"  required>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="validatepassword">Nova senha</label>
                                                <input class="form-control" id="validatepassword" name="userpassword" type="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="confirmpassword">Confirma senha</label>
                                                <input class="form-control" id="confirmpassword" name="confirmpassword" type="password"  required>
                                            </div>
                                            <hr class="my-4" />
                                            <button type="submit" class="btn btn-sm btn-success shadow-sm"> Salvar </button>
											<a type="button" href="<?= base_url('perfil'); ?>" class="btn btn-sm btn-danger shadow-sm"> Cancelar </a>
                                        </form>
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
