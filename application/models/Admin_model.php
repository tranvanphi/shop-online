<?php
Class Admin_model extends CI_Model
{
	var $table = 'admin';

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
    public function getList($perpage = null,$ofset = null)
    {
        if($perpage != null && $ofset != null)
        {
            $query = $this->db->query("select a.id,a.username,a.password,a.name as name,b.name as name_group,b.permissions from ".$this->table." as a,admin_group as b where b.id = a.admin_group_id LIMIT $ofset,$perpage");
        }else{
            $query = $this->db->query("select a.id,a.username,a.password,a.name as name,b.name as name_group,b.permissions from ".$this->table." as a,admin_group as b where b.id = a.admin_group_id");
        }
        
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

    //get info admin
    public function infoAdmin($id)
    {
        $query = $this->db->get_where($this->table,array('id' => $id));
        if($query->num_rows()){
            return $query->row();
        }    
    }


    //function update id
    public function updateAdmin($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table,$data);
    }

    //function add admin
    public function addAdmin($data)
    {
        return $this->db->insert($this->table, $data);
    }

    //function delete admin
    public function deleteAdmin($id)
    {
        $this->db->where('id' ,$id);
        return $this->db->delete($this->table);
    }
}
