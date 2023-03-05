<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set("display_errors", 0 );

class Checkout extends CI_Controller {

    public function index() {
        if ($this->isLogged()){
			$this->load->model('CartModel');
			$this->load->model('ContasModel');
			$this->load->model('OrderModel');
			$this->load->model('OrdersuperModel');
			$this->load->model('OrdercontentsModel');
			$this->load->model('WalletModel');
			$this->load->model('RegistryModel');
			$registry = new RegistryModel();
			$cart = new CartModel();
			$contas = new ContasModel();
			$order = new OrderModel();
			$os = new OrdersuperModel();
			$oc = new OrdercontentsModel();
			$wallet = new WalletModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$cartitens = $cart->listuser($this->session->userdata('userid'));
			$walletinfo = $wallet->search($this->session->userdata('userid'));
			
			if($cartitens){
				$impedimento = 0;
    			foreach($cartitens as $ci){
    				$json = $this->getstatus();
    				$hindered = $oc->ishindered($ci->cartproduct, $ci->cartteam);
    				if($hindered){
    				    $cart->delete($ci->cartid);
						$impedimento = 1;
    				} else {
        				$regitem = $registry->getreg($ci->cartteam, $ci->cartproduct);
    				    if($regitem){
        				    $cart->delete($ci->cartid);
    						$impedimento = 1;
        				} else {
            				if($json['rodada_atual'] == $ci->cartproduct){
            				    date_default_timezone_set('America/Sao_Paulo');
            					if($json['fechamento']['dia'] == date('d')){
            						if(date('H') >= $json['fechamento']['hora']-1){
            					        if(date('i') >= $json['fechamento']['minuto']){
                					        $cart->delete($ci->cartid);
                						    $impedimento = 1;
                					    }
            					    }
            					}
            				}
        				}
    				}
    			}
			} else {
				redirect(base_url('carrinho'));
			}
			
			if($impedimento == 1){
				$getinfo = $this->getInfo();
				$info = array("info" => $getinfo);
				
				$cartitens = $cart->listuser($this->session->userdata('userid'));
				$alert = array(
					"class" => "danger",
					"message" => "Ops! Alguns de seus itens já foram solicitados ou não estão mais disponíveis. Removemos os itens indisponíveis para facilitar sua inscrição!");
						
				$content = array(
					"cartitens" => $cartitens, 
					"alert" => $alert);
				
				$this->load->view('template/user/headermenu', $info);
				$this->load->view('user/cart', $content);
			} else {
				$cartitens = $cart->listuser($this->session->userdata('userid'));
				
				$content = array(
				    "cartitens" => $cartitens,
			        "walletinfo" => $walletinfo);
            
				$this->load->view('template/user/headermenu', $info);
				$this->load->view('user/checkout', $content);
			}

        }else{
            redirect(base_url('login'));
        }
    }
    
