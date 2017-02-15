<?php
include_once  "WEB-INF/controller/base_controller.php";

class todo_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Todo";
		parent::__construct("todo",$command);
	}
	
	public function getList() {
		$this->model->set_order_column("id_todo");
		$this->model->set_order_method("ASC");
		$header = array("Todo","Tanggal","Edit");
		$listMap = array(
					 $this->mapping_show(1), // header 0
					 $this->mapping_show(2), // header 1
					 $this->mapping_edit(0)  // header 2
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getListTodoList() {
		$this->model->set_order_column("tanggal");
		$this->model->set_order_method("DESC");
		$this->model->set_select_full_prefix("select id_todo, todo, DATE_FORMAT(tanggal,('%d-%m-%Y %H:%i:%s')) tanggal from todo");
		$this->model->set_select_full_suffix("tanggal >= now()");
		
		$rows = $this->svc->select($this->model);
		$select = "";
		foreach ($rows as $row)
		{
			$select .= "<li><b>$row[2]</b></br>$row[1]</li>\n";
		}
		
		echo $select;
	}
	
	public function getById() {
		$model = new todo();
		$model->set_id_todo($_POST[id]);
		$rows = $this->svc->select($model);
		$jamTgl = explode(" ", $rows[0][2]);
		$result['todo'] = $rows[0][1];
		$result['tanggal'] = $jamTgl[0];
		$result['jam'] = $jamTgl[1];
		echo json_encode($result);
	}
	
	protected function createModel() {
		$reflection = new ReflectionClass($this->className);
		$methods = $reflection->getMethods();
		
		foreach ($methods as $method) {
			$propertiesName = (substr($method->name, 4, 2) == id) ? "id" : substr($method->name, 4); 
			if(substr($method->name, 0, 3) == "set" and isset($_POST[$propertiesName])) {
				if ($propertiesName == 'tanggal')
					call_user_func_array(array($this->model, $method->name), array(($_POST[tanggal] . " " . $_POST[jam])));
				else
					call_user_func_array(array($this->model, $method->name), array(($_POST[$propertiesName])));
			}
		}
		return $this->model;
	}
}
?>