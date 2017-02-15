<?php
include_once  "WEB-INF/controller/base_controller.php";

class daerah_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Daerah";
		parent::__construct("daerah",$command);
	}
		
	public function getList() {
		$this->model->set_order_column("id_daerah");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_suffix($this->get_role_detail(false));
		
		$header = array("Daerah","Deskripsi","Edit");
		$listMap = array(
					 $this->mapping_show(1),
					 $this->mapping_show(2),
					 $this->mapping_edit(0)
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('nama_daerah','desc_daerah');
		$this->_getById($field);
	}
	
	/**
	 * 
	 * generate option select
	 */
	public function getSelect() {
		$this->model->set_select_full_suffix($this->get_role_detail(false));
		if(isset($_GET['checkbox']))
			$this->_getCheckbox();
		else
			$this->_getSelect(false);
	}
	
	public function getAutocomplete() {
		$this->model->set_order_column("nama_daerah");
		$this->model->set_order_method("ASC");

		$this->model->set_select_full_suffix("nama_daerah like '%" . $_GET['q'] . "%'" . $this->get_role_detail());
		$this->_getAutocomplete();
	}
}
?>