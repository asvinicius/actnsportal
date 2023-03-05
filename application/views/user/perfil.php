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

		<title>Portal - Perfil</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>
					<div class="container-fluid">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Perfil</h1>
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
                                        <h6 class="m-0 font-weight-bold text-primary">Informações pessoais</h6>
                                        <a href="<?= base_url('editaperfil'); ?>" title="Editar">
                                            <i class="fas fa-edit fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <?php if ($user['userkey'] == null) { ?>
                    							<div class="alert alert-danger"> Você ainda não possui uma <code>Chave PIX</code> vinculada ao seu cadastro. Ter uma Chave PIX facilita o pagamento. </div>
                    						<?php } ?>
                                            <div class="row text-muted">
                                                <div class="col-3 text-truncate"><em>Nome:</em></div>
                                                <div class="col"><strong><?= $user['username']; ?></strong></div>
                                            </div>
                                            <div class="row text-muted">
                                                <div class="col-3 text-truncate"><em>E-mail:</em></div>
                                                <div class="col"><strong><?= $user['useremail']; ?></strong></div>
                                            </div>
                                            <div class="row text-muted">
                                                <div class="col-3 text-truncate"><em>Telefone:</em></div>
                                                <div class="col"><strong><?= $user['userphone']; ?></strong></div>
                                            </div>
                                            <div class="row text-muted">
                                                <div class="col-3 text-truncate"><em>PIX:</em></div>
                                                <div class="col"><strong><?= $user['userkey']; ?></strong></div>
                                            </div>
                                            <hr class="my-4" />
                                            <div class="d-flex justify-content-between">
							                    <a href="<?= base_url('editaperfil'); ?>" class="btn btn-sm btn-primary shadow-sm">Editar informações</a>
							                    <a href="<?= base_url('editasenha'); ?>" class="btn btn-sm btn-warning shadow-sm">Alterar senha</a>
                                            </div>
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
