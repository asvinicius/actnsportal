<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Liga extends CI_Controller {

    public function id($productid = null) {
        if ($this->isLogged()){
			$this->load->model('UserModel');
            $this->load->model('TeamModel');
            $this->load->model('PaidModel');
			$this->load->model('CartModel');
            $this->load->model('ProductModel');
            $this->load->model('RegistryModel');
            $this->load->model('ProductcategoryModel');
			
			$user = new UserModel();
            $team = new TeamModel();
            $paid = new PaidModel();
			$cartaux = new CartModel();
            $product = new ProductModel();
            $registry = new RegistryModel();
            $pcat = new ProductcategoryModel();
			
			$regitens = $registry->getreguser($this->session->userdata('userid'), $productid);
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
            $product = $product->search($productid);
			$teams = $team->listinguser($this->session->userdata('userid'));
					
            $content = array("product" => $product, "teams" => $teams, "regitens" => $regitens);
            
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/product', $content);
        }else{
            redirect(base_url('login'));
        }
    }
	
	public function detalhe($spinid) {
        if ($this->isUser()){
            $this->load->model('RegistryModel');
            $this->load->model('ProductModel');
			$this->load->model('SpinModel');
			$this->load->model('PaidModel');
            $registry = new RegistryModel();
            $product = new ProductModel();
            $spin = new SpinModel();
            $paid = new PaidModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
						
			$reglisting = $registry->listing($spinid);
			$spindata = $spin->search($spinid);
			$paiddata = $paid->searchproduct($spinid);
			$productdata = $product->getproduct($spinid);
			$balance = $registry->balance($spinid);
			
			$itens = $spindata['numteams'];
			
			if(($itens % 20) == 0) {
				$mult = true;
			} else {
				$mult = false;
			}
			
			$content = array(
				"teams" => $reglisting, 
				"spin" => $spinid,  
				"balance" => $balance, 
				"product" => $productdata, 
				"spindata" => $spindata,
				"paiddata" => $paiddata, 
				"page" => 0, 
				"itens" => $itens, 
				"mult" => $mult);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/spindetail', $content);
			
        }else{
            redirect(base_url('login'));
        }		
    }
    
    public function pagina($parameter) {
        if ($this->isUser()){
            $this->load->model('RegistryModel');
			$this->load->model('SpinModel');
			$this->load->model('PaidModel');
            $registry = new RegistryModel();
            $spin = new SpinModel();
            $paid = new PaidModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$exp = explode("-", $parameter);
			$spinid = $exp[0];
			$paged = $exp[1];
						
			$reglisting = $registry->mypaged($spinid, $paged);
			$spindata = $spin->search($spinid);
			$paiddata = $paid->searchproduct($spinid);
			$balance = $registry->balance($spinid);
			
			$itens = $spindata['numteams'];
			
			if(($itens % 20) == 0) {
				$mult = true;
			} else {
				$mult = false;
			}
			
			$content = array(
				"teams" => $reglisting, 
				"spin" => $spinid,  
				"balance" => $balance, 
				"spindata" => $spindata,
				"paiddata" => $paiddata, 
				"page" => $paged, 
				"itens" => $itens, 
				"mult" => $mult);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/spindetail', $content);
			
        }else{
            redirect(base_url('login'));
        }		
    }
	
	public function pesquisar() {
        if ($this->isUser()){
            $this->load->model('RegistryModel');
			$this->load->model('SpinModel');
			$this->load->model('PaidModel');
            $registry = new RegistryModel();
            $spin = new SpinModel();
            $paid = new PaidModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$searchlabel = $this->input->post("searchlabel");
			$spinid = $this->input->post("spin");
						
			$reglisting = $registry->spin($searchlabel, $spinid);
			$spindata = $spin->search($spinid);
			$paiddata = $paid->searchproduct($spinid);
			$balance = $registry->balance($spinid);
			
			$content = array(
				"teams" => $reglisting, 
				"spin" => $spinid,  
				"balance" => $balance, 
				"spindata" => $spindata,
				"paiddata" => $paiddata);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/spindetail', $content);
			
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
			"pageid" => 2,
			"notifications" => $notifications,
			"countnotify" => count($countnotify),
			"countcart" => count($cartitens),
			"userlogged" => $userlogged
		);
    }
}