<?php
class OrdersuperModel extends CI_Model{
    
    protected $os_id;
    protected $os_order;
    protected $os_super;
    
    function __construct() {
        parent::__construct();
		
            $this->setOs_id(null);
            $this->setOs_order(null);
            $this->setOs_super(null);
    }
	
	public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('ordersuper', $data)) {
                return true;
            }
        }
    }
	
    public function listsuper($superid) {
		$this->db->where("os_super", $superid);
		$this->db->join('order', 'orderid=os_order', 'inner');
        $this->db->order_by("os_id", "asc");
        return $this->db->get("ordersuper")->result();
    }
    
    function getOs_id() {
        return $this->os_id;
    }

    function getOs_order() {
        return $this->os_order;
    }

    function getOs_super() {
        return $this->os_super;
    }

    function setOs_id($os_id) {
        $this->os_id = $os_id;
    }

    function setOs_order($os_order) {
        $this->os_order = $os_order;
    }

    function setOs_super($os_super) {
        $this->os_super = $os_super;
    }

}