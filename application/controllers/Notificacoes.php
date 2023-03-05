<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacoes extends CI_Controller {

    public function index() {
        if ($this->isUser()){
			
        } else {
            $this->load->view('public/login');
        }
    }
	public function id($un_id) {
        if ($this->isUser()){
			$this->load->model('UsernotifyModel');
            $un = new UsernotifyModel();
			
			$undata = $un->search($un_id);
			
			$undata['un_status'] = 0;
			
			if($un->update($undata)){
				redirect(base_url(''.$undata['un_link']));
			}
			
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