<?php
include_once  "WEB-INF/controller/base_controller.php";

class pekerjaan_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Pekerjaan";
		parent::__construct("pekerjaan",$command);
	}
		
	public function getList() {
		$this->model->set_order_column("id_pekerjaan");
		$this->model->set_order_method("ASC");
		$header = array("Pekerjaan","Deskripsi","Edit");
		$listMap = array(
					 $this->mapping_show('NAMA_PEKERJAAN'),
					 $this->mapping_show('DESC_PEKERJAAN'),
					 $this->mapping_edit('ID_PEKERJAAN')
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('nama_pekerjaan','desc_pekerjaan');
		$this->_getById($field);
	}
	
	public function get_menu_filter() {
		return $this->_get_menu_filter('pekerjaan[]');
	}
}
?>