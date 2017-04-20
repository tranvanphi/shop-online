<?php
Class Product_model extends MY_Model
{
	var $table = 'product';

	function __construct()
    {
        parent::__construct();
    }

	//fetch product
    function getProductlist($limit, $start, $st = NULL)
    {
        if ($st == "NIL") $st = "";
        $sql = "select * from ".$this->table." order by ".$this->table.".id desc limit " . $start . ", " . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }


    //function count list product
    function getCountproductsearch($st)
    {
        if(is_numeric($st[1]) && $st[0] != 'NIL')
        {
            $sql = "select * from ".$this->table." where name like '%$st[0]%' and catalog_id = '$st[1]'";
        }else{
            $sql = "select * from ".$this->table." where name like '%$st[0]%' or catalog_id = '$st[1]'";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

     //function count list product search in site
    function getProductCount($st)
    {
        if($st[0] != 'NIL')
        {
            $sql = "select * from ".$this->table." where name like '%$st%'";
        }else{
            $sql = "select * from ".$this->table;
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    //function get list product after search in site
    function getProductSearch($limit, $start, $st)
    { 
        if($st != 'NIL')
        {
            $sql = "select * from ".$this->table." where name like '%$st%' limit " . $start . ", " . $limit;
        }else{
            $sql = "select * from ".$this->table." limit " . $start . ", " . $limit;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }


    //function get list product after search
    function get_product_search($limit, $start, $st)
    { 
        if(is_numeric($st[1]) && $st[0] != 'NIL')
        {
            $sql = "select * from ".$this->table." where name like '%$st[0]%' and catalog_id = '$st[1]'limit " . $start . ", " . $limit;
        }else{
            $sql = "select * from ".$this->table." where name like '%$st[0]%' or catalog_id = '$st[1]' limit " . $start . ", " . $limit;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function updateProduct($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table,$data);
    }


    //function check exist item in database
    public function checkExist($where)
    { 
        $this->db->where($where);
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0)
        {
            return true;
        }
        return false;   
    }

    public function addProduct($data)
    {
        return $this->db->insert($this->table, $data);
    }

    function infoProduct($where)
    {
        $query = $this->db->get_where($this->table,$where);
        return $query->result();
    }

    public function delete($id)
    {       
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }


    //count list get where
    public function getCountWhere($id)
    {
        $this->db->where_in('catalog_id', $id);
        $num_rows = $this->db->count_all_results($this->table);
        return $num_rows;   
    }


    //get list product where catalog_id
    function getProductListWhere($limit, $start, $id)
    {
  
        $this->db->where_in('catalog_id', $id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->table,$limit,$start);
        return $query->result();
    }

    function ProductSearch($where)
    {
        $query = $this->db->get_where($this->table, $where, 5, 0);
        return $query->result(); 
    }
}
