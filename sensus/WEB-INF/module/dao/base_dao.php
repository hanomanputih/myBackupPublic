<?php
abstract class base_dao
{
	protected $clazz;
	protected $fields;
	protected $methods;
	protected $db;
	
	/**
	 * constructor untuk base_dao
	 * melakukan reflection terhadap properti sesuai dengan $class_name, meliputi property dan function
	 * @param String $class_name
	 */
	function __construct($class_name)
	{
		$reflection = new ReflectionClass($class_name);
		$this->fields = $reflection->getDefaultProperties();
		$this->methods = $reflection->getMethods();
		$this->clazz = $class_name;
		$this->db = mysqlid::getInstance();
	}
	
	/**
	 * Select database $model sesuai dengan object $model
	 * @param object $model
	 * @return array hasil query
	 */
	public function select($model) 
	{
		return $this->db->fetch_array($this->create_query_select($model));
	}
	
	/**
	 * Select database $model sesuai dengan object $model
	 * @param object $model
	 * @return array model
	 */
	public function select_model($model) 
	{
		return $this->db->select_object($this->create_query_select($model));
	}
	
	/**
	 * Select database $model sesuai dengan object $model dan start size di limit query
	 * @param object $model
	 * @return array hasil query
	 */
	public function select_paged($model, $start, $size) 
	{
		$query = $this->create_query_select($model) . " LIMIT " . $start . "," . $size;
		return $this->db->fetch_array($query);
	}
	
	/**
	 * Select count database $model sesuai dengan object $model
	 * @param object $model
	 * @return number count
	 */
	public function select_count($model) 
	{
		return $this->db->hitung_row($this->create_query_select($model));
	}

	/**
	 * Select count database $model sesuai dengan object $model dan start size di limit query
	 * @param object $model
	 * @return number count
	 */
	public function select_count_paged($model, $start, $size) 
	{
		$query = $this->create_query_select($model) . " LIMIT " . $start . "," . $size;
		return $this->db->hitung_row($query);
	}
	
	/**
	 * Melakukan penyimpanan object ke database
	 * @param object $model
	 */
	public function save($model)
	{
		$this->db->execute_query($this->create_query_insert($model));
	}
	
	/**
	 * Melakukan penyimpanan object ke database dan mengembalikan id autoincrement
	 * @param object $model
	 */
	public function save_and_get_id($model)
	{
		return $this->db->insert_query($this->create_query_insert($model));
	}
	
	/**
	 * Melakukan update object ke database
	 * @param object $model
	 */
	public function update($model) 
	{
		$this->db->execute_query($this->create_query_update($model));
	}

	/**
	 * Melakukan delete object ke database
	 * @param object $model dengan set_id berisi list array
	 */
	public function delete($model)
	{
		$this->db->execute_query("DELETE FROM ".$this->clazz." WHERE ". $this->get_index_key($this->fields, 0, true). " IN (" . $this->get_value_array($this->invoke_function($model, $this->get_array_method(1))) . ")");
	}

	/**
	 * Melakukan set deaktif object ke database
	 * @param object $model dengan set_id berisi list array
	 */
	public function soft_delete($model)
	{
		$this->db->execute_query("UPDATE " . $this->clazz . " SET TANGGAL_DELETE='" . date("Y-m-d") . "' WHERE ". $this->get_index_key($this->fields, 0, true). " IN (" . $this->get_value_array($this->invoke_function($model, $this->get_array_method(1))) . ")");
	}
	
	/**
	 * Melakukan execusi Query SQL
	 * @param object $query
	 */
	public function execute_query($query)
	{
		$this->db->execute_query($query);
	}
	
	/**
	 * Membuat query Insert sesuai dengan $model
	 * ID object autoincrement dari database
	 * @param class $model
	 * @return String Query SQL Insert
	 */
	private function create_query_insert($model)
	{
		$query = "INSERT INTO " .$this->clazz . " SET ";
		
		foreach ($this->get_property_value($model) as $key => $value)
		{			
			$query = $query . $key . "='" . $value . "',";
		}
		
		return substr($query, 0, -1);
	}
	
	/**
	 * Membuat query update sesuai dengan $model
	 * @param class $model
	 * @return String Query SQL Insert
	 */
	private function create_query_update($model)
	{
		$query = "UPDATE " . $this->clazz . " SET ";
		$queryWhere = "";
		foreach ($this->get_property_value($model,false) as $key => $value)
		{
			if ((strpos($key, "id_") !== false) and !string_tools::is_not_empty_or_null($queryWhere))
				$queryWhere = " WHERE " . $key . "='" . $value . "'";
			else
				$query = $query . $key . "='" . $value . "',";
		}
		
		return substr($query, 0, -1) . $queryWhere;
	}

