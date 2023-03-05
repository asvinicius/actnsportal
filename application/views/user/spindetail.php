<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set("display_errors", 0 );
?>
<!DOCTYPE html>
<html lang="en">

	<head><meta charset="euc-jp">

		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Portal - Rodada</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>
					<div class="container-fluid">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Bolao tiro curto #<?= $spin ?></h1>
						</div>
						<div class="row">
							<div class="col-xl-12 col-lg-7">
								<div class="d-sm-flex align-items-center justify-content-between mb-4">
									<h5 class="h5 mb-2 text-gray-800">
										<span class="text-muted"> 
											<?php 
												if($spindata['numteams'] == 0){ 
													echo "Nenhum time inscrito";
												}else{
													if($spindata['numteams'] > 1){
														echo $spindata['numteams']." times inscritos";
													} else{
														echo $spindata['numteams']." time inscrito";
													}
												} 
											?>
										</span>
									</h5>
									<?php if($product['productstatus'] == 1){ ?>
									    <a href="<?= base_url('liga/id/'.$spin); ?>" class="btn btn-sm btn-primary shadow-sm">Inscreva-se</a>
									<?php } ?>
								</div>
								<hr>
								<form method="post" class="form-inline justify-content-md-end" style="margin-bottom:15px" action="<?= base_url('liga/pesquisar');?>">
									<input class="form-control form-control-sm mr-sm-1 col-md-6" type="text" placeholder="Pesquisar" aria-label="Pesquisar" name="searchlabel" id="searchlabel">
									<button class="btn btn-sm btn-primary shadow-sm" type="submit" name="spin" value="<?= $spin ?>">Pesquisar</button>
								</form>
								<?php if($teams){ ?>
									<table class="table table-sm table-hover">
										<thead>
											<tr>
												<th scope="col">  </th>
												<th scope="col">Nome</th>
												<th scope="col">Cartoleiro</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($teams as $team){ ?>
												<tr>
													<td><img src="<?php echo $team->teamshield ?>" width="20" alt="..."/></td>
													<td><?php echo $team->teamname ?></td>
													<td><?php echo $team->teamcoach ?></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } else {echo "<h4>Nenhum time inscrito.</h4>";} ?>
								<div class="mt-4 text-center small">
									<span class="mr-2">
										Pesquise pelo nome do seu time ou cartoleiro caso nao o veja nesta lista.
									</span>
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
