<?php
Class Slide_model extends CI_Model
{
	var $table = 'slide';

	function __construct()
    {
        parent::__construct();
    }

	//get list 
    public function getList()
    {
        $query = $this->db->query("select * from ".$this->table);
        return $query->result();
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
}