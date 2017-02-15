<?php
include_once  "WEB-INF/controller/base_controller.php";

class menu_function_detail_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Menu Function Detail";
		parent::__construct("menu_function_detail",$command);
	}
	
	public function getList() {
		$this->model = $this->createModel();
		$this->model->set_menu($_GET['menu']);
		include_once 'menu_function_aksi.php';
		$menu_function_aksi = new menu_function_aksi($this->Command);
		$rows = $menu_function_aksi->menu_function_selected($this->model);
		$list_checkbox = "";
		foreach ($rows as $row) {
			$checked = ($row[2] == 1) ? 'checked="checked"' : '';
			$list_checkbox .= '<input type="checkbox" ' . $checked . ' onclick=\'javascript:toggle(this,' . $row[0] . ')\'>' . $row[1] . '</input> </br>';
		}
		echo $list_checkbox;
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
			$this->svc->execute_query('delete from menu_function_detail where menu='. $this->model->get_menu() . ' and menu_function=' . $this->model->get_menu_function());
			$result[messageBox] = message_box::valid_box("$deleteCount data berhasil dihapus.");
			$result[error] = false;
		} catch (Exception $e) {
			$result[messageBox] = $e->getMessage();
			$result[error] = true;
		}
		
		echo json_encode($result);
	}
		
	/**
	 * delete by menu
	 * @param $listMenu : list id_menu
	 */
	public function del_by_menu($listMenu){
		$this->svc->execute_query('delete from menu_function_detail where menu in(' . implode(',',$listMenu) . ')');
	}
}
?>