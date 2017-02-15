<?php
include_once "WEB-INF/controller/base_controller.php";

class desa_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "desa";
		parent::__construct("desa",$command);
	}

	public function getList() {
		$this->model->set_order_by("nama_desa");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable("nama_desa;nama_daerah;desc_desa");
		$this->model->set_select_full_prefix("select id_desa,nama_desa,daerah,nama_daerah,desc_desa from desa,daerah");
		$this->model->set_select_full_suffix("id_daerah=daerah" . $this->get_role_detail());

		$header = array("Desa","Daerah","Deskripsi","Edit");
		$listMap = array(
		$this->mapping_show('nama_desa'),
		$this->mapping_show('nama_daerah'),
		$this->mapping_show('desc_desa'),
		$this->mapping_edit('id_desa')
		);
		$this->_getList($header,$listMap);
	}

	public function getById() {
		$this->model = $this->createModel();
		$field = array("nama_desa","daerah","desc_desa");
		$this->_getById($field);
	}

	public function getSelect() {
		$this->model->set_order_column("nama_desa");
		$this->model->set_select_full_prefix("select id_desa,nama_desa from desa,daerah");
		$this->model->set_select_full_suffix("id_daerah=daerah" . $this->get_role_detail());
		if(isset($_GET['checkbox']))
			$this->_getCheckbox();
		else
			$this->_getSelect(false);
	}
	
	public function getAutocomplete() {
		$this->model->set_order_column("nama_desa");
		$this->model->set_order_method("ASC");
		
		$this->model->set_select_full_suffix("nama_desa like '%" . $_GET['q'] . "%'" . $this->get_role_detail());
		$this->_getAutocomplete();
	}
	
	public function get_list_daerah($list_desa) {
		$this->model->set_select_full_prefix("select distinct(daerah) daerah from desa");
		$this->model->set_select_full_suffix("id_desa in (" . $list_desa . ")");
		$desa = $this->svc->select_model($this->model);
		return $desa[0]->daerah;
	}
}
?>