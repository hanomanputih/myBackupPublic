<?php
include_once  "WEB-INF/controller/base_controller.php";

class jenis_pengurus_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Jenis Pengurus";
		parent::__construct("jenis_pengurus",$command);
	}
		
	public function getList() {
		$this->model->set_order_column("id_jenis_pengurus");
		$this->model->set_order_method("ASC");
		$header = array("Jenis Pengurus","Deskripsi","Edit");
		$listMap = array(
					 $this->mapping_show(1),
					 $this->mapping_show(2),
					 $this->mapping_edit(0)
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('nama_jenis_pengurus','desc_jenis_pengurus');
		$this->_getById($field);
	}
}
?>