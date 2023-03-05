<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Depositar extends CI_Controller {

    public function index() {
        if ($this->isLogged()){
            
            redirect(base_url('carteira'));
            
            /*
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
        
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/deposit');
			*/
        }else{
            redirect(base_url('login'));
        }
    }

    public function saldo() {
        if ($this->isLogged()){
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$alert = array(
				"class" => "danger",
				"message" => "O seu saldo não é suficiente. Por favor, faça um depósito");
				
			$content = array( 
			    "alert" => $alert);
        
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/deposit', $content);
        }else{
            redirect(base_url('login'));
        }
    }

    public function instrucao() {
        if ($this->isLogged()){
			$this->load->model('BalanceModel');
			$this->load->model('AccountModel');
			$this->load->model('FOModel');
			$balance = new BalanceModel();
			$contas = new AccountModel();
			$fo = new FOModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$min_rec = $balance->mintotal();
			$superid = null;
			
			if($min_rec){
			    foreach($min_rec as $balance){
			        $superid = $balance->superid;
			    }
			}
			
			$fo_value = $this->input->post("fo_value");
			
			if($fo_value >= 1){
    			$destino = $contas->searchsuper($superid);
    			if($destino){
    			    $phase = 1;
    			} else {
    			    //redirect(base_url('depositar'));
    			    redirect(base_url('carteira'));
    			}
    					
                $content = array("destino" => $destino, "value" => $fo_value, "phase" => $phase);
                
    			$this->load->view('template/user/headermenu', $info);
    			$this->load->view('user/deposit', $content);
    		} else {
                $getinfo = $this->getInfo();
    			$info = array("info" => $getinfo);
    			
    			$alert = array(
    				"class" => "danger",
    				"message" => "Por favor, informe um valor para ser depositado");
    				
    			$content = array( 
    			    "alert" => $alert);
            
    			$this->load->view('template/user/headermenu', $info);
    			$this->load->view('user/deposit', $content);
            }
        }else{
            redirect(base_url('login'));
        }
    }

    public function comprovante() {
        if ($this->isLogged()){
			$this->load->model('AccountModel');
			$this->load->model('FOModel');
			$contas = new AccountModel();
			$fo = new FOModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$fo_banco = $this->input->post("fo_banco");
			$fo_value = $this->input->post("fo_value");
			
			$destino = $contas->search($fo_banco);
			if($destino){
			    $phase = 2;
			} else {
    			    //redirect(base_url('depositar'));
    			    redirect(base_url('carteira'));
			}
					
            $content = array("destino" => $destino, "value" => $fo_value, "phase" => $phase);
            
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/deposit', $content);
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
			$this->load->model('FOModel');
			$balance = new BalanceModel();
			$contas = new AccountModel();
			$fo = new FOModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$fo_banco = $this->input->post("fo_banco");
			$fo_value = $this->input->post("fo_value");
			
			$destino = $contas->search($fo_banco);
			
			if($destino){
    			if($this->upload->do_upload('fo_attach')){
                    $imginfo = $this->upload->data();
                    $fo_attach = $imginfo['file_name'];
                }else{
    				echo $this->upload->display_errors();
    			}
    			
    			$orderdata['fo_id'] = null;
    			$orderdata['fo_user'] = $this->session->userdata('userid');
    			$orderdata['fo_super'] = $destino['acc_super'];
    			$orderdata['fo_value'] = $fo_value;
    			$orderdata['fo_type'] = 1;
    			$orderdata['fo_attach'] = $fo_attach;
    			$orderdata['fo_date'] = date('Y-m-d H:i:s');
    			$orderdata['fo_status'] = 1;
    			
    			if($fo->save($orderdata)){
    			    
    			    $lastorder = $fo->lastinsert();
    			    $balanceitem = $balance->searchsuper($destino['acc_super']);
    			    
    			    if($balanceitem){
    			        $balancedata['balanceid'] = $balanceitem['balanceid'];
    			        $balancedata['balancesuper'] = $balanceitem['balancesuper'];
    			        $balancedata['balancepend'] = $balanceitem['balancepend']+$fo_value;
    			        $balancedata['balanceconf'] = $balanceitem['balanceconf'];
    			        $balancedata['balancetotal'] = $balanceitem['balancetotal']+$fo_value;
    			        $balancedata['balancestatus'] = $balanceitem['balancestatus'];
    			        
    			        if($balance->update($balancedata)){
    			            if($this->setSupernotify($lastorder, $destino)){
    			        
            			        $phase = 3;
            			        
            			        $content = array("phase" => $phase);
                    
                    			$this->load->view('template/user/headermenu', $info);
                    			$this->load->view('user/deposit', $content);
            			    }
    			        }
    			    }
    			}
			} else {
    			    //redirect(base_url('depositar'));
    			    redirect(base_url('carteira'));
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
		
		date_default_timezone_set('America/Sao_Paulo');
		
		$sndata['sn_id'] = null;
		$sndata['sn_super'] = $destino['acc_super'];
		$sndata['sn_date'] = date('Y-m-d H:i:s');
		$sndata['sn_description'] = "Nova solicitação de depósito de ".$lastorder['username'];
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