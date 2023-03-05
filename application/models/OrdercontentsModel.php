<?php
class OrdercontentsModel extends CI_Model{
    
    protected $oc_id;
    protected $oc_order;
    protected $oc_product;
    protected $oc_category;
    protected $oc_team;
    protected $oc_price;
    protected $oc_status;
    
    function __construct() {
        parent::__construct();
		
            $this->setOc_id(null);
            $this->setOc_order(null);
            $this->setOc_product(null);
            $this->setOc_category(null);
            $this->setOc_team(null);
            $this->setOc_price(null);
            $this->setOc_status(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('ordercontents', $data)) {
                return true;
            }
        }
    }
	
	public function ishindered($oc_product, $oc_team) {
        $this->db->where("oc_product", $oc_product);
        $this->db->where("oc_team", $oc_team);
        $this->db->where("oc_status", 1);
        return $this->db->get("ordercontents")->row_array();
    }
    
    function getOc_id() {
        return $this->oc_id;
    }

    function getOc_order() {
        return $this->oc_order;
    }

    function getOc_product() {
        return $this->oc_product;
    }

    function getOc_category() {
        return $this->oc_category;
    }

    function getOc_team() {
        return $this->oc_team;
    }

    function getOc_price() {
        return $this->oc_price;
    }

    function getOc_status() {
        return $this->oc_status;
    }

    function setOc_id($oc_id) {
        $this->oc_id = $oc_id;
    }

    function setOc_order($oc_order) {
        $this->oc_order = $oc_order;
    }

    function setOc_product($oc_product) {
        $this->oc_product = $oc_product;
    }

    function setOc_category($oc_category) {
        $this->oc_category = $oc_category;
    }

    function setOc_team($oc_team) {
        $this->oc_team = $oc_team;
    }

    function setOc_price($oc_price) {
        $this->oc_price = $oc_price;
    }

    function setOc_status($oc_status) {
        $this->oc_status = $oc_status;
    }


}