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

		<title>Portal - Liga</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>
					<div class="container-fluid">
						<p class="mb-4">Ver mais de <a href="<?php echo base_url('categoria/id/'.$product['pcat_id']); ?>"><?= $product['pcat_name']; ?></a>.</p>
						<div class="row">
							<div class="col-xl-9 col-lg-7">
								<h1 class="h3 mb-2 text-gray-800"><?= $product['productname']; ?></h1>
								<?php if($product['productstatus'] == 1){ ?>
								    <a href="<?= base_url('liga/detalhe/'.$product['productid']); ?>" class="btn btn-sm btn-primary shadow-sm">Detalhes</a>
								<?php } ?>
								<hr>
								<h5 class="h5 mb-2 text-success"><strong>R$ <?php echo number_format($product['productprice'], 2, ',', ''); ?></strong> (por time)</h5>
								<h6 class="h6 mb-2 text-gray-800"><?= $product['pcat_description']; ?></h6>
								<?php if($product['pcat_id'] == 2){ ?>
    								<p class="text-gray-600">
    									<dl> 
    									   <dt>PREMIAÇÃO PARCIAL</dt> 
    									   <dd>
    									    <?php if($product['productid'] == 38){ ?>
    											<dt> 1º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.5)), 2, ',', '.'); ?> (50%)</dt>
    											<dt> 2º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.17)), 2, ',', '.'); ?> (17%)</dt>
    											<dt> 3º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.12)), 2, ',', '.'); ?> (12%)</dt>
    											<dt> 4º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.07)), 2, ',', '.'); ?> (7%)</dt>
    											<dt> 5º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.04)), 2, ',', '.'); ?> (4%)</dt>
    											<dt> 6º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02)), 2, ',', '.'); ?> (2%)</dt>
    											<dt> 7º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02)), 2, ',', '.'); ?> (2%)</dt>
    											<dt> 8º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02)), 2, ',', '.'); ?> (2%)</dt>
    											<dt> 9º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02)), 2, ',', '.'); ?> (2%)</dt>
    											<dt> 10º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02)), 2, ',', '.'); ?> (2%)</dt>
    										<?php } else { ?>
    										    <?php if($product['paidteams'] <= 60){ ?>
        											<dt> 1º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.5)), 2, ',', '.'); ?> (50%)</dt>
        											<dt> 2º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.17)), 2, ',', '.'); ?> (17%)</dt>
        											<dt> 3º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.12)), 2, ',', '.'); ?> (12%)</dt>
        											<dt> 4º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.07)), 2, ',', '.'); ?> (7%)</dt>
        											<dt> 5º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.04)), 2, ',', '.'); ?> (4%)</dt>
        											<dt> 6º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02)), 2, ',', '.'); ?> (2%)</dt>
        											<dt> 7º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02)), 2, ',', '.'); ?> (2%)</dt>
        											<dt> 8º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02)), 2, ',', '.'); ?> (2%)</dt>
        											<dt> 9º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02)), 2, ',', '.'); ?> (2%)</dt>
        											<dt> 10º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02)), 2, ',', '.'); ?> (2%)</dt>
        										<?php } else { ?>
        										    <dt> 1º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.5))-50, 2, ',', '.'); ?> (50%)</dt>
        											<dt> 2º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.17))-17, 2, ',', '.'); ?> (17%)</dt>
        											<dt> 3º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.12))-12, 2, ',', '.'); ?> (12%)</dt>
        											<dt> 4º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.07))-7, 2, ',', '.'); ?> (7%)</dt>
        											<dt> 5º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.04))-4, 2, ',', '.'); ?> (4%)</dt>
        											<dt> 6º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02))-2, 2, ',', '.'); ?> (2%)</dt>
        											<dt> 7º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02))-2, 2, ',', '.'); ?> (2%)</dt>
        											<dt> 8º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02))-2, 2, ',', '.'); ?> (2%)</dt>
        											<dt> 9º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02))-2, 2, ',', '.'); ?> (2%)</dt>
        											<dt> 10º - R$ <?php echo number_format((($product['paidteams']*8.5)*(0.02))-2, 2, ',', '.'); ?> (2%)</dt>
        										    <dt> 11º a 20º - Rodada GRÁTIS</dt>
        									    <?php } ?>
    									    <?php } ?>
    									   </dd> 
    									</dl>
    								</p>
    								<p class="text-gray-600 text-xs">Percentuais de premiação conforme os <a href="#">termos e condições</a>
								<?php } ?>
							</div>
							<div class="col-xl-3 col-lg-5">
								<div class="card shadow mb-4">
									<div class="card-body">
										<h6 class="h6 mb-0 text-gray-800">Selecione os times</h6>
										<hr>
										<form method="post" action="<?= base_url('inscrever/processar');?>" >
											<div class="form-group">
												<input type="hidden" id="productid" name="productid" value="<?= $product['productid']; ?>">
												<?php if($teams) { ?>
													<?php foreach($teams as $team) { ?>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" value="<?= $team->teamid; ?>" id="<?= $team->teamslug; ?>" name="teamcheck[]" 
																<?php 
																	foreach($regitens as $regitem) { 
																		if($team->teamid == $regitem->registryteam){ 
																			echo "disabled";
																		} 
																	} 
																?>
															>
															<label class="custom-control-label 
																<?php 
																	foreach($cartitens as $cartitem) { 
																		if($team->teamid == $regitem->registryteam){ 
																			echo "text-gray-400";
																		} 
																	} 
																?>
															" for="<?= $team->teamslug; ?>"><?= $team->teamname; ?></label>
														</div>
													<?php } ?>
												<?php } else { ?>
													<div class="col-md-12 text-muted"><h6>Voce nao possui times cadastrados!</h6></div>
												<?php } ?>
											</div>
											<hr>
											<button type="submit" value="1" name="postaction" class="btn btn-success btn-block">
											  <i class="fa fa-dollar-sign fa-fw"></i> Inscrever agora
											</button>
											<button type="submit" value="2" name="postaction" class="btn btn-primary btn-block">
											  <i class="fa fa-cart-plus fa-fw"></i> Adicionar ao carrinho
											</button>
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
	</body>
</html>
