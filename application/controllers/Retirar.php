<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Retirar extends CI_Controller {

    public function index() {
        if ($this->isLogged()){
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
        
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/cashout');
        }else{
            redirect(base_url('login'));
        }
    }

    public function chave() {
        if ($this->isLogged()){
			$this->load->model('BalanceModel');
			$this->load->model('AccountModel');
			$this->load->model('UserModel');
			$this->load->model('FOModel');
			$this->load->model('WalletModel');
			$wallet = new WalletModel();
			$balance = new BalanceModel();
			$user = new UserModel();
			$contas = new AccountModel();
			$fo = new FOModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$max_rec = $balance->maxtotal();
			$superid = null;
			
			if($max_rec){
			    foreach($max_rec as $balance){
			        $superid = $balance->superid;
			    }
			}
			
			$fo_value = $this->input->post("fo_value");
			
			$walletitem = $wallet->search($this->session->userdata('userid'));
			
			if($walletitem['wallet_free'] >= $fo_value){
			    $destino = $contas->searchsuper($superid);
			
    			if($destino){
    			    $phase = 1;
    			} else {
    			    redirect(base_url('depositar'));
    			}
    			
    			$useritem = $user->searchid($this->session->userdata('userid'));
    					
                $content = array("destino" => $destino, "value" => $fo_value, "phase" => $phase, "useritem" => $useritem);
                
    			$this->load->view('template/user/headermenu', $info);
    			$this->load->view('user/cashout', $content);
			} else {
			    
			    $alert = array(
					"class" => "danger",
					"message" => "O valor solicitado para saque supera o disponível em carteira");
					
				$content = array("alert" => $alert);
			    
			    $this->load->view('template/user/headermenu', $info);
			    $this->load->view('user/cashout', $content);
			}
        }else{
            redirect(base_url('login'));
        }
    }

    public function confirmacao() {
        if ($this->isLogged()){
			$this->load->model('AccountModel');
			$this->load->model('FOModel');
			$this->load->model('UserModel');
			$user = new UserModel();
			$contas = new AccountModel();
			$fo = new FOModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$fo_banco = $this->input->post("fo_banco");
			$fo_value = $this->input->post("fo_value");
			$userkey = $this->input->post("userkey");
			
			$useritem = $user->searchid($this->session->userdata('userid'));
			
			if($useritem['userkey'] != $userkey){
			    $userdata['userid'] = $useritem['userid'];
			    $userdata['username'] = $useritem['username'];
			    $userdata['useremail'] = $useritem['useremail'];
			    $userdata['userphone'] = $useritem['userphone'];
			    $userdata['userkey'] = $userkey;
			    $userdata['userpassword'] = $useritem['userpassword'];
			    $userdata['userstatus'] = $useritem['userstatus'];
			    
			    if($user->update($userdata)){
			        $useritem = $user->searchid($this->session->userdata('userid'));
			    }
			}
			
			$destino = $contas->search($fo_banco);
			if($destino){
			    $phase = 2;
			} else {
			    redirect(base_url('depositar'));
			}
					
            $content = array("destino" => $destino, "value" => $fo_value, "phase" => $phase, "useritem" => $useritem);
            
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/cashout', $content);
			
        }else{
            redirect(base_url('login'));
        }
    }

    public function finalizar() {
        if ($this->isLogged()){
			
			$this->load->model('BalanceModel');
			$this->load->model('AccountModel');
			$this->load->model('FOModel');
			$this->load->model('UserModel');
			$this->load->model('WalletModel');
			$wallet = new WalletModel();
			$user = new UserModel();
			$balance = new BalanceModel();
			$contas = new AccountModel();
			$fo = new FOModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$fo_banco = $this->input->post("fo_banco");
			$fo_value = $this->input->post("fo_value");
			$userpassword = $this->input->post("userpassword");
			
			$destino = $contas->search($fo_banco);
			
			if($destino){
			    
			    $useritem = $user->searchid($this->session->userdata('userid'));
			    
			    if($useritem['userpassword'] == md5($userpassword)){
			        
        			$orderdata['fo_id'] = null;
        			$orderdata['fo_user'] = $this->session->userdata('userid');
        			$orderdata['fo_super'] = $destino['acc_super'];
        			$orderdata['fo_value'] = $fo_value;
        			$orderdata['fo_type'] = 0;
        			$orderdata['fo_attach'] = null;
        			$orderdata['fo_date'] = date('Y-m-d H:i:s');
        			$orderdata['fo_status'] = 1;
        			
        			if($fo->save($orderdata)){
        			    
        			    $lastorder = $fo->lastinsert();
        			    
        			    $walletitem = $wallet->search($this->session->userdata('userid'));
			
            			$walletdata['wallet_id'] = $walletitem['wallet_id'];
            		    $walletdata['wallet_user'] = $walletitem['wallet_user'];
            		    $walletdata['wallet_balance'] = $walletitem['wallet_balance']-$fo_value;
            		    $walletdata['wallet_free'] = $walletitem['wallet_free']-$fo_value;
            		    $walletdata['wallet_gift'] = $walletitem['wallet_gift'];
        		    
        		        if($wallet->update($walletdata)){
        			    
            			    $balanceitem = $balance->searchsuper($destino['acc_super']);
            			    
            			    if($balanceitem){
            			        $balancedata['balanceid'] = $balanceitem['balanceid'];
            			        $balancedata['balancesuper'] = $balanceitem['balancesuper'];
            			        $balancedata['balancepend'] = $balanceitem['balancepend']-$fo_value;
            			        $balancedata['balanceconf'] = $balanceitem['balanceconf'];
            			        $balancedata['balancetotal'] = $balanceitem['balancetotal']-$fo_value;
            			        $balancedata['balancestatus'] = $balanceitem['balancestatus'];
            			        
            			        if($balance->update($balancedata)){
            			            if($this->setSupernotify($lastorder, $destino)){
            			        
                    			        $phase = 3;
                    			        
                    			        $content = array("phase" => $phase);
                            
                            			$this->load->view('template/user/headermenu', $info);
                            			$this->load->view('user/cashout', $content);
                    			    }
            			        }
            			    }
        			    }
        			}
        			
    			} else {
        			$phase = 2;
        			
        			$alert = array(
    					"class" => "danger",
    					"message" => "A senha informada está incorreta");
    					
                    $content = array("destino" => $destino, "value" => $fo_value, "phase" => $phase, "useritem" => $useritem, "alert" => $alert);
                    
        			$this->load->view('template/user/headermenu', $info);
        			$this->load->view('user/cashout', $content);
    			}
			} else {
			    redirect(base_url('depositar'));
			}
        }else{
            redirect(base_url('login'));
        }
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
		$sndata['sn_description'] = "Nova solicitação de saque de ".$lastorder['username'];
		$sndata['sn_link'] = "ordemfinanc/id/".$lastorder['fo_id'];
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
			"pageid" => 3,
			"notifications" => $notifications,
			"countnotify" => count($countnotify),
			"countcart" => count($cartitens),
			"userlogged" => $userlogged
		);
    }
}