    public function instrucao() {
        if ($this->isLogged()){
			$this->load->model('BalanceModel');
			$this->load->model('AccountModel');
			$this->load->model('FOModel');
			$this->load->model('CartModel');
			$this->load->model('WalletModel');
			$this->load->model('OrderModel');
			$this->load->model('OrdersuperModel');
			$this->load->model('OrdercontentsModel');
			$this->load->model('RegistryModel');
			$cart = new CartModel();
			$balance = new BalanceModel();
			$contas = new AccountModel();
			$fo = new FOModel();
			$wallet = new WalletModel();
			$order = new OrderModel();
			$os = new OrdersuperModel();
			$oc = new OrdercontentsModel();
			$registry = new RegistryModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$saldo = $this->input->post("saldo");
			$cartitens = $cart->listuser($this->session->userdata('userid'));
			
			if($saldo == 1001){
			    $impedimento = 0;
    			foreach($cartitens as $ci){
    				$json = $this->getstatus();
    				$hindered = $oc->ishindered($ci->cartproduct, $ci->cartteam);
    				if($hindered){
    				    $cart->delete($ci->cartid);
						$impedimento = 1;
    				} else {
    				    $regitem = $registry->getreg($ci->cartteam, $ci->cartproduct);
    				    if($regitem){
        				    $cart->delete($ci->cartid);
    						$impedimento = 1;
        				} else {
            				if($json['rodada_atual'] == $ci->cartproduct){
            				    date_default_timezone_set('America/Sao_Paulo');
            					if($json['fechamento']['dia'] == date('d')){
            						if(date('H') >= $json['fechamento']['hora']-1){
            					        if(date('i') >= $json['fechamento']['minuto']){
                					        $cart->delete($ci->cartid);
                						    $impedimento = 1;
                					    }
            					    }
            					}
            				}
        				}
    				}
    			}
    			if($impedimento == 1){
    				$getinfo = $this->getInfo();
    				$info = array("info" => $getinfo);
    				
    				$cartitens = $cart->listuser($this->session->userdata('userid'));
    				$alert = array(
    					"class" => "danger",
    					"message" => "Ops! Alguns de seus itens já foram solicitados ou não estão mais disponíveis. Removemos os itens indisponíveis para facilitar sua inscrição!");
    						
    				$content = array(
    					"cartitens" => $cartitens, 
    					"alert" => $alert);
    				
    				$this->load->view('template/user/headermenu', $info);
    				$this->load->view('user/cart', $content);
    			} else {
    			    $walletinfo = $wallet->search($this->session->userdata('userid'));
    			    $price = (count($cartitens))*10;
    			    if($walletinfo['wallet_balance'] >= $price){
        			    if($this->subspaid($this->session->userdata('userid'), $cartitens)){
        			        $phase = 3;
        			        
        			        $getinfo = $this->getInfo();
        			        $info = array("info" => $getinfo);
                			        
        			        $content = array("phase" => $phase);
                
                			$this->load->view('template/user/headermenu', $info);
    	                    $this->load->view('user/checkout', $content);
        			    }
    			    } else {
    			        $min_rec = $balance->mintotal();
            			$walletinfo = $wallet->search($this->session->userdata('userid'));
            			$superid = null;
            			
            			if($min_rec){
            			    foreach($min_rec as $balance){
            			        $superid = $balance->superid;
            			    }
            			}
            			
            			$fo_value = 0;
            			
            			foreach($cartitens as $ci){
            				$fo_value += $ci->productprice;
            			}
            			
        			    $destino = $contas->searchsuper($superid);
            			
            			if($destino){
            			    $phase = 1;
            			} else {
            			    redirect(base_url('carrinho'));
            			}
            			
            			$alert = array(
    					"class" => "danger",
    					"message" => "O seu saldo não é suficiente. Por favor, siga pelo método PIX");
            					
                        $content = array(
                            "destino" => $destino, 
                            "value" => $fo_value, 
                            "phase" => $phase,
            			    "walletinfo" => $walletinfo, 
            			    "alert" => $alert);
                        
            			$this->load->view('template/user/headermenu', $info);
            			$this->load->view('user/checkout', $content);
    			    }
    			}
			} else {
    			$min_rec = $balance->mintotal();
    			$walletinfo = $wallet->search($this->session->userdata('userid'));
    			$superid = null;
    			
    			if($min_rec){
    			    foreach($min_rec as $balance){
    			        $superid = $balance->superid;
    			    }
    			}
    			
    			$fo_value = 0;
    			
    			foreach($cartitens as $ci){
    				$fo_value += $ci->productprice;
    			}
    			
    			
			    $destino = $contas->searchsuper($superid);
    			
    			if($destino){
    			    $phase = 1;
    			} else {
    			    redirect(base_url('carrinho'));
    			}
    					
                $content = array(
                    "destino" => $destino, 
                    "value" => $fo_value, 
                    "phase" => $phase,
    			    "walletinfo" => $walletinfo);
                
    			$this->load->view('template/user/headermenu', $info);
    			$this->load->view('user/checkout', $content);
    		}
        }else{
            redirect(base_url('login'));
        }
    }

