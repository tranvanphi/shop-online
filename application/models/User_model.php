<?php
Class User_model extends MY_Model
{
	var $table = 'user';

	function __construct()
    {
        parent::__construct();
    }

    //function check exist item in database
    public function checkExist($where)
    {
        
        $this->db->where($where);
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0)
        {
            //have exist table
            return true;
        }
        return false;   
    }

    //get list 
    public function getUserlist($limit,$start,$st = NULL)
    {
        $str = '';
        if($st != NULL)
        {
            $str = "select * from ".$this->table." where ".$this->table.".name like '%$st%' or ".$this->table.".email like '%$st%' or ".$this->table.".phone like '%$st%' or ".$this->table.".address like '%$st%'";
        }else{
            $str = "select * from ".$this->table."";
        }
        $str .= " LIMIT $start,$limit";
        $query = $this->db->query($str);      
        return $query->result();
    }

    function getUsercount($st = NULL)
    {
        $str = '';
        if($st != null)
        {
            $str = "select * from ".$this->table." where ".$this->table.".name like '%$st%' or ".$this->table.".email like '%$st%' or ".$this->table.".phone like '%$st%' or ".$this->table.".address like '%$st%'";
        }else{
            $str = "select * from ".$this->table."";
        }
        $query = $this->db->query($str);
        return $query->num_rows();
    }

    //count list table
    public function countList()
    {
        $query = $this->db->query("select count(*) as total from ".$this->table);
        if($query)
        {
            $row = $query->row_array();
            return $row['total'];
        }
        return false;
    }

    //get info user
    public function infoUser($id)
    {
        $query = $this->db->get_where($this->table,array('id' => $id));
        if($query->num_rows()){
            return $query->row();
        }    
    }

    //get info user
    public function infoUserLogin($where)
    {
        $query = $this->db->get_where($this->table,$where);
        if($query->num_rows()){
            return $query->row();
        }    
    }


    //function update id
    public function updateUser($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table,$data);
    }

    //function add admin
    public function addUser($data)
    {
        return $this->db->insert($this->table, $data);
    }

    //function delete admin
    public function deleteUser($id)
    {
        $this->db->where('id' ,$id);
        return $this->db->delete($this->table);
    }
}