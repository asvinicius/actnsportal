<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    public function index() {
        if ($this->isUser()){
            redirect(base_url('inicio'));
        } else {
            $this->load->model("UCModel");
            $uc = new UCModel();
            
            $aux = $uc->search(1);
            
            if($aux['uc_portal'] == 1){
                $this->load->view('public/login');
            } else {
                $this->load->view('public/updating');
            }
        }
    }
	public function signin() {
		if ($this->isUser()){
			redirect(base_url('inicio'));
		} else {
			$this->load->model("LoginModel");
			$this->load->model("WalletModel");
			$this->load->model("TrafegoModel");
		    $wallet = new WalletModel();
		    $trafego = new TrafegoModel();
			
			$useremail = $this->input->post("useremail");
			$userpassword = md5($this->input->post("userpassword"));
			
			$user = $this->LoginModel->search($useremail, $userpassword);
			
			if($user){
				if($user['userstatus'] == '1'){
				    if($wallet->search($user['userid'])){
				        $session = array(
    						'userid' => $user["userid"],
    						'username' => $user["username"],
    						'logged' => TRUE,
    						'role' => 2
    					);
    
    					$this->session->set_userdata($session);
    					
    					date_default_timezone_set('America/Sao_Paulo');
    					
    					$trafegodata['trafego_id'] = null;
                        $trafegodata['trafego_user'] = $user["userid"];
                        $trafegodata['trafego_date'] = date('Y-m-d H:i:s');
                        $trafegodata['trafego_status'] = 1;
                        
                        if($trafego->save($trafegodata)){
    					    redirect(base_url('login'));
                        }
    					
				    } else {
				        
				        $walletdata['wallet_id'] = null;
        			    $walletdata['wallet_user'] = $user["userid"];
        			    $walletdata['wallet_balance'] = 0;
        			    $walletdata['wallet_free'] = 0;
        			    $walletdata['wallet_gift'] = 0;
        			    
        			    if($wallet->save($walletdata)){
        			        
        			        $session = array(
        						'userid' => $user["userid"],
        						'username' => $user["username"],
        						'logged' => TRUE,
        						'role' => 2
        					);
        
        					$this->session->set_userdata($session);
        
        					redirect(base_url('login'));
        			        
        			    }
				        
				    }
					
				}else{
					$alert = array(
						"class" => "warning",
						"message" => "Seu acesso esta bloqueado!<br />
						            Talvez você ainda não tenha validado seu E-mail. Verifique sua caixa de entrada ou spam.<br />
						            Caso já tenha validado seu cadastro, entre em contato com um administrador para solucionar o problema.");

					$info = array("alert" => $alert);
				
					$this->load->view('public/login', $info);
				}
			}else {
				$alert = array(
					"class" => "danger",
					"message" => "E-mail ou senha incorretos");
				
				$info = array("alert" => $alert);
				
				$this->load->view('public/login', $info);
			}
		}
    }
    
    public function signout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}