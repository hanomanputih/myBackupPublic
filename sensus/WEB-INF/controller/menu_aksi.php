<?php
include_once "WEB-INF/controller/base_controller.php";

class menu_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = 'Menu';
		parent::__construct("menu",$command);
	}
	
	public function index(){
		$this->_default();
	}
	
	public function edt() {
		$this->model = $this->createModel();
		if(!isset($_POST[shortcut]))
			$this->model->set_shortcut('false');
			
		$result = array();
		
		try {
			$this->svc->update($this->model);
			$result[messageBox] = message_box::valid_box("Update " . $this->titleClass ." berhasil disimpan!");
			$result[error] = false;
		} catch (Exception $e) {
			$result[messageBox] = message_box::error_box($e->getMessage());
			$result[error] = true;
		}
				
		echo json_encode($result);
	}
	
	public function del() {
		$listId = $_POST[id];
		
		include_once 'menu_function_detail_aksi.php';
		include_once 'permission_aksi.php';
		
		$menu_fu_det_aksi = new menu_function_detail_aksi($this->Command);
		$per_aksi = new permission_aksi($this->Command);
		
		$menu_fu_det_aksi->del_by_menu($listId);
		$per_aksi->del_by_menu($listId);
		
		$this->model = $this->createModel();
		echo $this->_del($listId, $this->model);
	}
	
	private function urlChecker($url) {
		$url = string_tools::replaceStripToUnderscore($url);
		if (string_tools::startsWith($url, '/')) {
			return substr($url, 1);
		} else {
			return $url;
		}
	}
	
	public function menu() {
		$this->model->set_order_column('menu');
		$this->model->set_order_method('ASC');
		$this->model->set_select_full_prefix('SELECT m.id_menu,m.title_menu,m.controller,m.end_path,lower(m.target),m.urut,m.menu FROM user u,permission p,menu m');
		$this->model->set_select_full_suffix('p.role=u.role and m.ID_MENU=p.MENU and u.username=\'' . $this->Command->getUserLogged()->get_username() . '\' and p.menu_function=1');
		$rows = $this->svc->select($this->model);
		$menu = array();
		foreach ($rows as $row) {
			if ($row[6] == null) {
				if (!array_key_exists($row[0],$menu)) {
					$menu[$row[0]] = array('nama'=>$row[1],
										   'order'=>$row[5],
										   'url'=>$this->urlChecker($row[2] . $row[3]),
										   'target'=>$row[4],
										   'submenu'=>array()
										   );
				}
			} else {
				$obj = array('nama'=>$row[1],
						   	 'order'=>$row[5],
						   	 'url'=>$this->urlChecker($row[2] . $row[3]),
							 'target'=>$row[4],
						   	 'submenu'=>array()
						   	 );
				$this->insert_array($menu,$obj,$row);
			}
		}
		$this->sort_array($menu);
		$result['menu'] = form_render::menu_render(json_encode($menu));
		$result['shortcut'] = $this->menu_shortcut();
		return $result;
	}
	
	private function menu_shortcut() {
		$this->model->set_order_column('title_menu');
		$this->model->set_order_method('ASC');
		$this->model->set_select_full_prefix('SELECT m.id_menu,m.title_menu,m.controller,m.end_path FROM user u,permission p,menu m');
		$this->model->set_select_full_suffix('p.role=u.role and m.ID_MENU=p.MENU and u.username=\'' . $this->Command->getUserLogged()->get_username() . '\' and p.menu_function=1 and m.shortcut=\'true\'');
		$rows = $this->svc->select($this->model);
		$menu = array();
		foreach ($rows as $row) {
			$shortcut = array('nama'=>$row[1],
							  'url'=>$this->urlChecker($row[2] . $row[3])
							 );
			$menu[] = $shortcut;
		}
		
		return form_render::menu_shortcut_render(json_encode($menu));
	}

	public function menu_permission() {
		$this->model->set_order_column('menu');
		$this->model->set_order_method('ASC');
		$this->model->set_select_full_prefix('select id_menu,title_menu,controller,end_path,target,urut,menu,(select count(*) from permission p where p.menu=id_menu and p.menu_function=1 and role=' . $_GET[role] . ') checked from menu');
		$rows = $this->svc->select($this->model);
		$menu = array();
		foreach ($rows as $row) {
			$functions = array();
			if ($row[2] != null){
				include_once 'menu_function_aksi.php';
				$menu_function = new menu_function_aksi($this->Command);
				$rows_menu_function = $menu_function->permission_selected($_GET[role],$row[0]);
				foreach ($rows_menu_function as $row_function) {
					$functions[] = array('nama'=>$row_function[1],
										 'id'=>$row_function[0],
										 'checked'=>$row_function[2]
										 );
				}
			}
			
			if ($row[6] == null) {
				if (!array_key_exists($row[0],$menu)) {
					$menu[$row[0]] = array('nama'=>$row[1],
										   'order'=>$row[5],
										   'id'=>$row[0],
										   'functions'=>$functions,
										   'submenu'=>array(),
										   'checked'=>$row[7]
										   );
				}
			} else {
				$obj = array('nama'=>$row[1],
						   	 'order'=>$row[5],
						   	 'id'=>$row[0],
		   					 'functions'=>$functions,
						     'submenu'=>array(),
							 'checked'=>$row[7]
						   	 );
				$this->insert_array($menu,$obj,$row);
			}
		}
		$this->sort_array($menu);
		echo form_render::permission_render(json_encode($menu));
	}
	
	private function insert_array(&$submenu, $obj, $row) {
		if (array_key_exists($row[6],$submenu)) {
			$submenu[$row[6]]['submenu'][$row[0]] = $obj;
		} else {
			foreach ($submenu as $key => $value) {
				if (count($value['submenu']) != 0) {
					$this->insert_array($submenu[$key]['submenu'],$obj, $row);
				}
			}
		}
	}
	
	private function sort_array(&$menu) {
		$tempKey = array();
		foreach ($menu as $key => $value) {
			$tempKey[] = $key;
		}
		
		for ($i = 0; $i < count($tempKey); $i++) {
			for ($j = $i; $j < count($tempKey); $j++) {
				if ($menu[$tempKey[$i]]['order'] > $menu[$tempKey[$j]]['order']) {
					$temp = $menu[$tempKey[$i]];
					$menu[$tempKey[$i]] = $menu[$tempKey[$j]];
					$menu[$tempKey[$j]] = $temp;
				} 
			}
			if(count($menu[$tempKey[$i]]['submenu']) != 0) {
				$this->sort_array($menu[$tempKey[$i]]['submenu']);
			}
		}
	}

	public function getList() {
		$this->model->set_order_column("title_menu");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix('select n.id_menu,n.title_menu,n.controller,n.end_path,n.target,n.urut,(select m.title_menu from menu m where m.id_menu=n.menu) menu, shortcut from menu n');
		$header = array("Title Menu","Controller","End Path","Target","No. Urut","Main Menu","Functions","Shortcut","Edit");
		$listMap = array(
					 $this->mapping_show(1),
					 $this->mapping_show(2),
					 $this->mapping_show(3),
					 $this->mapping_show(4),
					 $this->mapping_show(5),
					 $this->mapping_show(6),
					 $this->mapping_action_redirect('Detail Function',getScriptUrl() . 'menu_function_detail/secret.html',array('?nama_menu=',1),array('&menu=',0)),
					 $this->mapping_show(7),
					 $this->mapping_edit(0)
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getSelect() {
		$this->_getSelect(true);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array("title_menu","controller","end_path","target","urut","menu","shortcut");
		$this->_getById($field);
	}
	
	public function getByController($is_select_count=false) {
		$this->model->set_controller($this->Command->getControllerName());
		if ($is_select_count)
			return $this->svc->select_count($this->model);
		else 
			return $this->svc->select($this->model);
		
	}
}