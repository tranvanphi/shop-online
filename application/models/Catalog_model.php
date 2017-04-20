<?php
Class Catalog_model extends CI_Model
{
	var $table = 'catalog';
    
	function __construct()
    {
        parent::__construct();
    }

    //fetch list
    function getCataloglist($limit, $start, $st = NULL)
    {
        if ($st == "NIL") $st = "";
        $sql = "SELECT c1.id, c1.parent_id, c1.name, c1.sort_order, c2.name as `parent_name` FROM catalog c1 left outer join catalog c2 on c1.parent_id = c2.id and c1.name like '%$st%' limit " . $start . ", " . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }


    //get list catalog
    function infoCatalog($where)
    {
        $query = $this->db->get_where($this->table,$where);
        return $query->result();
    }

    //function check exist item in database
    function checkExist($where)
    { 
        $this->db->where($where);
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0)
        {
            return true;
        }
        return false;   
    }

    //function update id
    public function updateCatalog($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table,$data);
    }

    public function getListCatalogWhere($array)
    {
        $this->db->select('id');
        $this->db->where($array);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    //function add catalog
    public function addCatalog($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function delete($id)
    {       
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    
}

