<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Novotime extends CI_Controller {

    public function index() {
        if ($this->isUser()){
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/addteam');
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function pesquisar() {
        if ($this->isUser()){
			$getinfo = $this->getInfo();
			$info = array("info" => $getinfo);
			
            $searchlabel = $this->input->post("searchlabel");
            $newlabel = preg_replace('/[ -]+/' , '%20' , $searchlabel);
            
            $json = $this->searchteams($newlabel);
            
            $content = array("teams" => $json);
            
			$this->load->view('template/user/headermenu', $info);
			$this->load->view('user/addteam', $content);
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function searchteams($team=null) {
        
        $url = 'https://api.cartola.globo.com/times?q='.$team;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die(curl_error($ch));
        }
        
        curl_close($ch);
        
        $json = json_decode($result, true);
        
        return $json;
    }

    public function escolher($teamid = null) {
        if ($this->isUser()){			
			
            $this->load->model('TeamModel');
            $team = new TeamModel();
            
            $json = $this->select($teamid);
            $selected = $json['time'];
            
            $teamdata['teamid'] = $selected['time_id'];
            $teamdata['teamuser'] = $this->session->userdata('userid');
            $teamdata['teamname'] = $selected['nome'];
            $teamdata['teamcoach'] = $selected['nome_cartola'];
            $teamdata['teamslug'] = $selected['slug'];
            $teamdata['teamshield'] = $selected['url_escudo_svg'];
            $teamdata['teamstatus'] = 1;
            
            $restriction = $team->search($teamdata['teamid']);
            
            if($restriction == null){
                if($team->save($teamdata)){
					redirect(base_url('times/sucesso'));
                }
            } else {
				if($restriction['teamuser']){
					if($restriction['teamstatus'] == 0){
						if($team->update($teamdata)){
							redirect(base_url('times/atualizado'));
						}
					} else {
						redirect(base_url('times/erro'));
					}
				} else {
					if($team->update($teamdata)){
						redirect(base_url('times/sucesso'));
					}
				}
            }
			
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function select($teamid=null) {
        
        $url = 'https://api.cartola.globo.com/time/id/'.$teamid;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die(curl_error($ch));
        }
        
        curl_close($ch);
        
        $json = json_decode($result, true);
        
        return $json;
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
