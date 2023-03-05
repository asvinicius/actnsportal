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

		<title>Portal - Times</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>
					<div class="container-fluid">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Meus times</h1>
							<a href="<?= base_url('novotime'); ?>" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Novo time</a>
						</div>
						<?php if ($alert != null) { ?>
							<div class="alert alert-<?php echo $alert["class"]; ?>"> <?php echo $alert["message"]; ?> </div>
						<?php } ?>
						<div class="row">
							<div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4">
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Meus times</h6>
                                    </div>
                                    <div class="card-body">
                                        <?php if ($teams) { ?>
                							<table class="table table-sm table-hover">
                								<tbody>
                									<?php foreach ($teams as $team) { ?>
                										<tr>
                											<td><img src="<?php echo $team->teamshield ?>" width="20" alt="..."/></td>
                											<td>
                											    <dt><?php echo $team->teamname ?></dt>
                											    <dd><small><?php echo $team->teamcoach ?></small></dd>
                											</td>
                											<td>
                												<a href="<?= base_url('times/delete/'.$team->teamid); ?>" title="Excluir" class="icon-danger" onclick="return confirm('Tem certeza que deseja fazer isso?');">
                													<i class="fas fa-fw fa-trash"></i>
                												</a>
                											</td>
                										</tr>
                									<?php } ?>
                								</tbody>
                							</table>
                						<?php } else { ?>
                							<h4>Nenhum time registrado</h4>
                						<?php } ?>
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
