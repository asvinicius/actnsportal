<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendmail extends CI_Controller {

    public function index() {
        if ($this->isUser()){
            redirect(base_url('inicio'));
        } else {
			$this->load->view('public/reset');
        }
    }
    
    public function reset() {
		if ($this->isUser()){
			redirect(base_url('inicio'));
		} else {
			$this->load->model("UserModel");
			$user = new UserModel();
			
			$useremail = $this->input->post("resetemail");
			
			$useritem = $user->searchemail($useremail);
			
			if($useritem){
				if($useritem['userstatus'] == '1'){
					$date = new DateTime();
                    $future = $date->getTimestamp()+1800;
					$pretoken = base64_encode($useritem['useremail']."-".$future);
					
					$exp = explode("=", $pretoken);
					$token = $exp[0];
					
					if($this->sendmail($token, $useritem['useremail'])){
    					$alert = array(
    						"class" => "success",
    						"message" => "Solicitação enviada com sucesso!<br />Verifique seu e-mail para prosseguir.<br />Obs.: Verifique também sua Caixa de Spam (Lixo Eletrônico)");
    
    					$info = array("alert" => $alert);
					}else{
    					$alert = array(
    						"class" => "danger",
    						"message" => "Não foi possível enviar o e-mail");
    
    					$info = array("alert" => $alert);
					}
				
					$this->load->view('public/reset', $info);
				}else{
					$alert = array(
						"class" => "warning",
						"message" => "Seu acesso esta bloqueado!<br />Entre em contato com um administrador.");

					$info = array("alert" => $alert);
				
					$this->load->view('public/reset', $info);
				}
			}else {
				$alert = array(
					"class" => "danger",
					"message" => "O E-mail informado não consta em nossa base de dados");
				
				$info = array("alert" => $alert);
				
				$this->load->view('public/reset', $info);
			}
		}
    }
    
    public function novasenha($token = null) {
		if ($this->isUser()){
			redirect(base_url('inicio'));
		} else {
			$this->load->model("UserModel");
			$user = new UserModel();
			
			$exp = explode("-", base64_decode($token."=="));
			$useremail = $exp[0];
			$prazo = $exp[1];
			
			$useritem = $user->searchemail($useremail);
			
			if($useritem){
			    $date = new DateTime();
                $permiso = $date->getTimestamp();
                
                if($prazo >= $permiso){
                    
                    $content = array("user" => $useritem);
                    
                    $this->load->view('public/setpass', $content);
                } else {
                    $alert = array(
				        "type" => 0,
    					"class" => "danger",
    					"message" => "O seu tempo expirou. Por favor, faça a solicitação novamente!");
    				
    				$info = array("alert" => $alert);
    				
    				$this->load->view('public/resetmessage', $info);
                }
			} else {
				$alert = array(
				    "type" => 0,
					"class" => "danger",
					"message" => "O E-mail informado não consta em nossa base de dados. Por favor, entre em contato com um administrador!");
				
				$info = array("alert" => $alert);
				
				$this->load->view('public/resetmessage', $info);
			}
		}
    }
    
    public function atualizar() {
        if ($this->isUser()){
			redirect(base_url('inicio'));
		} else {
			$this->load->model("UserModel");
			$user = new UserModel();
			
			$userid = $this->input->post('userid');
    		$userpassword = md5($this->input->post('userpassword'));
    		
    		$useritem = $user->searchid($userid);
    		
    		$userdata['userid'] = $useritem['userid'];
			$userdata['username'] = $useritem['username'];
			$userdata['useremail'] = $useritem['useremail'];
			$userdata['userphone'] = $useritem['userphone'];
			$userdata['userpassword'] = $userpassword;
			$userdata['userstatus'] = $useritem['userstatus'];
			
			if($user->update($userdata)){
			    $alert = array(
				    "type" => 1,
					"class" => "success",
					"message" => "Sua senha foi alterada com sucesso!");
				
				$info = array("alert" => $alert);
				
				$this->load->view('public/resetmessage', $info);
			} else {
			    $alert = array(
				    "type" => 0,
					"class" => "danger",
					"message" => "Infelizmente não foi possível atualizar seus dados. Por favor, entre em contato com um administrador!");
				
				$info = array("alert" => $alert);
				
				$this->load->view('public/resetmessage', $info);
			}
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
		$mail->Host = "vps-4868041.acretinos.com.br";
		$mail->Port = 465;
		$mail->IsHTML(true);
		$mail->Username = "no-reply@acretinos.com.br";
		$mail->Password = "#asv930815";
		$mail->SetFrom("no-reply@acretinos.com.br");
		$mail->Subject = "Redefinir senha";
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
                		<div id="container">
                			<h1>Ola.</h1>
                
                			<div id="body">
                				<h3>Recebemos sua solicitacao para recuperacao de senha.</h3>
                
                				<p>Clique ou copie o link abaixo para escolher uma nova senha. Este token fica valendo por 30 minutos</p>
                				<code><a href="https://portal.acprojectscars.com.br/redefinir/novasenha/'.$token.'">https://portal.acretinos.com.br/redefinir/novasenha/'.$token.'</a></code>
                
                				<p>Agradecemos a confianca,</p>
                
                				<p>AC Projects Cars.</p>
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