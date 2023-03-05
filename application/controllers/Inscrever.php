<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inscrever extends CI_Controller {

    public function processar() {
        if ($this->isLogged()){
            $this->load->model('ProductModel');
            $this->load->model('ProductcategoryModel');
            $this->load->model('RegistryModel');
			$this->load->model('CartModel');
			$this->load->model('UserModel');
            $product = new ProductModel();
            $pcat = new ProductcategoryModel();
            $registry = new RegistryModel();
			$cartaux = new CartModel();
			$user = new UserModel();
			
			$productid = $this->input->post("productid");
			$teamcheck = $this->input->post("teamcheck");
			$postaction = $this->input->post("postaction");
			
			if($teamcheck){
				foreach($teamcheck as $tc){
					$regaux = $registry->getreg($tc, $productid);
					$cartrestrict = $cartaux->getrestrict($productid, $tc);
					if($regaux){
						
					} else {
						if($cartrestrict){
							
						} else {
							$cartdata['cartid'] = null;
							$cartdata['cartuser'] = $this->session->userdata('userid');
							$cartdata['cartproduct'] = $productid;
							$cartdata['cartteam'] = $tc;
							$cartdata['cartcreationdate'] = date('Y-m-d H:i:s');
							
							if($cartaux->save($cartdata)){
								
							}
						}
					}
					
					
					
				}
			}
			
			if($postaction == 1){
				redirect(base_url('checkout'));
			} else {
				redirect(base_url('ligas'));
			}
			return true;
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