    public function comprovante() {
        if ($this->isLogged()){
			$this->load->model('AccountModel');
			$this->load->model('FOModel');
			$this->load->model('CartModel');
			$cart = new CartModel();
			$contas = new AccountModel();
			$fo = new FOModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$fo_banco = $this->input->post("fo_banco");
			$fo_value = $this->input->post("fo_value");
			
			$cartitens = $cart->listuser($this->session->userdata('userid'));
			
			$destino = $contas->search($fo_banco);
			
			if($destino){
			    $phase = 2;
			} else {
			    redirect(base_url('depositar'));
			}
					
            $content = array("destino" => $destino, "value" => $fo_value, "phase" => $phase, "cartitens" => $cartitens);
            
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/checkout', $content);
        }else{
            redirect(base_url('login'));
        }
    }

    public function finalizar() {
        if ($this->isLogged()){
			$config = $this->getConfig();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
			
			$this->load->model('BalanceModel');
			$this->load->model('AccountModel');
			$this->load->model('CartModel');
			$this->load->model('OrderModel');
			$this->load->model('OrdersuperModel');
			$this->load->model('OrdercontentsModel');
			$balance = new BalanceModel();
			$contas = new AccountModel();
			$cart = new CartModel();
			$order = new OrderModel();
			$os = new OrdersuperModel();
			$oc = new OrdercontentsModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$fo_banco = $this->input->post("fo_banco");
			$fo_value = $this->input->post("fo_value");
			$orderuser = $this->session->userdata('userid');
			$orderprice = 0;
			$orderattachment = null;
			
			$cartitens = $cart->listuser($this->session->userdata('userid'));
			
			$destino = $contas->search($fo_banco);
			
			if($cartitens){
			    $impedimento = 0;
    			foreach($cartitens as $ci){
    				$json = $this->getstatus();
    				$hindered = $oc->ishindered($ci->cartproduct, $ci->cartteam);
    				if($hindered){
    				    $cart->delete($ci->cartid);
						$impedimento = 1;
    				} else {
        				if($json['rodada_atual'] == $ci->cartproduct){
        				    date_default_timezone_set('America/Sao_Paulo');
        					if($json['fechamento']['dia'] == date('d')){
        						if(date('H') >= $json['fechamento']['hora']-1){
        					        if(date('i') >= $json['fechamento']['minuto']){
            					        $cart->delete($ci->cartid);
            						    $impedimento = 1;
            					    }
        					    }
        					}
        				}
    				}
    			}
    			if($impedimento == 0){
        			$cartitens = $cart->listuser($this->session->userdata('userid'));
        			
        			foreach($cartitens as $ci){
        				$orderprice += $ci->productprice;
        			}
        			
        			if($this->upload->do_upload('orderattachment')){
                        $imginfo = $this->upload->data();
                        $orderattachment = $imginfo['file_name'];
                    }
        			
        			$orderdata['orderid'] = null;
        			$orderdata['orderuser'] = $orderuser;
        			$orderdata['orderprice'] = $orderprice;
        			$orderdata['orderattachment'] = $orderattachment;
        			$orderdata['orderdate'] = date('Y-m-d H:i:s');
        			$orderdata['orderstatus'] = 1;
        			
        			if($orderattachment == null){
            			if($destino){
            			    $phase = 2;
            			} else {
            			    redirect(base_url('depositar'));
            			}
            			
            			$alert = array(
    						"class" => "warning",
    						"message" => "Ocorreu um erro no anexo!<br />
    						            Talvez você tenha anexado um arquivo com formato inválido.<br />
    						            Tente anexar um printscreen do comprovante.");
            					
                        $content = array(
                            "destino" => $destino, 
                            "value" => $fo_value, 
                            "phase" => $phase, 
                            "cartitens" => $cartitens,
                            "alert" => $alert
                        );
                        
            			$this->load->view('template/user/headermenu', $info);
            			$this->load->view('user/checkout', $content);
        			} else {
        			    if($order->save($orderdata)){
            				$lastorder = $order->lastinsert();
            				if($this->setSupernotify($lastorder, $destino)){
            					
            					$osdata['os_id'] = null;
            					$osdata['os_order'] = $lastorder['orderid'];
            					$osdata['os_super'] = $destino['acc_super'];
            					
            					if($os->save($osdata)){
            						foreach($cartitens as $ci){
            							
            							$oc_order = $lastorder['orderid'];
            							$oc_product = $ci->productid;
            							$oc_category = $ci->productcategory;
            							$oc_team = $ci->cartteam;
            							$oc_price = $ci->productprice;
            							
            							$ocdata['oc_id'] = null;
            							$ocdata['oc_order'] = $oc_order;
            							$ocdata['oc_product'] = $oc_product;
            							$ocdata['oc_category'] = $oc_category;
            							$ocdata['oc_team'] = $oc_team;
            							$ocdata['oc_price'] = $oc_price;
            							$ocdata['oc_status'] = 1;
            							
            							if($oc->save($ocdata)){
            							    $balanceitem = $balance->searchsuper($destino['acc_super']);
        			    
                            			    if($balanceitem){
                            			        $balancedata['balanceid'] = $balanceitem['balanceid'];
                            			        $balancedata['balancesuper'] = $balanceitem['balancesuper'];
                            			        $balancedata['balancepend'] = $balanceitem['balancepend']+$ci->productprice;
                            			        $balancedata['balanceconf'] = $balanceitem['balanceconf'];
                            			        $balancedata['balancetotal'] = $balanceitem['balancetotal']+$ci->productprice;
                            			        $balancedata['balancestatus'] = $balanceitem['balancestatus'];
                            			        
                            			        if($balance->update($balancedata)){
                            			            if($cart->delete($ci->cartid)){
                            			                $phase = 3;
                            			                
                            			                $getinfo = $this->getInfo();
    			                                        $info = array("info" => $getinfo);
                                    			    }
                            			        }
                            			    }
            								
            							}
            						}
            						$content = array("phase" => $phase);
                                            
                        			$this->load->view('template/user/headermenu', $info);
    			                    $this->load->view('user/checkout', $content);
            					}
            				}
            			}
        			}
    			} else {
					$getinfo = $this->getInfo();
        			$info = array("info" => $getinfo);
        			
        			$cartitens = $cart->listuser($this->session->userdata('userid'));
        			$alert = array(
    					"class" => "danger",
    					"message" => "Ops! Alguns de seus itens já foram solicitados ou não estão mais disponíveis. Removemos os itens indisponíveis para facilitar!");
        					
                    $content = array(
                        "cartitens" => $cartitens, "alert" => $alert);
                    
        			$this->load->view('template/user/headermenu', $info);
        			$this->load->view('user/cart', $content);
    			}
			} else {
				redirect(base_url('carrinho'));
			}
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function subspaid($userid, $cartitens){
        if ($this->isLogged()){
			$this->load->model('TeamModel');
			$this->load->model('RegistryModel');
			$this->load->model('SpinModel');
			$this->load->model('PaidModel');
			$this->load->model('BalanceModel');
			$this->load->model('FTRModel');
			$this->load->model('WalletModel');
			$this->load->model('CartModel');
			$cart = new CartModel();
			$wallet = new WalletModel();
            $team = new TeamModel();
			$registry = new RegistryModel();
			$spin = new SpinModel();
			$paid = new PaidModel();
			$ftr = new FTRModel();
			$balance = new BalanceModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			foreach($cartitens as $ci){
			    $regdata['registryid'] = null;
				$regdata['registryteam'] = $ci->cartteam;
				$regdata['registryspin'] = $ci->cartproduct;
				$regdata['registrysuper'] = null;
				$regdata['registrypaid'] = 1;
				
				if($registry->save($regdata)){
					$spinaux = $spin->search($ci->cartproduct);
					$paidaux = $paid->searchproduct($ci->cartproduct);
					
					$spindata['spinid'] = $spinaux['spinid'];
					$spindata['numteams'] = $spinaux['numteams']+1;
					$spindata['status'] = $spinaux['status'];
					
					$paiddata['paidid'] = $paidaux['paidid'];
					$paiddata['paidproduct'] = $paidaux['paidproduct'];
					$paiddata['paidteams'] = $paidaux['paidteams']+1;
					$paiddata['paidstatus'] = $paidaux['paidstatus'];
					
					$spin->update($spindata);
					$paid->update($paiddata);
					$cart->delete($ci->cartid);
				}
			}
			
			$nitens = count($cartitens);
            
            $total = ($nitens)*10;
			
			date_default_timezone_set('America/Sao_Paulo');
        		        
	        $ftrdata['ftr_id'] = null;
	        $ftrdata['ftr_type'] = 3; // 1-deposito # 2-saque # 3-inscrição # 4-premiação
	        $ftrdata['ftr_mode'] = 1; // 0-cash # 1-bonus
	        $ftrdata['ftr_date'] = date('Y-m-d H:i:s');
	        $ftrdata['ftr_user'] = $userid;
	        $ftrdata['ftr_super'] = null;
	        $ftrdata['ftr_value'] = $total;
	        $ftrdata['ftr_attachment'] = null;
	        $ftrdata['ftr_validator'] = $this->validgen($ftrdata);
	        
	        if($ftr->save($ftrdata)){
                $walletitem = $wallet->search($userid);
                if($walletitem['wallet_balance'] >= $total){
                    if($walletitem['wallet_gift'] >= $total){
                        $walletdata['wallet_id'] = $walletitem['wallet_id'];
                        $walletdata['wallet_user'] = $walletitem['wallet_user'];
                        $walletdata['wallet_balance'] = $walletitem['wallet_balance'] - $total;
                        $walletdata['wallet_free'] = $walletitem['wallet_free'];
                        $walletdata['wallet_gift'] = $walletitem['wallet_gift']-$total;
                        
                        if($wallet->update($walletdata)){
                            return true;
                        }
                    } else {
                        $walletdata['wallet_id'] = $walletitem['wallet_id'];
                        $walletdata['wallet_user'] = $walletitem['wallet_user'];
                        $walletdata['wallet_balance'] = $walletitem['wallet_balance'] - $total;
                        $total = $total - $walletitem['wallet_gift'];
                        $walletdata['wallet_free'] = $walletitem['wallet_free'] - $total;
                        $walletdata['wallet_gift'] = 0;
                        
                        if($wallet->update($walletdata)){
                            return true;
                        }
                    }
                } else {
                    return false;
                }
	        }
			
		}else{
            redirect(base_url('login'));
        }
	}
    
    function validgen($ftrdata){
        $partialone = md5($ftrdata['ftr_type']."!".$ftrdata['ftr_mode']);
        $partialtwo = md5($ftrdata['ftr_date']."@".$ftrdata['ftr_user']);
        $validator = md5($partialone."#".$ftrdata['ftr_value']."$".$partialtwo);
        
        return $validator;
    }
	
	public function getConfig(){
		$config = array(
			"upload_path" => "assets/comprovantes",
			"allowed_types" => "jpg|jpeg|png|pdf",
			"encrypt_name" => true
		);
		
		return $config;
	}
	
    public function setSupernotify($lastorder, $destino) {
        $this->load->model('SupernotifyModel');
		$snaux = new SupernotifyModel();
		
		$sndata['sn_id'] = null;
		$sndata['sn_super'] = $destino['acc_super'];
		$sndata['sn_date'] = date('Y-m-d H:i:s');
		$sndata['sn_description'] = "Nova solicitação de inscrição de ".$lastorder['username'];
		$sndata['sn_link'] = "ordeminsc/inscricao/".$lastorder['orderid'];
		$sndata['sn_status'] = 1;
		
		if($snaux->save($sndata)){
			return true;
		}
		
    }
	
    public function getInfo() {
        $this->load->model('UsernotifyModel');
        $this->load->model('CartModel');
		$this->load->model('UserModel');
		$unaux = new UsernotifyModel();
		$cartaux = new CartModel();
		$user = new UserModel();
		
		$notifications = $unaux->listuser($this->session->userdata('userid'));
		$countnotify = $unaux->countlistuser($this->session->userdata('userid'));
		$cartitens = $cartaux->listuser($this->session->userdata('userid'));
		$userlogged = $user->searchid($this->session->userdata('userid'));
		
		return array(
			"pageid" => 2,
			"notifications" => $notifications,
			"countnotify" => count($countnotify),
			"countcart" => count($cartitens),
			"userlogged" => $userlogged
		);
    }
}