<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editaperfil extends CI_Controller {

    public function index() {
        if ($this->isUser()){
            $this->load->model('UserModel');
            $user = new UserModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
    		$useritem = $user->searchid($this->session->userdata('userid'));
			
			$content = array(
				"user" => $useritem);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/editaperfil', $content);
			
        }else{
            redirect(base_url('login'));
        }		
    }
    
    public function atualizar(){
        if ($this->isUser()){
    		$this->load->model('UserModel');
    		$user = new UserModel();
    		
    		$username = $this->input->post('username');
    		$useremail = $this->input->post('useremail');
    		$userphone = $this->input->post('userphone');
    		$userkey = $this->input->post('userkey');
    		
    		$useritem = $user->searchid($this->session->userdata('userid'));
    		
    		if($useritem['useremail'] == $useremail){
    		    $userdata['userid'] = $useritem['userid'];
    			$userdata['username'] = $username;
    			$userdata['useremail'] = $useremail;
    			$userdata['userphone'] = $userphone;
    			$userdata['userkey'] = $userkey;
    			$userdata['userpassword'] = $useritem['userpassword'];
    			$userdata['userstatus'] = $useritem['userstatus'];
    			
    			if($user->update($userdata)){
    			    redirect(base_url('perfil'));
    			}
    		} else {
    		    if($this->emailrestriction($useremail)){
    		        $getinfo = $this->getInfo();
        			$info = array("info" => $getinfo);
        			
            		$useritem = $user->searchid($this->session->userdata('userid'));
            		$alert = array(
        				"class" => "warning",
        				"message" => "O E-mail inserido já pertence a outro usuário");
        			
        			$content = array(
        				"user" => $useritem,
        				"alert" => $alert);
        				
    				$this->load->view('template/user/headermenu', $info);
    			    $this->load->view('user/editaperfil', $content);
    			    
    		    } else {
    		        $userdata['userid'] = $useritem['userid'];
        			$userdata['username'] = $username;
        			$userdata['useremail'] = $useremail;
        			$userdata['userphone'] = $userphone;
        			$userdata['userkey'] = $userkey;
        			$userdata['userpassword'] = $useritem['userpassword'];
        			$userdata['userstatus'] = $useritem['userstatus'];
        			
        			if($user->update($userdata)){
        			    redirect(base_url('perfil'));
        			}
    		    }
    		}
        }else{
            redirect(base_url('login'));
        }
	}
	
	function emailrestriction($useremail = null){
		$this->load->model('UserModel');
		$user = new UserModel();
		
		if($user->searchemail($useremail)){
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
			"pageid" => 0,
			"notifications" => $notifications,
			"countnotify" => count($countnotify),
			"countcart" => count($cartitens),
			"userlogged" => $userlogged
		);
    }
}