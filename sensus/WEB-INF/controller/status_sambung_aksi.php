<?php
include_once  "WEB-INF/controller/base_controller.php";

class status_sambung_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Status Sambung";
		parent::__construct("status_sambung",$command);
	}
		
	public function getList() {
		$this->model->set_order_column("id_status_sambung");
		$this->model->set_order_method("ASC");
		$header = array("Status Sambung","Deskripsi","Edit");
		$listMap = array(
					 $this->mapping_show(1), // header 0
					 $this->mapping_show(2), // header 1
					 $this->mapping_edit(0)  // header 2
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('nama_status_sambung','desc_status_sambung');
		$this->_getById($field);
	}
	
	public function get_menu_filter() {
		return $this->_get_menu_filter('status_sambung[]');
	}
		
	/**
	 * 
	 * Mendapatkan semua list checked dari status_sambung
	 * @param Object $menu_function_detail
	 */
	public function status_sambung_selected($jenis_pengajian_detail) {
		$this->model->set_select_full_prefix('select id_status_sambung, nama_status_sambung, (select count(*) from jenis_pengajian_detail where status_sambung=id_status_sambung and jenis_pengajian=' . $jenis_pengajian_detail->get_jenis_pengajian() . ') selected from status_sambung');
		return $this->svc->select($this->model);
	}
}
?>