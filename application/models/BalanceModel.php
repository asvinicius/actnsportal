<?php
class BalanceModel extends CI_Model{
    
    protected $balanceid;
    protected $balancesuper;
    protected $balancepend;
    protected $balanceconf;
    protected $balancetotal;
    protected $balancestatus;
    
    function __construct() {
        parent::__construct();
            
        $this->setBalanceid(null);
        $this->setBalancesuper(null);
        $this->setBalancepend(null);
        $this->setBalanceconf(null);
        $this->setBalancetotal(null);
        $this->setBalancestatus(null);
    }
	
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("balanceid", $data['balanceid']);
            if ($this->db->update('balance', $data)) {
                return true;
            }
        }
    }
	
    public function listing() {
        $this->db->select('*');
		$this->db->join('super', 'balancesuper=superid', 'inner');
        $this->db->order_by("balanceid", "asc");
        return $this->db->get("balance")->result();
    }
	
    public function maxtotal() {
        $this->db->select('*');
		$this->db->join('super', 'balancesuper=superid', 'inner');
        $this->db->order_by("balancetotal", "desc");
        $this->db->order_by("balanceid", "asc");
        return $this->db->get("balance", 1, 0)->result();
    }
	
    public function mintotal() {
        $this->db->where("balancestatus", 1);
		$this->db->join('super', 'balancesuper=superid', 'inner');
        $this->db->order_by("balancetotal", "asc");
        $this->db->order_by("balanceid", "asc");
        return $this->db->get("balance", 1, 0)->result();
    }
	
    public function maxconf() {
        $this->db->select('*');
		$this->db->join('super', 'balancesuper=superid', 'inner');
        $this->db->order_by("balanceconf", "desc");
        $this->db->order_by("balanceid", "asc");
        return $this->db->get("balance", 1, 0)->result();
    }
	
    public function minconf() {
        $this->db->select('*');
		$this->db->join('super', 'balancesuper=superid', 'inner');
        $this->db->order_by("balanceconf", "asc");
        $this->db->order_by("balanceid", "asc");
        return $this->db->get("balance", 1, 0)->result();
    }
    
    public function search($balanceid) {
        if ($balanceid != null) {
            $this->db->where("balanceid", $balanceid);
		    $this->db->join('super', 'balancesuper=superid', 'inner');
			return $this->db->get("balance")->row_array();
        }
    }
    
    public function searchsuper($balancesuper) {
        if ($balancesuper != null) {
            $this->db->where("balancesuper", $balancesuper);
		    $this->db->join('super', 'balancesuper=superid', 'inner');
			return $this->db->get("balance")->row_array();
        }
    }

    function getBalanceid() {
        return $this->balanceid;
    }

    function getBalancesuper() {
        return $this->balancesuper;
    }

    function getBalancepend() {
        return $this->balancepend;
    }

    function getBalanceconf() {
        return $this->balanceconf;
    }

    function getBalancetotal() {
        return $this->balancetotal;
    }

    function getBalancestatus() {
        return $this->balancestatus;
    }

    function setBalanceid($balanceid) {
        $this->balanceid = $balanceid;
    }
    
    function setBalancesuper($balancesuper) {
        $this->balancesuper = $balancesuper;
    }
    
    function setBalancepend($balancepend) {
        $this->balancepend = $balancepend;
    }
    
    function setBalanceconf($balanceconf) {
        $this->balanceconf = $balanceconf;
    }
    
    function setBalancetotal($balancetotal) {
        $this->balancetotal = $balancetotal;
    }
    
    function setBalancestatus($balancestatus) {
        $this->balancestatus = $balancestatus;
    }

}