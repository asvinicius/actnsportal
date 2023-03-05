<?php
class UCModel extends CI_Model{
    
    protected $uc_id;
    protected $uc_portal;
    protected $uc_ger;
    protected $uc_status;
    
    function __construct() {
        parent::__construct();
        $this->setUc_id(null);
        $this->setUc_portal(null);
        $this->setUc_ger(null);
        $this->setUc_status(null);
    }
    
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("uc_id", $data['uc_id']);
            if ($this->db->update('updatecheck', $data)) {
                return true;
            }
        }
    }
    
    public function search($uc_id) {
        $this->db->where("uc_id", $uc_id);
        return $this->db->get("updatecheck")->row_array();
    }
    
    function getUc_id() {
        return $this->uc_id;
    }
    
    function getUc_portal() {
        return $this->uc_portal;
    }
    
    function getUc_ger() {
        return $this->uc_ger;
    }
    
    function getUc_status() {
        return $this->uc_status;
    }

    function setUc_id($uc_id) {
        $this->uc_id = $uc_id;
    }

    function setUc_portal($uc_portal) {
        $this->uc_portal = $uc_portal;
    }

    function setUc_ger($uc_ger) {
        $this->uc_ger = $uc_ger;
    }

    function setUc_status($uc_status) {
        $this->uc_status = $uc_status;
    }

}