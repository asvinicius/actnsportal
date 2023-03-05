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

		<title>Portal - Finalizar</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>
					<div class="container-fluid">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Finalizar inscrição</h1>
						</div>
						<div class="row">
							<div class="col-xl-12 col-lg-7">
							    <div class="card">
                                    <div class="card-header border-bottom">
                                        <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                                            <a class="nav-item nav-link <?php if($phase == 0){echo "active";}else{echo "disabled";} ?>" id="wizard1-tab" href="#wizard1" data-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                                <div class="wizard-step-text">
                                                    <div class="wizard-step-text-details">Conteúdo do carrinho</div>
                                                </div>
                                            </a>
                                            <a class="nav-item nav-link <?php if($phase == 1){echo "active";}else{echo "disabled";} ?>" id="wizard2-tab" href="#wizard2" data-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                                                <div class="wizard-step-text">
                                                    <div class="wizard-step-text-details">Instruções</div>
                                                </div>
                                            </a>
                                            <a class="nav-item nav-link <?php if($phase == 2){echo "active";}else{echo "disabled";} ?>" id="wizard3-tab" href="#wizard3" data-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="true">
                                                <div class="wizard-step-text">
                                                    <div class="wizard-step-text-details">Comprovante</div>
                                                </div>
                                            </a>
                                            <a class="nav-item nav-link <?php if($phase == 3){echo "active";}else{echo "disabled";} ?>" id="wizard4-tab" href="#wizard4" data-toggle="tab" role="tab" aria-controls="wizard4" aria-selected="true">
                                                <div class="wizard-step-text">
                                                    <div class="wizard-step-text-details">Sucesso</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="cardTabContent">
                                            <div class="tab-pane py-5 py-xl-10 fade <?php if($phase == 0){echo "show active";} ?>" id="wizard1" role="tabpanel" aria-labelledby="wizard1-tab">
                                                <div class="row justify-content-center">
                                                    <div class="col-xxl-6 col-xl-8">
                                                        <h3 class="text-primary">Passo 1</h3>
                                                        <h5 class="card-title">Conteúdo do carrinho</h5>
                                                        <p>Confirme se o conteúdo do carrinho está correto para seguir para o pagamento.</p>
                                                        <p>Você pode pagar com saldo disponível. Caso não tenha saldo, clique em seguir para se inscrever por via de transferência</p>
                                                        
										                <form action="<?= base_url('checkout/instrucao'); ?>" method="post">
                                                            <?php if ($cartitens) { ?>
                												<?php $total = 0; ?>
                												<ul class="list-group mb-3">
                													<?php foreach ($cartitens as $cartitem) { 
                														$total += $cartitem->productprice;
                													?>
                														<li class="list-group-item d-flex justify-content-between lh-condensed">
                															<div>
                																<h6 class="my-0"><?= $cartitem->productname ?></h6>
                																<small class="text-muted"><?= $cartitem->teamname ?></small>
                															</div>
                															<span class="text-muted">R$ <?php echo number_format($cartitem->productprice, 2, ',', ''); ?></span>
                														</li>
                													<?php } ?>
                													<li class="list-group-item d-flex justify-content-between text-success">
                														<span>Total</span>
                														<strong>R$ <?php echo number_format($total, 2, ',', ''); ?></strong>
                													</li>
                												</ul>
                												<ul class="list-group mb-3">
                                                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                                                        <div>
                                                                            <h6 class="my-0">
                                                                                <div class="col  text-info"><em>Saldo disponível:</em></div>
                                                                                <div class="col  text-info"><strong>R$ <?php echo number_format($walletinfo['wallet_balance'], 2, ',', '.'); ?></strong></div>
                                                                            </h6>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                											<?php } else { ?>
                												<h6>Seu carrinho está vazio!</h6>
                											<?php } ?>
										    	            <a type="button" href="<?= base_url('carrinho'); ?>" class="btn btn-sm btn-danger shadow-sm"> Cancelar </a>
										    	            <?php if($walletinfo['wallet_balance'] >= $total){ ?>
                                                                <button type="submit" value="1001" name="saldo" class="btn btn-sm btn-info shadow-sm" onclick="return confirm('Confirma que deseja efetuar o pagamento com saldo disponível?');"> Pagar com saldo </button>
                                                            <?php } ?>
                                                            <button type="submit" class="btn btn-sm btn-primary shadow-sm"> Seguir </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane py-5 py-xl-10 fade <?php if($phase == 1){echo "show active";} ?>" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                                                <div class="row justify-content-center">
                                                    <div class="col-xxl-6 col-xl-8">
                                                        <?php if ($alert != null) { ?>
                    										<div class="alert alert-<?php echo $alert["class"]; ?>"> <?php echo $alert["message"]; ?> </div>
                    									<?php } ?>
                                                        <h3 class="text-primary">Passo 2</h3>
                                                        <h5 class="card-title">Instruções</h5>
                                                        <p>Faça a transferência para a conta indicada abaixo ou clique no link para pagar via cartão no PicPay. Em seguida salve o comprovante como imagem (png, jpg ou jpeg) ou PDF no seu dispositivo para anexar no próximo passo.</p>
                                                        
                                                        <form action="<?= base_url('checkout/comprovante'); ?>" method="post">
                                                            <input type="hidden" id="fo_banco" name="fo_banco" value="<?= $destino['acc_id']; ?>">
                                                            <input type="hidden" id="fo_value" name="fo_value" value="<?= $value ?>">
                                                            
                                                            <div class="row small text-muted">
                                                                <div class="col-sm-3 text-truncate"><em>Adm:</em></div>
                                                                <div class="col"><strong><?= $destino['supername']; ?></strong></div>
                                                            </div>
                                                            <div class="row small text-muted">
                                                                <div class="col-sm-3 text-truncate"><em>Banco:</em></div>
                                                                <div class="col"><strong><?= $destino['bankname']; ?></strong></div>
                                                            </div>
                                                            <div class="row small text-muted">
                                                                <div class="col-sm-3 text-truncate"><em>Chave PIX:</em></div>
                                                                <div class="col text-info"><strong><?= $destino['acc_key']; ?></strong></div>
                                                            </div>
                                                            <div class="row small text-muted">
                                                                <div class="col-sm-3 text-truncate"><em>Agência:</em></div>
                                                                <div class="col"><strong><?= $destino['acc_ag']; ?></strong></div>
                                                            </div>
                                                            <div class="row small text-muted">
                                                                <div class="col-sm-3 text-truncate"><em>Conta:</em></div>
                                                                <div class="col"><strong><?= $destino['acc_cc']; ?></strong></div>
                                                            </div>
                                                            <div class="row small text-muted">
                                                                <div class="col-sm-3 text-truncate"><em>PicPay:</em></div>
                                                                <div class="col"><strong><?= $destino['acc_comp']; ?></strong></div>
                                                            </div>
                                                            <div class="row small text-muted">
                                                                <div class="col-sm-3 text-truncate"><em>Valor:</em></div>
                                                                <div class="col"><strong>R$ <?php echo number_format($value, 2, ',', ''); ?></strong></div>
                                                            </div>
                                                            <hr class="my-4" />
										    	            <a type="button" href="<?= base_url('carrinho'); ?>" class="btn btn-sm btn-danger shadow-sm"> Cancelar </a>
										    	            <button type="submit" class="btn btn-sm btn-primary shadow-sm"> Seguir </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane py-5 py-xl-10 fade <?php if($phase == 2){echo "show active";} ?>" id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                                                <div class="row justify-content-center">
                                                    <div class="col-xxl-6 col-xl-8">
                                                        <h3 class="text-primary">Passo 3</h3>
                                                        <h5 class="card-title">Anexar comprovante de transferência</h5>
                                                        <p>O comprovante deve estar em formato de imagem (png, jpg ou jpeg) ou PDF. Caso ocorra um erro ao enviar o anexo, tire um print do comprovante e repita o processo anexando o print.</p>
                                                        <?php if ($alert != null) { ?>
                											<div class="alert alert-<?php echo $alert["class"]; ?>"> <?php echo $alert["message"]; ?> </div>
                										<?php } ?>
                                                        <form action="<?= base_url('checkout/finalizar'); ?>" method="post" enctype="multipart/form-data">
                                                            <input type="hidden" id="fo_banco" name="fo_banco" value="<?= $destino['acc_id']; ?>">
                                                            <input type="hidden" id="fo_value" name="fo_value" value="<?= $value ?>">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="orderattachment">Comprovante</label>
                                                                <input type="file" class="form-control-file form-control-user" id="orderattachment" name="orderattachment" required>
                                                            </div>
                                                            <hr class="my-4" />
										    	            <a type="button" href="<?= base_url('carrinho'); ?>" class="btn btn-sm btn-danger shadow-sm"> Cancelar </a>
                                                            <button type="submit" class="btn btn-sm btn-primary shadow-sm"> Seguir </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Wizard tab pane item 4-->
                                            <div class="tab-pane py-5 py-xl-10 fade <?php if($phase == 3){echo "show active";} ?>" id="wizard4" role="tabpanel" aria-labelledby="wizard4-tab">
                                                <div class="row justify-content-center">
                                                    <div class="col-xxl-6 col-xl-8">
                                                        <h3 class="text-primary">Sucesso!</h3>
                                                        <h5 class="card-title">Sua solicitação foi registrada. Agora é só aguardar a confirmação por parte dos administradores. Fique de olho em suas notificações!</h5>
                                                        
                                                        <hr class="my-4" />
                                                        <div class="d-flex justify-content-between">
                                                            <a class="btn btn-primary btn-block" href="<?= base_url(); ?>">Seguir</a>
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
				</div>
			</div>
		</div>	
	
		<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
		<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
		<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
		<script src="<?= base_url('assets/js/lr-maskvalid.js'); ?>" type="text/javascript"></script>
		<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
	</body>
</html>
