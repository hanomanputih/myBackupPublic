<?php

class Model_presence extends CI_Model {

	private $table_name = 'rep_presence';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_table','table');
	}

	public function get_all_presence($type = 'array')
	{
		$this->table->set_table($this->table_name);
		$this->table->tb_order('user_ID','asc');

		return $this->table->get_list($type);
	}

	// presence: get record data from table
	public function get_presence_by_attr($post_array, $callback = 'list', $type = 'array')
	{
		$this->table->set_table($this->table_name);
		$this->table->tb_order('presence_date','desc');
		$this->table->tb_where($post_array);

		if($callback == 'list')
		{
			return $this->table->get_list($type);
		}
		else if($callback == 'row')
		{
			return $this->table->get_row($type);
		}
	}

	// presence: insert data to table
	public function insert_presence($post_array)
	{
		$this->table->set_table($this->table_name);

		 return $this->table->tb_insert($post_array);
	}

	public function delete_presence($ID)
	{
		$this->table->set_table($this->table_name);

		return $this->table->tb_delete($ID);

	}

	public function delete_all_presence($user_ID)
	{
		$this->table->set_table($this->table_name);
		$this->table->set_primary_key('user_ID');

		return $this->table->tb_delete($user_ID);
	}

	// imamsrifkan: count presences
	public function count_presence($post_array = '')
	{
		$this->table->set_table($this->table_name);

		if(!empty($post_array))
		{
			$this->table->tb_where($post_array);
		}

		return $this->table->get_num_rows();
	}
}