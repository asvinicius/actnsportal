<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

    public function index() {
        if ($this->isUser()){
            $this->load->model('UserModel');
            $user = new UserModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$json = $this->getstatus();
			
    		$useritem = $user->searchid($this->session->userdata('userid'));
			
			$content = array(
				"user" => $useritem);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/perfil', $content);
			
        }else{
            redirect(base_url('login'));
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