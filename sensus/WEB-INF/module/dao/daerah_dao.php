<?php 
class daerah_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("daerah");
	}
	
	final public static function getInstance(){
        if(null !== daerah_dao::$_instance){
            return daerah_dao::$_instance;
        }

        daerah_dao::$_instance = new daerah_dao();
        return daerah_dao::$_instance;
    } 
  
	/**
	 * Membuat query SQL Select sesuai dengan $model
	 * @param class $model
	 * @return Query String untuk Select
	 */
    /*
	protected function create_query_select($model)
	{
		require_once 'WEB-INF/controller/role_detail_aksi.php';
		$role_detail = new role_detail_aksi($model->get_command());
		$query_role = $role_detail->get_query_role_detail();
		
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
			$query = $query . " AND " . $query_role;;
		}
		else if (string_tools::is_not_empty_or_null($model->get_select_full_suffix()))
		{
			$query = $query . " WHERE " . $model->get_select_full_suffix() . " AND " . $query_role;;
		}
		else if (string_tools::is_not_empty_or_null($query_role))
		{
			$query = $query . " WHERE " . $query_role;	
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
	*/
}