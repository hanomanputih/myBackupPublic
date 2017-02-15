<?php
include_once "WEB-INF/controller/base_controller.php";

class role_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = 'Role';
		parent::__construct("role",$command);
	}
	
	public function getList() {
		$this->model->set_order_column("nama_role");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable("nama_role");
		$this->model->set_select_full_prefix("select id_role,nama_role,tingkat_organisasi,nama_tingkat_organisasi from role,tingkat_organisasi");
		$this->model->set_select_full_suffix("tingkat_organisasi=id_tingkat_organisasi");
		$header = array("Nama role","Permission","Detail Organisasi","Edit");
		$listMap = array(
					 $this->mapping_show(1),
					 $this->mapping_action_redirect('Detail Permission',getScriptUrl() . 'permission/secret.html',array('?nama_role=',1),array('&role=',0)),
					 $this->mapping_action_redirect('Detail Organisasi',getScriptUrl() . 'role_detail/secret.html',array('?nama_role=',1),array('&role=',0),3),
					 $this->mapping_edit(0)
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getSelect() {
		$this->_getSelect();
	}
	
	public function add() {
		$this->model = $this->createModel();
		
		if (!isset($_POST['show_deleted_record']))
			$this->model->set_show_deleted_record('0');
			
		echo $this->_add($this->model);
	}
	
	public function edt() {
		$this->model = $this->createModel();
		if (!isset($_POST['show_deleted_record']))
			$this->model->set_show_deleted_record('0');
			
		echo $this->_edt($this->model);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array("nama_role","tingkat_organisasi","show_deleted_record");
		$this->_getById($field);
	}
	
	public function getModelById($id) {
		$this->model = new role();
		$this->model->set_id_role($id);
		$result = $this->svc->select_model($this->model);
		return $result[0];
	}
	
	public function getModelByUsername($username) {
		require_once 'user_aksi.php';
		$user_aksi = new user_aksi($this->Command);
		$user = new user();
		$user = $user_aksi->getModelByUsername($username);
		return $this->getModelById($user->ROLE);
	}
}