<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set("display_errors", 0 );
?>
<!DOCTYPE html>
<html lang="pt">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Portal - Ligas</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>

					<div class="container-fluid">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Ligas</h1>
						</div>
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h5 class="h5 mb-0 text-gray-800">Categorias</h5>
						</div>
						<div class="row">
							<?php if ($categories) { ?>
								<?php foreach($categories as $category){ ?>
									<div class="col-xl-3 col-md-6 mb-4">
										<a href="<?= base_url('categoria/id/'.$category->pcat_id); ?>">
											<div class="card border-left-<?php if($category->pcat_id == 1){echo 'danger';}else{if($category->pcat_id == 2){echo 'warning';}else{echo 'primary';}} ?> shadow h-100 py-2">
												<div class="card-body">
													<div class="row no-gutters align-items-center">
														<div class="col mr-2">
															<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $category->pcat_name; ?></div>
														</div>
														<div class="col-auto">
															<i class="fas fa-<?php if($category->pcat_id == 1){echo 'list-ol';}else{if($category->pcat_id == 2){echo 'crosshairs';}else{echo 'times';}} ?> fa-2x text-gray-300"></i>
														</div>
													</div>
												</div>
											</div>
										</a>
									</div>
								<?php } ?>
							<?php } else { ?>
								<div class="col-xl-12 col-md-6 mb-4">
									<h4>Nenhuma categoria a ser exibida</h4>
								</div>
							<?php } ?>
						</div>
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h5 class="h5 mb-0 text-gray-800">Destaques</h5>
						</div>
						<div class="row">
							<?php if($highlights){ ?>
								<?php foreach($highlights as $highitem){ ?>
									<div class="col-md-4">
										<div class="card shadow mb-4">
											<div class="card-header py-3">
												<h6 class="m-0 font-weight-bold text-<?php if($highitem->pcat_id == 1){echo 'danger';}else{if($highitem->pcat_id == 2){echo 'warning';}else{echo 'primary';}} ?>"><?php echo $highitem->pcat_name; ?></h6>
											</div>
											<div class="card-body">
												<div class="text-center">
													<img src="<?= base_url('assets/img/logotipo.png'); ?>" width="200px">
												</div>
												<p>
													<h4 class="mb-0">
														<a class="text-dark" href="<?= base_url('liga/id/'.$highitem->productid); ?>">
															<?php echo $highitem->productname; ?>
														</a>
													</h4>
													<div class="text-xs font-weight-bold text-uppercase mb-1">
														<?php 
															if($highitem->paidteams == 0) {
																echo "Nenhum time pago";
															} else {
																if($highitem->paidteams == 1) {
																	echo $highitem->paidteams." time pago";
																} else {
																	echo $highitem->paidteams." times pagos";
																}
															}
														?>
													</div>
												</p>
												<p><?php echo $highitem->pcat_description; ?></p>
												<a href="<?= base_url('liga/id/'.$highitem->productid); ?>">Inscrever-se</a>
											</div>
										</div>
									</div>
								<?php } ?>
							<?php } else { ?>
								<div class="col-md-12 text-muted"><h6>Nenhum destaque a ser exibido!</h6></div>
							<?php } ?>
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
