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

		<title>Portal - Carteira</title>

		<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	</head>
					<div class="container-fluid">
						<div class="d-sm-flex align-items-center justify-content-between mb-4">
							<h1 class="h3 mb-0 text-gray-800">Retirar</h1>
						</div>
						<div class="row">
							<div class="col-xl-12 col-lg-7">
							    <div class="card">
                                    <div class="card-header border-bottom">
                                        <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                                            <a class="nav-item nav-link <?php if($phase == 0){echo "active";}else{echo "disabled";} ?>" id="wizard1-tab" href="#wizard1" data-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                                <div class="wizard-step-text">
                                                    <div class="wizard-step-text-details">Informação básica</div>
                                                </div>
                                            </a>
                                            <a class="nav-item nav-link <?php if($phase == 1){echo "active";}else{echo "disabled";} ?>" id="wizard2-tab" href="#wizard2" data-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                                                <div class="wizard-step-text">
                                                    <div class="wizard-step-text-details">Chave PIX</div>
                                                </div>
                                            </a>
                                            <a class="nav-item nav-link <?php if($phase == 2){echo "active";}else{echo "disabled";} ?>" id="wizard3-tab" href="#wizard3" data-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="true">
                                                <div class="wizard-step-text">
                                                    <div class="wizard-step-text-details">Confirmação</div>
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
                                                        <?php if ($alert != null) { ?>
                											<div class="alert alert-<?php echo $alert["class"]; ?>"> <?php echo $alert["message"]; ?> </div>
                										<?php } ?>
                                                        <h3 class="text-primary">Passo 1</h3>
                                                        <h5 class="card-title">Informação básica</h5>
										                <form action="<?= base_url('retirar/chave'); ?>" method="post">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="fo_value">Insira o valor a ser retirado</label>
                                                                <input class="form-control" id="fo_value" name="fo_value" type="text" placeholder="Insira o valor a ser retirado" onkeyup="MoneyMask(this);" onkeypress="integerMask();" maxlength="7" required/>
                                                            </div>
                                                            <hr class="my-4" />
										    	            <a type="button" href="<?= base_url('carteira'); ?>" class="btn btn-sm btn-danger shadow-sm"> Cancelar </a>
                                                            <button type="submit" class="btn btn-sm btn-primary shadow-sm"> Seguir </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane py-5 py-xl-10 fade <?php if($phase == 1){echo "show active";} ?>" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                                                <div class="row justify-content-center">
                                                    <div class="col-xxl-6 col-xl-8">
                                                        <h3 class="text-primary">Passo 2</h3>
                                                        <h5 class="card-title">Chave PIX</h5>
                                                        <p>Confirme se a Chave PIX na caixa de texto abaixo está correta.</p>
                                                        <p>Caso esteja vazia ou incorreta, informe a Chave PIX.</p>
                                                        <form action="<?= base_url('retirar/confirmacao'); ?>" method="post">
                                                            <input type="hidden" id="fo_banco" name="fo_banco" value="<?= $destino['acc_id']; ?>">
                                                            <input type="hidden" id="fo_value" name="fo_value" value="<?= $value ?>">
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="userkey">Informe chave PIX</label>
                                                                <input class="form-control" id="userkey" name="userkey" type="text" placeholder="Informe chave PIX" value="<?= $useritem['userkey'] ?>" required/>
                                                            </div>
                                                            <hr class="my-4" />
										    	            <a type="button" href="<?= base_url('carteira'); ?>" class="btn btn-sm btn-danger shadow-sm"> Cancelar </a>
                                                            <button type="submit" class="btn btn-sm btn-primary shadow-sm"> Seguir </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane py-5 py-xl-10 fade <?php if($phase == 2){echo "show active";} ?>" id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                                                <div class="row justify-content-center">
                                                    <div class="col-xxl-6 col-xl-8">
                                                        <?php if ($alert != null) { ?>
                											<div class="alert alert-<?php echo $alert["class"]; ?>"> <?php echo $alert["message"]; ?> </div>
                										<?php } ?>
                                                        <h3 class="text-primary">Passo 3</h3>
                                                        <h5 class="card-title">Confirmação de dados</h5>
                                                        <p>Se os dados abaixo estiverem corretos, insira sua senha para finalizar a solicitação.</p>
                                                        <p>Após finalizar, o valor é descontado imediatamente da sua carteira, porém a transferência por parte da organização da Liga Acretinos pode acontecer em até 24 horas.</p>
                                                        <form action="<?= base_url('retirar/finalizar'); ?>" method="post">
                                                            <input type="hidden" id="fo_banco" name="fo_banco" value="<?= $destino['acc_id']; ?>">
                                                            <input type="hidden" id="fo_value" name="fo_value" value="<?= $value ?>">
                                                            <div class="row small text-muted">
                                                                <div class="col-sm-3 text-truncate"><em>Valor:</em></div>
                                                                <div class="col"><strong>R$ <?php echo number_format($value, 2, ',', ''); ?></strong></div>
                                                            </div>
                                                            <div class="row small text-muted">
                                                                <div class="col-sm-3 text-truncate"><em>Chave PIX:</em></div>
                                                                <div class="col"><strong><?= $useritem['userkey']; ?></strong></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="small mb-1" for="userkey">Insira sua senha</label>
                                                                <input class="form-control" id="userpassword" name="userpassword" type="password" placeholder="Insira sua senha" required/>
                                                            </div>
                                                            <hr class="my-4" />
										    	            <a type="button" href="<?= base_url('carteira'); ?>" class="btn btn-sm btn-danger shadow-sm"> Cancelar </a>
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
                                                        <h5 class="card-title">Sua solicitação foi registrada. A transferência deverá ser concluída em até 24 horas.</h5>
                                                        
                                                        <hr class="my-4" />
                                                        <div class="d-flex justify-content-between">
                                                            <a class="btn btn-primary btn-block" href="<?= base_url('carteira'); ?>">Seguir</a>
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
