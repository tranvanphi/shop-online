<?php
Class Transaction_model extends CI_Model
{
	var $table = 'transaction';

	function __construct()
    {
        parent::__construct();
    }

    //function add 
    public function addTransaction($data)
    {
        return $this->db->insert($this->table, $data);
    }

    //function update
    public function updateTransaction($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table,$data);
    }


    function getTransactionlist($limit, $start)
    {
        $sql = "select * from ".$this->table." order by ".$this->table.".id desc limit " . $start . ", " . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }

    function infoTransaction($id)
    {
        $sql = "select t.`id` as idTransaction,t.`amount` as amount,t.`user_name` as name,t.`status`,t.`user_email` as email,t.`user_phone` as phone,t.`message` as message from `transaction` as t where t.`id` =".$id;
        $query = $this->db->query($sql);
        return $query->result();
    }


    public function delete($id)
    {       
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }


    function getTransactioncount($st = NULL)
    {
        $str = '';
        if($st != null)
        {
            $str = "select * from ".$this->table." where ".$this->table.".user_name like '%$st%' or ".$this->table.".user_email like '%$st%' or ".$this->table.".user_phone like '%$st%' or ".$this->table.".id like '%$st%'";
        }else{
            $str = "select * from ".$this->table."";
        }
        $query = $this->db->query($str);
        return $query->num_rows();
    }

    function getTransactionSearch($limit,$start,$st = NULL)
    {
        $str = '';
        if($st != null)
        {
            $str = "select * from ".$this->table." where ".$this->table.".user_name like '%$st%' or ".$this->table.".user_email like '%$st%' or ".$this->table.".user_phone like '%$st%' or ".$this->table.".id like '%$st%'";
        }else{
            $str = "select * from ".$this->table."";
        }
        $str .= " LIMIT $start,$limit";
        $query = $this->db->query($str);      
        return $query->result();
    }
    public function getwhere_transaction($id)
    {
        $query = "SELECT t.`id`,t.`created`,o.`amount`,p.`name`,t.`status` FROM `transaction` as t, `order` as o ,`product` as p where t.`id` = o.`transaction_id` and o.`product_id` = p.`id` and t.`user_id` = ".$id;
        $query = $this->db->query($query);      
        return $query->result();
    }
}