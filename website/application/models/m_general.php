<?php

class M_general extends CI_model{
    
    protected $table_name = null;
    protected $primary_keys = null;
    protected $primary_key = null;


    public function __construct() {
        parent::__construct();
    }
    
    public function set_primary_key($field_name, $table_name = null)
    {
    	$table_name = $table_name === null ? $this->table_name : $table_name;
    	
    	$this->primary_keys[$table_name] = $field_name;
    }
    
    
    
    public function set_table($tbname)
    {
        return $this->table_name = $tbname;
    }
    
    public function where($data)
    {
        $this->db->where($data);
    }
    
    public function like($data)
    {
        $this->db->like($data);
    }
    
    public function limit($data,$offset = '')
    {
        $this->db->limit($data,$offset);
    }
    
    public function get_list_array()
    {
        $get = $this->db->get($this->table_name);
        if($get->num_rows() > 0)
        {
            return $get->result_array();
        }
        else
        {
            return false;
        }
        
    }
    
    public function get_row_array()
    {
        $get = $this->db->get($this->table_name);
        if($get->num_rows() > 0)
        {
            return $get->row_array();
        }
        else
        {
            return false;
        }
    }
}