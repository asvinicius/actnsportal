<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inicio extends CI_Controller {
    public function index() {
        if ($this->isUser()){
            $this->load->model('RegistryModel');
            $this->load->model('ProductModel');
			$this->load->model('SpinModel');
			$this->load->model('PaidModel');
			$this->load->model('WalletModel');
            $registry = new RegistryModel();
            $product = new ProductModel();
            $spin = new SpinModel();
            $paid = new PaidModel();
			$wallet = new WalletModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$json = $this->getstatus();
			
			$next = $spin->shownext($json['rodada_atual']);
			$reglisting = $registry->listing($json['rodada_atual']);
			$productdata = $product->getproduct($json['rodada_atual']);
			$spindata = $spin->search($json['rodada_atual']);
			$paiddata = $paid->searchproduct($json['rodada_atual']);
			$walletinfo = $wallet->search($this->session->userdata('userid'));
			
			$content = array(
			    "walletinfo" => $walletinfo,
			    "status_mercado" => $json['status_mercado'],
				"next" => $next,
				"teams" => $reglisting, 
				"spin" => $json['rodada_atual'], 
				"product" => $productdata,
				"spindata" => $spindata,
				"paiddata" => $paiddata,
				"json" => $json);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/home', $content);
			
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