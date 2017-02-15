<?php
include_once "WEB-INF/controller/base_controller.php";

class permission_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Permission";
		parent::__construct("permission",$command);
	}
	
	public function add() {
		$model = $this->createModel();
		$result = array();
		
		try {
			$this->svc->save($model);
			$result[messageBox] = message_box::valid_box($this->titleClass . " berhasil disimpan!");
			$result[error] = false;
		} catch (Exception $e) {
			$result[messageBox] = $e->getMessage();
			$result[error] = true;
		}
				
		echo json_encode($result);
	}
	
	public function del() {
		$this->model = $this->createModel();
		try {
			$this->svc->execute_query('delete from permission where role='. $this->model->get_role() . ' and menu=' . $this->model->get_menu() . ' and menu_function=' . $this->model->get_menu_function());
			$result[messageBox] = message_box::valid_box("$deleteCount data berhasil dihapus.");
			$result[error] = false;
		} catch (Exception $e) {
			$result[messageBox] = $e->getMessage();
			$result[error] = true;
		}
		
		echo json_encode($result);
	}
	
	/**
	 * 
	 * Cek apakah user login memiliki akses ke controller (jika ada didatabase, kalau tidak di bypass)
	 * @param dari Command
	 */
	public function is_accessible_controller() {
		include_once 'menu_aksi.php';
		$menu_aksi = new menu_aksi($this->Command);
		if($menu_aksi->getByController(true) != 0) {
			include_once 'menu_function_aksi.php';
			$menu_function_aksi = new menu_function_aksi($this->Command);
			if($menu_function_aksi->getByName(true) != 0) {
				$this->model = new permission();
				$this->model->set_select_full_prefix('select * from permission p,user u');
				$this->model->set_select_full_suffix('p.ROLE = u.ROLE and p.MENU = (select id_menu from menu where controller=\'' . $this->Command->getControllerName() . '\') and u.USERNAME=\'' . $this->Command->getUserLogged()->get_username() . '\' and menu_function=(select id_menu_function from menu_function where nama_menu_function="' . $this->Command->getFunction() . '" limit 1)');
				return ($this->svc->select_count($this->model) > 0) ? true : false;
			}
		}
		
		return true;
	}
	
	/**
	 * delete by menu
	 * @param $listMenu : list id_menu
	 */
	public function del_by_menu($listMenu){
		$this->svc->execute_query('	delete from permission where menu in(' . implode(',',$listMenu) . ')');
	}
}