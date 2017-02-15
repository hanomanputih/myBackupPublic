<?php

class Model_options extends CI_Model {

	private $table_name = 'rep_options';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_table','table');
	}

	public function get_all_options()
	{
		$this->table->set_table($this->table_name);
		return $this->table->get_list();
	}

	public function get_options_by_key($key)
	{
		$this->table->set_table($this->table_name);
		$this->table->tb_where(array('option_key' => $key));
		return $this->table->get_row();
	}

	public function update_options($key, $value)
	{
		$post_array = array('option_key' => $key);

		$this->table->set_table($this->table_name);
		$this->table->tb_where($post_array);
		$get_data = $this->table->get_row();
		if($get_data)
		{
			 return $this->table->tb_update($get_data['option_ID'], array('option_value' => $value));
		}
		else
		{
			$post_array = array(
				'option_key' => $key,
				'option_value' => $value
				);

			return $this->table->tb_insert($post_array);
		}
	}

}