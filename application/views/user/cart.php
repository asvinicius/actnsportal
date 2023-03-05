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

		<title>Portal - Carrinho</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>

					<div class="container-fluid">
						<h1 class="h3 mb-2 text-gray-800">Meu carrinho</h1>
						<div class="row">
							<div class="col-xl-9 col-lg-7">
								<div class="card shadow mb-4">
									<div class="card-body">
									<?php if ($alert != null) { ?>
										<div class="alert alert-<?php echo $alert["class"]; ?>"> <?php echo $alert["message"]; ?> </div>
									<?php } ?>
										<?php if ($cartitens) { ?>
											<?php $total = 0; ?>
											<table class="table table-sm table-hover">
												<tbody>
													<?php foreach ($cartitens as $cartitem) { 
														$total += $cartitem->productprice;
													?>
														<tr>
															<td><h6 class="product-name"><strong><?= $cartitem->productname ?></strong></h6><h6><small><?= $cartitem->teamname ?></small></h6></td>
															<td><h6><strong><span class="text-muted">R$</span> <?php echo number_format($cartitem->productprice, 2, ',', ''); ?></strong></h6></td>
															<td>
																<a href="<?= base_url('carrinho/delete/'.$cartitem->cartid); ?>" title="Excluir" class="icon-danger" onclick="return confirm('Tem certeza que deseja fazer isso?');">
																	<i class="fas fa-fw fa-trash"></i>
																</a>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										<?php } else { ?>
											<h6>Seu carrinho está vazio!</h6>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-lg-5">
								<?php if ($cartitens) { ?>
									<div class="card shadow mb-4">
										<div class="card-header py-3">
											<div class="row">
												<div class="col-xl-6">
													<h6 class="m-0 font-weight-bold text-primary">Total</h6>
												</div>
												<div class="col-xl-6">
													<h6 class="m-0 font-weight-bold text-success text-right"><strong>R$ <?php echo number_format($total, 2, ',', ''); ?></strong></h6>
												</div>
											</div>
										</div>
										<div class="card-body">
											<a href="<?= base_url('checkout'); ?>" class="btn btn-success btn-block">
												<i class="fa fa-dollar-sign fa-fw"></i> Finalizar inscrição
											</a>
											<a href="<?= base_url('ligas'); ?>" class="btn btn-primary btn-block">
												<i class="fa fa-share fa-fw"></i> Continuar comprando
											</a>
										</div>
									</div>
								<?php } ?>
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
