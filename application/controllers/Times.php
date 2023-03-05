<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Times extends CI_Controller {

    public function index() {
        if ($this->isUser()){
            $this->load->model('TeamModel');
            $team = new TeamModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$data = $team->listinguser($this->session->userdata('userid'));
			$content = array("teams" => $data);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/teams', $content);
			
        }else{
            redirect(base_url('login'));
        }		
    }
	
    public function sucesso() {
        if ($this->isUser()){
            $this->load->model('TeamModel');
            $team = new TeamModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$data = $team->listinguser($this->session->userdata('userid'));
			
			$alert = array(
				"class" => "success",
				"message" => "Time adicionado com sucesso!");
			
			$content = array("teams" => $data, "alert" => $alert);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/teams', $content);
			
        }else{
            redirect(base_url('login'));
        }	
    }
	
    public function atualizado() {
        if ($this->isUser()){
            $this->load->model('TeamModel');
            $team = new TeamModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$data = $team->listinguser($this->session->userdata('userid'));
			
			$alert = array(
				"class" => "primary",
				"message" => "O time selecionado ja faz parte do seu esquadrao!");
			
			$content = array("teams" => $data, "alert" => $alert);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/teams', $content);
			
        }else{
            redirect(base_url('login'));
        }	
    }
	
    public function erro() {
        if ($this->isUser()){
            $this->load->model('TeamModel');
            $team = new TeamModel();
			
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$data = $team->listinguser($this->session->userdata('userid'));
			
			$alert = array(
				"class" => "danger",
				"message" => "Sinto muito!<br>O time selecionado já faz parte de outro esquadrao.");
			
			$content = array("teams" => $data, "alert" => $alert);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/teams', $content);
			
        }else{
            redirect(base_url('login'));
        }	
    }

    public function delete($teamid = null) {
        if ($this->isUser()){
            $this->load->model('TeamModel');
			$this->load->model('CartModel');
            $team = new TeamModel();
			$cart = new CartModel();
            
            $teamaux = $team->search($teamid);
            
            $teamdata['teamid'] = $teamaux['teamid'];
            $teamdata['teamuser'] = $teamaux['teamuser'];
            $teamdata['teamname'] = $teamaux['teamname'];
            $teamdata['teamcoach'] = $teamaux['teamcoach'];
            $teamdata['teamslug'] = $teamaux['teamslug'];
            $teamdata['teamshield'] = $teamaux['teamshield'];
            $teamdata['teamstatus'] = 0;
            
            if($teamaux['teamuser'] == $this->session->userdata('userid')){
                if($team->update($teamdata)) {
                    
                    $cartaux = $cart->listremove($teamid); // Recebe todas as inferencias desse time no carrinho
                    
                    foreach($cartaux as $carrinho){
                        $cart->delete($carrinho->cartid);
                    }
                    
                    
                    $getinfo = $this->getInfo();
    				$info = array("info" => $getinfo);
    				
    				$data = $team->listinguser($this->session->userdata('userid'));
    				
    				$alert = array(
    					"class" => "primary",
    					"message" => "O time foi removido do seu esquadrao!");
    				
    				$content = array("teams" => $data, "alert" => $alert);
    				
    				$this->load->view('template/user/headermenu', $info);
    				$this->load->view('user/teams', $content);
                }
            } else {
                redirect(base_url('times'));
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
			"pageid" => 1,
			"notifications" => $notifications,
			"countnotify" => count($countnotify),
			"countcart" => count($cartitens),
			"userlogged" => $userlogged
		);
    }
}