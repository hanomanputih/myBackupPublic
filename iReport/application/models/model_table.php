<?php
// imamsrifkan: model for handle all model table

class Model_table extends CI_Model {

	protected $primary_key 	= null;
	protected $table_name	= null;
	protected $primary_keys	= array();

	public function __construct()
	{
		parent::__construct();
	}

	// table: check existence of table
	function table_exists($table_name = null)
	{
		return $this->db->table_exists($table_name);
	}

	// table: set name of table
	function set_table($table_name = null)
	{
		if(!$this->table_exists($table_name))
		{
			return false;
		}
		$this->table_name = $table_name;
	}

	// table: get name of table
	function get_table()
	{
		return $this->table_name;
	}

	// table: get list data from table
	function get_list($type = 'array')
	{
		$get = $this->db->get($this->table_name);

		if($get->num_rows() > 0)
		{
			if($type == 'array')
			{
				return $get->result_array();
			}
			else if($type == 'object')
			{
				return $get->result();
			}
		}
		else
		{
			return false;
		}
	}

	// table: get row data from table
	function get_row($type = 'array')
	{
		$get = $this->db->get($this->table_name);

		if($get->num_rows() > 0)
		{
			if($type == 'array')
			{
				return $get->row_array();
			}
			else if($type == 'object')
			{
				return $get->row();
			}
		}
		else
		{
			return false;
		}
	}

	// table: get type of fields table
	function get_types_field_table()
	{
		if(!$this->table_exists($this->table_name))
		{
			return false;
		}

		$tf = array();
		$sc = $this->db->query("show columns from `{$this->table_name}`");
		foreach($sc->result() as $result)
		{
			$type = explode("(",$result->Type);
			$type_db = $type[0];

			if(isset($type[1]))
			{
				if(substr($type[1], -1) == ")")
				{
					$length = substr($type[1], 0, -1);
				}
				else
				{
					list($length) = explode(" ", $type[1]);
					$length = substr($length, 0, -1);

				}
			}
			else
			{
				$length = "";
			}

			$tf[$result->Field]['db_max_length'] = $length;
    		$tf[$result->Field]['db_type'] = $type_db;
    		$tf[$result->Field]['db_null'] = $result->Null == 'YES' ? true : false;
    		$tf[$result->Field]['db_extra'] = $result->Extra;
		}

		$results = $this->db->field_data($this->table_name);
		foreach($results as $num => $row)
		{
			$row = (array)$row;
			$results[$num] = (object)( array_merge($row, $tf[$row['name']]) );
		}
		return $results;
	}

	public function get_num_rows()
	{
		$get = $this->db->get($this->table_name);
		return $get->num_rows();
	}

	// table: get type field
	function get_types_field($table_name)
	{
		return $this->db->field_data($table_name);
	}

	// table: set primary key
	function set_primary_key($field_name, $table_name = null)
	{
		$table_name = $table_name === null ? $this->table_name : $table_name;

		$this->primary_keys[$table_name] = $field_name;
	}

	// table: get primary key
	function get_primary_key($table_name = null)
	{
		if($table_name != null)
		{
			if(isset($this->primary_keys[$table_name]))
			{
				return $this->primary_keys[$table_name];
			}

			$fields = $this->get_types_field($table_name);

			if($fields)
			{
				foreach($fields as $result)
				{
					if($result->primary_key == 1)
					{
						return $result->name;
					}
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			if(isset($this->primary_keys[$this->table_name]))
			{
				return $this->primary_keys[$this->table_name];
			}
			if(empty($this->primary_key))
			{
				$fields = $this->get_types_field_table();

				if($fields)
				{
					foreach($fields as $result)
					{
						if($result->primary_key == 1)
						{
							return $result->name;
						}
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return $this->primary_key;
			}
		}
	}

	function join_relation($related_tb, $primary_field, $related_field)
	{
		return $this->db->join($related_tb, $related_tb.'.'.$related_field.' = '.$this->table_name.'.'.$primary_field);
	}

	// table: insert data to table
	function tb_insert($post_array)
	{
		$insert = $this->db->insert($this->table_name, $post_array);
		if($insert)
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	// table: update data to table
	function tb_update($pk_value, $post_array)
	{	
		$pk_field = $this->get_primary_key();
		if($pk_field)
		{
			$this->tb_where(array($pk_field => $pk_value));
			return $this->db->update($this->table_name, $post_array);
		}
		else
		{
			return false;
		}
	}

	// table: delete data from table
	function tb_delete($pk_value)
	{
		$pk_field = $this->get_primary_key();
		if($pk_field)
		{
			$this->db->delete($this->table_name, array($pk_field => $pk_value));
			if($this->db->affected_rows() != 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function tb_where($post_array)
	{
		return $this->db->where($post_array);
	}

	function tb_order($field, $args = 'asc')
	{
		return $this->db->order_by($field,$args);
	}

}

/*End of file model_table.php*/
/*Location: ./application/models/model_table.php*/