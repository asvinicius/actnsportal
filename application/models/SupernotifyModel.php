<?php
class SupernotifyModel extends CI_Model{
	protected $sn_id;
    protected $sn_super;
    protected $sn_date;
    protected $sn_description;
    protected $sn_link;
    protected $sn_status;
    
    function __construct() {
        parent::__construct();
        $this->setSn_id(null);
        $this->setSn_super(null);
        $this->setSn_date(null);
        $this->setSn_description(null);
        $this->setSn_link(null);
        $this->setSn_status(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('supernotify', $data)) {
                return true;
            }
        }
    }
	
    public function listsuper($superid) {
		$this->db->where("sn_super", $superid);
		$this->db->where("sn_status", 1);
        $this->db->order_by("sn_date", "asc");
        return $this->db->get("supernotify")->result();
    }
	
    public function countlistuser($superid) {
		$this->db->where("sn_super", $superid);
        $this->db->order_by("sn_date", "asc");
        return $this->db->get("supernotify")->result();
    }
	
	function getSn_id() {
        return $this->Sn_id;
    }
	
	function getSn_super() {
        return $this->sn_super;
    }
	
	function getSn_date() {
        return $this->sn_date;
    }
	
	function getSn_description() {
        return $this->sn_description;
    }
	
	function getSn_link() {
        return $this->sn_link;
    }
	
	function getSn_status() {
        return $this->sn_status;
    }
	
	function setSn_id($sn_id) {
		$this->sn_id= $sn_id;
    }
	
	function setSn_super($sn_super) {
		$this->sn_super = $sn_super;
    }
	
	function setSn_date($sn_date) {
		$this->sn_date = $sn_date;
    }
	
	function setSn_description($sn_description) {
		$this->sn_description = $sn_description;
    }
	
	function setSn_link($sn_link) {
		$this->sn_link = $sn_link;
    }
	
	function setSn_status($sn_status) {
		$this->sn_status = $sn_status;
    }
}