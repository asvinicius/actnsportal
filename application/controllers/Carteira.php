<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carteira extends CI_Controller {
    public function index() {
        if ($this->isLogged()){
			$this->load->model('WalletModel');
			$this->load->model('FOModel');
			$wallet = new WalletModel();
			$fo = new FOModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$walletinfo = $wallet->search($this->session->userdata('userid'));
			$orderinfo = $fo->listingbyuser($this->session->userdata('userid'));
					
            $content = array("walletinfo" => $walletinfo, "orderinfo" => $orderinfo);
            
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/wallet', $content);
        }else{
            redirect(base_url('login'));
        }
    }

    public function delete($cartid) {
        if ($this->isLogged()){
			$this->load->model('CartModel');
			$cart = new CartModel();
			
			if($cart->delete($cartid)){
				$alert = array(
					"class" => "success",
					"message" => "Item removido do carrinho!");
			} else {
				$alert = array(
					"class" => "danger",
					"message" => "Não foi possível remover o item!");
			}
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$cartitens = $cart->listuser($this->session->userdata('userid'));
					
            $content = array("cartitens" => $cartitens, "alert" => $alert);
            
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/cart', $content);
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