<?php
include_once "WEB-INF/controller/base_controller.php";
	
class pendidikan_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Pendidikan";
		parent::__construct("pendidikan",$command);
	}

	public function getList() {
		$header = array("Pendidikan","Edit");
		$listMap = array(
					 $this->mapping_show(1),
					 $this->mapping_edit(0)
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('nama_pendidikan');
		$this->_getById($field);	
	}
	
	
	public function get_menu_filter() {
		return $this->_get_menu_filter('pendidikan[]');
	}
}
?>