	/**
	 * Membuat query SQL Select sesuai dengan $model
	 * @param class $model
	 * @return Query String untuk Select
	 */
	protected function create_query_select($model)
	{
		if (string_tools::is_not_empty_or_null($model->get_select_full_prefix())) {
			$query = $model->get_select_full_prefix();
		} 
		else 
		{
			$query = "SELECT * FROM " . $this->clazz;
		}
		
		$queryWhere = "";
		$order = "";
		$order_by="";
		$order_method = web_constant::$ORDER_DESC;
		
		if (string_tools::is_not_empty_or_null($model->get_search_keyword()))
		{
			if(string_tools::is_not_empty_or_null($model->get_select_searchable()))
			{
				$arrSearch = explode(";", $model->get_select_searchable());
				$queryWhere = "(";
				foreach ($arrSearch as $key => $value) {
					$queryWhere .= $value . " like '%" . $model->get_search_keyword() . "%' or ";
				}	
				$queryWhere = substr($queryWhere, 0 , -3) . ")";
			}
			else 
			{
				$queryWhere = $this->get_index_key($this->fields, 1, true) . " like '%" . $model->get_search_keyword() . "%'";
			}
		}
		else 
		{
			foreach ($this->get_property_value($model) as $key => $value) 
			{
				if (string_tools::is_not_empty_or_null($value)) 
				{
					$queryWhere = $queryWhere . " " . $key . "='" . $value . "' AND ";
				}
			}	
			$queryWhere = substr($queryWhere, 0, -4);
		}
		
		if (string_tools::is_not_empty_or_null($model->get_order_column()))
		{
			$order = $model->get_order_column();
		}
		else 
		{
			$order = $this->get_index_key($this->fields, 1, true);
		}
		
		if (string_tools::is_not_empty_or_null($model->get_order_method()))
		{
			$order_method = $model->get_order_method();
		}
		
		if (string_tools::is_not_empty_or_null($model->get_order_by()))
		{
			$order_by = $model->get_order_by();
		}
		
		if (string_tools::is_not_empty_or_null($queryWhere))
		{
			$query = $query . " WHERE " . $queryWhere;
			if (string_tools::is_not_empty_or_null($model->get_select_full_suffix()))
			{
				$query = $query . " AND " . $model->get_select_full_suffix();
			}
		}
		else if (string_tools::is_not_empty_or_null($model->get_select_full_suffix()))
		{
			$query = $query . " WHERE " . $model->get_select_full_suffix();
		}
		
		if(string_tools::is_not_empty_or_null($order_by) OR string_tools::is_not_empty_or_null($order))
		{
			if (string_tools::is_not_empty_or_null($order_by))
				$query = $query . " ORDER BY " . $order_by . " " . $order_method;
			else
				$query = $query . " ORDER BY " . $order . " " . $order_method;
		}

		return $query;
	}

	/**
	 * Mendapatkan key array sesuai dengan $index
	 * @param Array $array
	 * @param int $index $array yang akan dicari
	 * @param boolean $is_key
	 * @return key jika $is_key true, value jika $is_key false
	 */
	protected function get_index_key($array, $index, $is_key)
	{
		$i=0;
		foreach ($array as $key => $value) {
			if ($i == $index)
			{
				if ($is_key)
					return $key;
				else
					return $value;
					
				break;
			}
			$i++;
		}
	}

	/**
	 * Mendapatkan nilai method name sesuai dengan $index
	 * @param int $index mulai dari 0
	 * @return method_name
	 */
	protected function get_array_method($index) {
		return $this->methods[$index]->name;
	}
	
	/**
	 * @return array dari property model yang di set di constructor
	 */
	protected function get_array_field(){
		$arr = array();
		
		foreach ($this->fields as $key => $value)
		{
			array_push($arr, $key);
		}
		
		return $arr;
	}
	
	/**
	 * invoke function sesuai dengan nama function dan nama class model
	 * @param class $model
	 * @param String $method_name
	 */
	protected function invoke_function($model, $method_name)
	{
		return call_user_func(array($model, $method_name));
	}
	
	/**
	 * Mendapankan propery dan value sesuai dengan model
	 * @return array(field=value)
	 * @param $model
	 * @param boolean $notNullOnly , if true hanya akan mengembalikan properti yang memiliki nilai
	 */
	protected function get_property_value($model,$notNullOnly=true)
	{
		$arr = array();
		$arr_field = $this->get_array_field();
		
		$i = 0;
		foreach ( $this->methods as $method) {
			if (substr($method->name, 0, 3) == "get")
			{
				$value= $this->invoke_function($model, $method->name);
				if(string_tools::is_not_empty_or_null($value))
				{
					$arr[$arr_field[$i]]= string_tools::addSlashes(stripslashes($value));
				}
				else if (!$notNullOnly)
				{
					$arr[$arr_field[$i]]='';
				}
				$i++;
			}
			
			if ( $i == count($arr_field))
			{
				break;
			}
		}
		
		return $arr;
	}
	
	/**
	 * mendapatan list value dari array
	 * @param array $array
	 * @return list array 'value1','value2'.....
	 */
	protected function get_value_array($array)
	{
		$result =  "";
		foreach ($array as $key => $value) {
			$result = $result . "'$value',";
		}
		
		return substr($result, 0, -1);
	}
}