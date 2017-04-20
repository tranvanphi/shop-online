<?php
Class Order_model extends CI_Model
{
	var $table = 'order';

	function __construct()
    {
        parent::__construct();
    }

    //function add admin
    public function addOrder($data)
    {
        return $this->db->insert($this->table, $data);
    }

    //function add admin
    public function infoOrder($id)
    {
        $sql = "select o.`transaction_id` as idTransaction,o.`amount` as amount,o.`qty`,p.`name` from `product` as p, `order` as o where p.`id`=o.`product_id` and o.`transaction_id` =".$id;
        $query = $this->db->query($sql);
        return $query->result();
    }
}