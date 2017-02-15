<?php
include_once  "WEB-INF/controller/base_controller.php";

class tingkat_organisasi_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Tingkat Organisasi";
		parent::__construct("tingkat_organisasi",$command);
	}
		
	public function getList() {
		$this->model->set_order_column("id_tingkat_organisasi");
		$this->model->set_order_method("ASC");
		$header = array("Tingkat Organisasi","Edit");
		$listMap = array(
					 $this->mapping_show(1), // header 0
					 $this->mapping_edit(0)  // header 2
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('nama_tingkat_organisasi');
		$this->_getById($field);
	}
	
	public function getModelById($id) {
		$this->model = new tingkat_organisasi();
		$this->model->set_id_tingkat_organisasi($id);
		$result = $this->svc->select_model($this->model);
		return $result[0];
	}
}
?>