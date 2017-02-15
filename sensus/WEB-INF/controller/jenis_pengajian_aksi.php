<?php
include_once  "WEB-INF/controller/base_controller.php";

class jenis_pengajian_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Jenis Pengajian";
		parent::__construct("jenis_pengajian",$command);
	}
		
	public function getList() {
		$this->model->set_order_column("id_jenis_pengajian");
		$this->model->set_order_method("ASC");
		$header = array("Jenis Pengajian","Peserta","Edit");
		$listMap = array(
					 $this->mapping_show(1),
					 $this->mapping_action_redirect('Detail Peserta',getScriptUrl() . 'jenis-pengajian-detail/secret.html',array('?nama_jenis_pengajian=',1),array('&jenis_pengajian=',0)),
					 $this->mapping_edit(0)
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('nama_jenis_pengajian');
		$this->_getById($field);
	}
	
	public function getModelById($id) {
		$this->model->set_id_jenis_pengajian($id);
		$result = $this->svc->select_model($this->model);
		return $result[0];
	}
	
	public function get_menu_filter() {
		return $this->_get_menu_filter('jenis_pengajian[]');
	}
}
?>