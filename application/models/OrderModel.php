<?php
class OrderModel extends CI_Model{
    
    protected $orderid;
    protected $orderuser;
    protected $orderprice;
    protected $orderattachment;
    protected $orderdate;
    protected $orderstatus;
    
    function __construct() {
        parent::__construct();
		
            $this->setOrderid(null);
            $this->setOrderuser(null);
            $this->setOrderprice(null);
            $this->setOrderattachment(null);
            $this->setOrderdate(null);
            $this->setOrderstatus(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('order', $data)) {
                return true;
            }
        }
    }
	
    public function search($orderid) {
        if ($orderid != null) {
            $this->db->where("orderid", $orderid);
			$this->db->join('user', 'userid=orderuser', 'inner');
			return $this->db->get("order")->row_array();
        }
    }
	
	public function lastinsert() {
        return $this->search($this->db->insert_id("order"));
    }
    
    function getOrderid() {
        return $this->orderid;
    }

    function getOrderuser() {
        return $this->orderuser;
    }

    function getOrderprice() {
        return $this->orderprice;
    }

    function getOrderattachment() {
        return $this->orderattachment;
    }

    function getOrderdate() {
        return $this->orderdate;
    }

    function getOrderstatus() {
        return $this->orderstatus;
    }

    function setOrderid($orderid) {
        $this->orderid = $orderid;
    }

    function setOrderuser($orderuser) {
        $this->orderuser = $orderuser;
    }

    function setOrderprice($orderprice) {
        $this->orderprice = $orderprice;
    }

    function setOrderattachment($orderattachment) {
        $this->orderattachment = $orderattachment;
    }

    function setOrderdate($orderdate) {
        $this->orderdate = $orderdate;
    }

    function setOrderstatus($orderstatus) {
        $this->orderstatus = $orderstatus;
    }


}