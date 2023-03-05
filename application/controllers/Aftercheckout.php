<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aftercheckout extends CI_Controller {

    public function index() {
        if ($this->isLogged()){
			$this->load->model('CartModel');
			$cart = new CartModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$cartitens = $cart->listuser($this->session->userdata('userid'));
					
            $content = array("cartitens" => $cartitens);
            
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/aftercheckout', $content);
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
			"pageid" => 3,
			"notifications" => $notifications,
			"countnotify" => count($countnotify),
			"countcart" => count($cartitens),
			"userlogged" => $userlogged
		);
    }
}