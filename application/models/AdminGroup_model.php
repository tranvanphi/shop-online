<?php
Class AdminGroup_model extends MY_Model
{
	var $table = 'admin_group';


	//get list 
    public function getList($perpage = null,$ofset = null)
    {
        if($perpage != null && $ofset != null)
        {
            $query = $this->db->query("select * from ".$this->table." LIMIT $ofset,$perpage");
        }else{
            $query = $this->db->query("select * from ".$this->table);
        }        
        return $query->result();
    }
}
