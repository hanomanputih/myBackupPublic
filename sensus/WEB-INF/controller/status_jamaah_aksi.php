<?php
include_once  "WEB-INF/controller/base_controller.php";

class status_jamaah_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Status Jamaah";
		parent::__construct("status_jamaah",$command);
	}
		
	public function getList() {
		$this->model->set_order_column("id_status_jamaah");
		$this->model->set_order_method("ASC");
		$header = array("Jenis Jamaah","Deskripsi","Edit");
		$listMap = array(
					 $this->mapping_show(1), // header 0
					 $this->mapping_show(2), // header 1
					 $this->mapping_edit(0)  // header 2
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('nama_status_jamaah','desc_status_jamaah');
		$this->_getById($field);
	}
	
	public function get_menu_filter() {
		return $this->_get_menu_filter('status_jamaah[]');
	}
}
?>