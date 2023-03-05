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
							<h5 class="h5 mb-0 text-gray-800"><?= $category['pcat_name']; ?></h5>
						</div>
						<div class="row">
							<?php if($products){ ?>
								<?php foreach($products as $product){ ?>
									<div class="col-md-3">
										<div class="card shadow mb-3">
											<div class="card-body">
												<div class="text-center">
													<img src="<?= base_url('assets/img/logotipo.png'); ?>" width="200px">
												</div>
												<p>
													<h4 class="mb-0">
														<a class="text-dark" href="<?= base_url('liga/id/'.$product->productid); ?>">
															<?php echo $product->productname; ?>
														</a>
													</h4>
													<div class="text-xs font-weight-bold text-uppercase mb-1">
														<?php 
															if($product->paidteams == 0) {
																echo "Nenhum time inscrito";
															} else {
																if($product->paidteams == 1) {
																	echo $product->paidteams." time inscrito";
																} else {
																	echo $product->paidteams." times inscritos";
																}
															}
														?>
													</div>
												</p>
												<p><?php echo $highitem->pcat_description; ?></p>
												<a href="<?= base_url('liga/id/'.$product->productid); ?>">Inscrever-se</a>
											</div>
										</div>
									</div>
								<?php } ?>
							<?php } else { ?>
								<div class="col-md-12 text-muted"><h6>Nenhum produto a ser exibido!</h6></div>
							<?php } ?>
						</div>
						<div class="row" style="padding-bottom: 30px;">
							<div class="col-sm-6">
							</div>
							<div class="col-sm-6">
								<nav aria-label="Navegação de página exemplo">
									<ul class="pagination justify-content-end">
										<?php if($page == 0){ ?>
										<li class="page-item disabled">
										<?php } else{ ?>
										<li class="page-item">
										<?php } ?>
											<a class="page-link" href="<?= base_url('categoria/bolao/'.($page-1)); ?>" aria-label="Anterior" title="Anterior">
												<span aria-hidden="true">&laquo;</span>
												<span class="sr-only">Anterior</span>
											</a>
										</li>
										<?php if($mult == true){ ?>
											<?php for($i = 0; $i<intdiv($pcount, 10); $i++){ ?>
												<?php if($i == $page){ ?>
													<li class="page-item disabled"><a class="page-link" href="<?= base_url('categoria/bolao/'.$i); ?>"><?php echo $i+1; ?></a></li>
												<?php } else {?>
													<li class="page-item"><a class="page-link" href="<?= base_url('categoria/bolao/'.$i); ?>"><?php echo $i+1; ?></a></li>
												<?php } ?>
											<?php } ?>
										<?php } else { ?>
											<?php for($i = 0; $i<=intdiv($pcount, 10); $i++){ ?>
												<?php if($i == $page){ ?>
													<li class="page-item disabled"><a class="page-link" href="<?= base_url('categoria/bolao/'.$i); ?>"><?php echo $i+1; ?></a></li>
												<?php } else {?>
													<li class="page-item"><a class="page-link" href="<?= base_url('categoria/bolao/'.$i); ?>"><?php echo $i+1; ?></a></li>
												<?php } ?>
											<?php } ?>
										<?php } ?>
										<?php if(intdiv($pcount, 10) == $page){ ?>
										<li class="page-item disabled">
										<?php } else{ ?>
											<?php if($mult == true){ ?>
												<?php if(intdiv($pcount, 10) == ($page+1)){ ?>
													<li class="page-item disabled">
												<?php } else{ ?>
													<li class="page-item">
												<?php } ?>
											<?php } ?>
										<?php } ?>
											<a class="page-link" href="<?= base_url('categoria/bolao/'.($page+1)); ?>" aria-label="Próximo" title="Próximo">
												<span aria-hidden="true">&raquo;</span>
												<span class="sr-only">Próximo</span>
											</a>
										</li>
									</ul>
								</nav>
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
