<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

    public function index() {
        if ($this->isUser()){
            redirect(base_url('inicio'));
        } else {
            $this->load->view('public/register');
        }
    }
	
	public function salvar(){
        $this->load->model('UserModel');
        $this->load->model('WalletModel');
		$user = new UserModel();
		$wallet = new WalletModel();
		
		$username = $this->input->post('username');
		$useremail = $this->input->post('useremail');
		$userphone = $this->input->post('userphone');
		$userpassword = md5($this->input->post('userpassword'));
		
		if($this->emailrestriction($useremail)){
			$alert = array(
				"class" => "warning",
				"message" => "O E-mail inserido já existe em nossa base de dados!<br />
				Entre em contato com um administrador ou solicite recuperação de senha.");

			$info = array("alert" => $alert);
		
			$this->load->view('public/register', $info);
		} else {
			
			$userdata['userid'] = null;
			$userdata['username'] = $username;
			$userdata['useremail'] = $useremail;
			$userdata['userphone'] = $userphone;
			$userdata['userkey'] = null;
			$userdata['userpassword'] = $userpassword;
			$userdata['userstatus'] = 1;
			
			if($user->save($userdata)){
			    
			    $lastuser = $user->lastinsert();
    			    
			    $walletdata['wallet_id'] = null;
			    $walletdata['wallet_user'] = $lastuser['userid'];
			    $walletdata['wallet_balance'] = 0;
			    $walletdata['wallet_free'] = 0;
			    $walletdata['wallet_gift'] = 0;
			    
			    if($wallet->save($walletdata)){
			        
			        $this->load->view('public/afterregister', $info);
			        
			        /*
			        $pretoken = base64_encode($useremail);
					$exp = explode("=", $pretoken);
					$token = $exp[0];
					
					if($this->sendmail($token, $useremail)){
					    
				    	$info = array("useremail" => $useremail);
			        
			            $this->load->view('public/afterregister', $info);
			            
					} else {
					    
					}
					*/
			        
			    }
				/*
				if($this->sendnumail($userdata)){
					$info = array("useremail" => $userdata['useremail']);
					$this->load->view('public/afterregister', $info);
					return true;
				} else {
					$alert = array(
						"class" => "warning",
						"message" => "Ops! Aconteceu um problema ao enviar seu e-mail de confirmação.
							<br />Por favor, entre em contato com um administrador para solicitar a confirmação.");

					$info = array("alert" => $alert);
				
					$this->load->view('public/register', $info);
				}
				*/
			} else {
				$alert = array(
					"class" => "warning",
					"message" => "Ops! Aconteceu um problema ao enviar seu cadastro.
						<br />Por favor, entre em contato com um administrador para solucionar.");

				$info = array("alert" => $alert);
			
				$this->load->view('public/register', $info);
			}
		}
	}
	
	public function validar($token = null){
	    if ($this->isUser()){
            redirect(base_url('inicio'));
        } else {
            $this->load->model('UserModel');
		    $user = new UserModel();
		    
		    $useremail = base64_decode($token."==");
		    
		    $useritem = $user->searchemail($useremail);
		    
		    if($useritem){
		        if($useritem['userstatus'] == 0){
		            $userdata['userid'] = $useritem['userid'];
        			$userdata['username'] = $useritem['username'];
        			$userdata['useremail'] = $useritem['useremail'];
        			$userdata['userphone'] = $useritem['userphone'];
			        $userdata['userkey'] = $useritem['userkey'];
        			$userdata['userpassword'] = $useritem['userpassword'];
        			$userdata['userstatus'] = 1;
        			
        			if($user->update($userdata)){
        			    $this->load->view('public/confirmregister');
        			} else {
        				$alert = array(
        				    "type" => 0,
        					"class" => "danger",
        					"message" => "Infelizmente não foi possível confirmar seu E-mail. Por favor, entre em contato com um administrador!");
        				
        				$info = array("alert" => $alert);
        				
        				//$this->load->view('public/resetmessage', $info);
        			}
		        } else {
		            $alert = array(
    				    "type" => 0,
    					"class" => "primary",
    					"message" => "Seu E-mail já foi validado. Por favor, faça login.");
    				
    				$info = array("alert" => $alert);
    				
    				//$this->load->view('public/resetmessage', $info);
		        }
		    } else {
				$alert = array(
				    "type" => 0,
					"class" => "danger",
					"message" => "O E-mail informado não consta em nossa base de dados. Por favor, entre em contato com um administrador!");
				
				$info = array("alert" => $alert);
				
				//$this->load->view('public/resetmessage', $info);
			}
		    
        }
	}
	
	function emailrestriction($useremail = null){
		$this->load->model('UserModel');
		$user = new UserModel();
		
		if($user->searchemail($useremail)){
			return true;
		}
	}
	
	public function sendmail($token, $useremail) {
		require("assets/phpmailer/src/PHPMailer.php");
		require("assets/phpmailer/src/SMTP.php");
		
		$this->load->library('email');
		$this->load->model('UsernotifyModel');
		$un = new UsernotifyModel();
		
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true; 
		$mail->SMTPSecure = 'ssl'; 
		$mail->Host = "vps-8344355.acretinos.com.br";
		$mail->Port = 465;
		$mail->IsHTML(true);
		$mail->Username = "no-reply@acretinos.com.br";
		$mail->Password = "#asv930815";
		$mail->SetFrom("no-reply@acretinos.com.br");
		$mail->Subject = "Confirme seu e-mail";
		$mail->Body = 
		    '<!DOCTYPE html>
            <html lang="en">
            <head>
            	<meta charset="utf-8">
            	<style type="text/css">
            
            	::selection { background-color: #E13300; color: white; }
            	::-moz-selection { background-color: #E13300; color: white; }
            
            	body {
            		text-align:center;
            		margin-top:50px;
            		background-color: #fff;
            		margin: 5px;
            		font: 13px/20px normal Helvetica, Arial, sans-serif;
            		color: #4F5155;
            	}
            
            	a {
            		color: #003399;
            		background-color: transparent;
            		font-weight: normal;
            	}
            
            	h1 {
            		color: #444;
            		background-color: transparent;
            		border-bottom: 1px solid #D0D0D0;
            		font-size: 25px;
            		font-weight: normal;
            		margin: 0 0 14px 0;
            		padding: 14px 15px 10px 15px;
            	}
            
            	code {
            		font-family: Consolas, Monaco, Courier New, Courier, monospace;
            		font-size: 12px;
            		background-color: #f9f9f9;
            		border: 1px solid #D0D0D0;
            		color: #002166;
            		display: block;
            		margin: 14px 0 14px 0;
            		padding: 12px 10px 12px 10px;
            	}
            
            	#body {
            		text-align:center;
            		margin-top:50px;
            		margin: 0 15px 0 15px;
            	}
            
            	p.footer {
            		text-align: right;
            		font-size: 11px;
            		border-top: 1px solid #D0D0D0;
            		line-height: 32px;
            		padding: 0 10px 0 10px;
            		margin: 20px 0 0 0;
            	}
            
            	#container {
            		margin: 10px;
            		border: 1px solid #D0D0D0;
            		box-shadow: 0 0 8px #D0D0D0;
            	}
            	</style>
                </head>
                	<body>
                		<img src="https://www.acretinos.com.br/assets/img/logomail.png" height="150px">
                		<div id="container">
                			<h1>Ola, Cartoleiro.</h1>
                
                			<div id="body">
                				<h3>Seja bem-vindo a Liga Acretinos!</h3>
                
                				<p>Clique ou copie o link abaixo para confirmar o seu cadastro.</p>
                				<code><a href="https://portal.acretinos.com.br/cadastro/validar/'.$token.'">https://portal.acretinos.com.br/cadastro/validar/'.$token.'</a></code>
                
                				<p>Agradecemos a confianca,</p>
                
                				<p>Equipe Acretinos.</p>
                			</div>
                
                			<p class="footer">E-mail automatico. Por favor, <strong>nao responda.</strong></p>
                		</div>
                
                	</body>
                </html>';
                
		$mail->AddAddress($useremail);
		
		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			return true;
		}
    }
	
    public function getPage() {
        return array("id" => 0);
    }
	
    public function getInfo() {
        return array("id" => 0);
    }
}