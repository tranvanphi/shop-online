<?php
Class News_model extends CI_Model
{
	var $table = 'news';

	function __construct()
    {
        parent::__construct();
    }


    //get list 
    public function getNewslist($limit,$start,$st = NULL)
    {
        $str = '';
        if($st != NULL)
        {
            $str = "select * from ".$this->table." where ".$this->table.".title like '%$st%' or ".$this->table.".content like '%$st%' or ".$this->table.".intro like '%$st%'";
        }else{
            $str = "select * from ".$this->table."";
        }
        $str .= " LIMIT $start,$limit";
        $query = $this->db->query($str);      
        return $query->result();
    }

    function getNewscount($st = NULL)
    {
        $str = '';
        if($st != NULL)
        {
            $str = "select * from ".$this->table." where ".$this->table.".title like '%$st%' or ".$this->table.".content like '%$st%' or ".$this->table.".intro like '%$st%'";
        }else{
            $str = "select * from ".$this->table."";
        }
        $query = $this->db->query($str);
        return $query->num_rows();
    }

    //function add admin
    public function addNews($data)
    {
        return $this->db->insert($this->table, $data);
    }

    //get info user
    public function infoNews($id)
    {
        $query = $this->db->get_where($this->table,array('id' => $id));
        if($query->num_rows()){
            return $query->row();
        }    
    }

    //function update id
    public function updateNews($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table,$data);
    }

}