<?php
include_once  "WEB-INF/controller/base_controller.php";

class menu_function_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Menu Function";
		parent::__construct("menu_function",$command);
	}
	
	public function getList() {
		$this->model->set_order_column("id_menu_function");
		$this->model->set_order_method("ASC");
		$header = array("Nama Menu Function","Deskripsi","Edit");
		$listMap = array(
					 $this->mapping_show(1), // header 0
					 $this->mapping_show(2), // header 0
					 $this->mapping_edit(0)  // header 2
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array("nama_menu_function","desc_menu_function");
		$this->_getById($field);
	}
	
	public function getByName($is_select_count=false){
		$this->model->set_nama_menu_function($this->Command->getFunction());
		if ($is_select_count)
			return $this->svc->select_count($this->model);
		else
			return $this->svc->select($this->model);
	}
	
	public function getSelect() {
		$this->model->set_order_column("nama_menu_function");
		$this->_getSelect();
	}
	
	/**
	 * 
	 * Mendapatkan list permission berdasarkan function masing-masing controller
	 */
	public function permission_selected($role,$menu) {
		$this->model->set_select_full_prefix('select id_menu_function,nama_menu_function,(select count(*) from permission where menu_function=id_menu_function and role=' . $role . ' and menu=' . $menu .') checked from menu_function, menu_function_detail');
		$this->model->set_select_full_suffix('id_menu_function > 1 and menu_function=id_menu_function and menu=' . $menu);
		$this->model->set_order_by('id_menu_function');
		$this->model->set_order_method('ASC');
		return $this->svc->select($this->model);
	}
	
	/**
	 * 
	 * Mendapatkan semua list permission dari menu_function
	 * @param Object $menu_function_detail
	 */
	public function menu_function_selected($menu_function_detail) {
		$this->model->set_select_full_prefix('select id_menu_function, concat(nama_menu_function,\' (\',desc_menu_function,\')\') nama_function, (select count(*) from menu_function_detail where menu_function=id_menu_function and menu=\'' . $menu_function_detail->get_menu() . '\') selected from menu_function');
		return $this->svc->select($this->model);
	}
}
?>