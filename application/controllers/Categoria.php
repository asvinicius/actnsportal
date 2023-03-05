<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function id($pcat_id = null) {
        if ($this->isLogged()){
			$this->load->model('UserModel');
            $this->load->model('TeamModel');
            $this->load->model('ProductModel');
            $this->load->model('ProductcategoryModel');
			
			$user = new UserModel();
            $team = new TeamModel();
            $product = new ProductModel();
            $pcat = new ProductcategoryModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$category = $pcat->search($pcat_id);
            $products = $product->listcategory($pcat_id);
			$pcount = count($product->getCountlc($pcat_id));
			
			if(($pcount % 10) == 0) {
				$mult = true;
			} else {
				$mult = false;
			}
		
            $content = array("products" => $products, "category" => $category, "page" => 0, "pcount" => $pcount, "mult" => $mult);
            
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/prodcategory', $content);
        }else{
            redirect(base_url('login'));
        }
    }
	
    public function bolao($paged = null) {
        if ($this->isLogged()){
			$this->load->model('UserModel');
            $this->load->model('TeamModel');
            $this->load->model('ProductModel');
            $this->load->model('ProductcategoryModel');
			
			$user = new UserModel();
            $team = new TeamModel();
            $product = new ProductModel();
            $pcat = new ProductcategoryModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$pcat_id = 2;
			
			$category = $pcat->search($pcat_id);
            $products = $product->pagedlc($pcat_id, $paged);
			$pcount = count($product->getCountlc($pcat_id));
			
			if(($pcount % 10) == 0) {
				$mult = true;
			} else {
				$mult = false;
			}
		
            $content = array("products" => $products, "category" => $category, "page" => $paged, "pcount" => $pcount, "mult" => $mult);
            
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/prodcategory', $content);
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