<?php

class Model_user extends CI_Model {

	private $primary_key 	= null;
	private $primary_keys 	= array();
	private $table_name 	= 'rep_users';
	private $table_relation = 'rep_usermeta';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_table','table');
		$this->load->model('model_options','options');
	}

	public function get_user_table()
	{
		return $this->table_name;
	}

	// user: get all user
	public function get_all_users()
	{
		if($this->table_name == null)
		{
			return false;
		}

		$this->table->set_table($this->table_name);
		$get_data = $this->table->get_list('array');
		if($get_data)
		{
			$result = array();
			foreach($get_data as $num => $val)
			{
				$ID = $val['user_ID'];
				$meta = $this->user->get_usermeta($ID);
				if($meta)
				{
					$val = (array)$val;
					$result[$num] = (array)(array_merge($val,$meta));
				}
			}
			return $result;
		}
		else
		{
			return false;
		}
	}

	// user: get user by atribut
	public function get_users_by_attr($post_array, $callback = 'list', $type = 'array')
	{
		if($this->table_name == null)
		{
			return false;
		}

		$this->table->set_table($this->table_name);
		$this->table->tb_order('user_nicename', 'asc');
		$this->table->tb_where($post_array);

		if($callback == 'list')
		{
			$get_data = $this->table->get_list($type);
			if($get_data)
			{
				$result = array();
				foreach($get_data as $num => $val)
				{
					switch($type)
					{
						case 'array':
							$ID = $val['user_ID'];
							$meta = $this->user->get_usermeta($ID);
							$val = (array)$val;
							$result[$num] = (array)(array_merge($val, $meta));
						break;
						case 'object':
							$ID = $val->user_ID;
							$meta = $this->user->get_usermeta($ID);
							$val = (array)$val;
							$result[$num] = (object)(array_merge($val, $meta));
						break;
					}
					return $result;
				}
			}
			else
			{
				return false;
			}
		}
		else if($callback == 'row')
		{
			$get_data = $this->table->get_row($type);
			if($get_data)
			{
				switch($type)
				{
					case 'array':
						$ID = $get_data['user_ID'];
						$meta = $this->user->get_usermeta($ID);
						$val = (array)$get_data;
						$result = (array)(array_merge($val, $meta));
					break;
					case 'object':
						$ID = $get_data->user_ID;
						$meta = $this->user->get_usermeta($ID);
						$val = (array)$get_data;
						$result = (object)(array_merge($val, $meta));
					break;
				}
				return $result;
			}
			else
			{
				return false;
			}
		}
	}

	public function get_users_by_active_generation()
	{
		$result = array();
		$ac = $this->options->get_options_by_key('active_generation');
		$ac = $ac['option_value'];

		// imamsrifkan: get user by active generation
		$get_user_meta = $this->user->get_user_meta_by_attr(array('meta_key' => 'generation', 'meta_value' => $ac), 'list');
		if($get_user_meta)
		{
			foreach($get_user_meta as $key => $val)
			{
				$get_user = $this->user->get_users_by_attr(array('user_ID' => $val['user_ID']), 'row');
				$result[] = $get_user;
			}
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function get_usermeta($ID, $field = '')
	{
		$temp_array = array();

		$post_array = array(
			$this->table->get_primary_key($this->table_name) => $ID
			);

		$this->table->set_table($this->table_relation);
		$this->table->tb_where($post_array);
		$get_data = $this->table->get_list();
		if(!empty($get_data))
		{
			foreach($get_data as $result)
			{
				$temp_array[$result['meta_key']] = $result['meta_value'];
			}

			if(!empty($field))
			{
				return $temp_array[$field];
			}
			else
			{
				return $temp_array;
			}
		}
		else
		{
			return false;
		}
	}

	public function get_user_meta_by_attr($post_array, $callback = 'row', $type = 'array')
	{
		$this->table->set_table($this->table_relation);
		$this->table->tb_where($post_array);

		if($callback == 'row')
		{
			return $this->table->get_row($type);
		}
		else if($callback == 'list')
		{
			return $this->table->get_list($type);
		}
	}

	// user: insert user
	public function insert_user($post_array)
	{
		$this->table->set_table($this->table_name);
		
		$insert = $this->table->tb_insert($post_array['member']);

		if($insert)
		{
			if($post_array['meta_member'])
			{
				foreach($post_array['meta_member'] as $num => $val)
				{
					$this->insert_user_meta(array('user_ID' => $insert, 'meta_key' => $num, 'meta_value' => $val));
				}
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	// user: update user
	public function update_user($pk_value, $post_array)
	{
		$this->table->set_table($this->table_name);
		$update = $this->table->tb_update($pk_value, $post_array['member']);
		if($update)
		{
			foreach($post_array['meta_member'] as $num => $val)
			{
				$this->update_user_meta($pk_value, array('meta_key' => $num, 'meta_value' => $val));
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	// user: delete user
	public function delete_user($ID)
	{
		$this->table->set_table($this->table_name);
		$delete = $this->table->tb_delete($ID);
		if($delete)
		{
			$this->delete_user_meta($ID);
			return true;
		}
		else
		{
			return false;
		}
	}

	// user: insert user meta
	private function insert_user_meta($post_array)
	{
		$this->table->set_table($this->table_relation);
		
		return $insert = $this->table->tb_insert($post_array);
	}

	// user: update user meta
	public function update_user_meta($pk_value, $post_array)
	{
		$this->table->set_table($this->table_relation);

		$array = array(
			'user_ID' => $pk_value,
			'meta_key' => $post_array['meta_key']
			);
		$meta = $this->get_user_meta_by_attr($array, 'row');
		if($meta)
		{
			return $this->table->tb_update($meta['meta_ID'], $post_array);
		}
		else
		{
			$array = array(
				'user_ID' => $pk_value,
				'meta_key' => $post_array['meta_key'],
				'meta_value' => $post_array['meta_value']
				);
			return $this->insert_user_meta($array);
		}
	}

	private function delete_user_meta($ID)
	{
		$this->table->set_table($this->table_relation);
		$this->table->set_primary_key('user_ID');
		return $this->table->tb_delete($ID);
	}

	public function reset_user_password($ID, $pwd)
	{
		$this->table->set_table($this->table_name);
		return $this->table->tb_update($ID, array('user_pass' => md5($pwd)));
	}
}

/*End of file model_user.php*/
/*Location: ./application/models/model_user.php*/