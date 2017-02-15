<?php
include_once "WEB-INF/controller/base_controller.php";
	
class notice_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Notice";
		parent::__construct("notice",$command);
	}

	public function getList() {
		$header = array("Notice","Edit");
		$listMap = array(
					 $this->mapping_show(1),
					 $this->mapping_edit(0)
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('notice');
		$this->_getById($field);	
	}
	
	
	public function getListNotice() {
		$rows = $this->svc->select($this->model);
		$select = "";
		foreach ($rows as $row)
		{
			$select .= "<li>$row[1]</li>\n";
		}
		
		echo $select;
	}
}
?>