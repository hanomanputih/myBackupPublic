<?php
include_once "WEB-INF/controller/base_controller.php";

class user_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "User";
		parent::__construct("user",$command);
	}
	
	public function getList() {
		$this->model->set_order_by("nama_lengkap");
		$this->model->set_select_searchable("username;nama_lengkap");
		$this->model->set_select_full_prefix("select id_user,username,nama_lengkap,password,nama_role,last_session from user,role");
		$this->model->set_select_full_suffix("id_role=role");
		$header = array("Username","Nama Lengkap","Password","Role","Last session","Edit");
		$listMap = array(
					 $this->mapping_show(1),
					 $this->mapping_show(2),
					 $this->mapping_show(3),
					 $this->mapping_show(4),
					 $this->mapping_show(5),
					 $this->mapping_edit(0)
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array("username","nama_lengkap","password","role");
		$this->_getById($field);
	}
	
	public function getModelByUsername($username) {
		$this->model = new user();
		$this->model->set_username($username);
		$result = $this->svc->select_model($this->model);
		return $result[0];
	}
}
?>