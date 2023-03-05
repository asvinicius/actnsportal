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

		<title>Portal - Início</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>
					<div class="container-fluid">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Início</h1>
							<!--
							<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
							    <i class="fas fa-download fa-sm text-white-50"></i> 
							    Generate Report
							</a>
							-->
						</div>
						<div class="row">
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-<?php if($json['status_mercado'] == 1){echo "success";}else{if($json['status_mercado'] == 2){echo "danger";}else{echo "warning";}} ?> shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-<?php if($json['status_mercado'] == 1){echo "success";}else{if($json['status_mercado'] == 2){echo "danger";}else{echo "warning";}} ?> text-uppercase mb-1">
                                                    <?php if($json['status_mercado'] == 1){ ?>
                                                        Mercado aberto
                                                    <?php } else { ?>
                                                        <?php if($json['status_mercado'] == 2){ ?>
                                                            Mercado fechado
                                                        <?php } else { ?>
                                                            Em manutenção
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    Rodada <?php echo $json['rodada_atual'] ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Bolão tiro curto #<?= $spin ?></div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php if($spindata['numteams'] == 1){ ?>
                                                        <?php echo $spindata['numteams']; ?> time
                                                    <?php } else { ?>
                                                        <?php echo $spindata['numteams']; ?> times
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-crosshairs fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> Saldo total </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"> R$ <?php echo number_format($walletinfo['wallet_balance'], 2, ',', '.'); ?> </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
