<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ligas extends CI_Controller {
	
    public function index() {
        if ($this->isLogged()){
			$this->load->model('UserModel');
            $this->load->model('TeamModel');
            $this->load->model('ProductModel');
            $this->load->model('ProductcategoryModel');
            $this->load->model('RegistryModel');
			
			$user = new UserModel();
            $team = new TeamModel();
            $product = new ProductModel();
            $pcat = new ProductcategoryModel();
            $registry = new RegistryModel();
			
            $getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$categories = $pcat->listactive();
			$highlights = $product->listhigh();
			
            $content = array("highlights" => $highlights, "categories" => $categories);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/leagues', $content);
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