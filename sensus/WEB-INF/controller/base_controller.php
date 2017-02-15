<?php 
include_once "WEB-INF/module/tools/string_tools.php";
include_once "WEB-INF/module/shared/web_constant.php";
include_once "WEB-INF/module/tools/form_render.php";
include_once "WEB-INF/module/tools/message_box.php";
include_once 'WEB-INF/module/service/impl/base_service_impl.php';
include_once "WEB-INF/module/dao/base_dao.php";
include_once "WEB-INF/module/conf/mysqlid.php";

class base_controller{
	protected $svc;
	protected $model;
	protected $titleClass;
	protected $className;
	protected $Command;
	protected $log;
	
	public function __construct($className,&$command){
		$this->Command = $command;
		$this->log = new KLogger('log/controller', KLogger::DEBUG);
		if(string_tools::is_not_empty_or_null($className)) {
			include_once ('WEB-INF/module/model/' . $className . '.php');
			include_once ('WEB-INF/module/dao/' . $className . '_dao.php');
			include_once ('WEB-INF/module/service/impl/' . $className . '_service_impl.php');
			$this->svc = call_user_func($className . '_service_impl::getInstance');
			$this->model = new $className();
			$this->className = $className;
		}
	}
	
	public function set_command($Command) {
		$this->Command = $Command;
	}
    
    public function execute() {
		$this->log->logInfo('Finally	  :: ' . $this->Command->getUserLogged()->get_username() . ' tried to access controller ' . $this->Command->getControllerName() . ', function ' . $this->Command->getFunction() . ', param ' . json_encode($this->Command->getParameters()));
		call_user_func(array(&$this,$this->Command->getFunction()));
	}
	
    public function _default() {
		include 'WEB-INF/view/' . $this->className . "_view.php";
    }
    
    public function _list() {
    	show_template_index($this->Command);
    }

    public function _error() {
		show_template_index($this->Command);
    }
	
    /**
	 * Membuat list table dan pagination
	 * @param $header, array list menu table
	 * @param $listMap, list mapping $header dan database
	 *  
	 * @uses controller /list.html
	 */
	protected function _getList($header, $listMap) {
		$searchKeyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
		
		// check user authority to edit
		$temp_Command = $this->Command;
		$temp_Command->setFunction('edt');
		$permission_aksi = new permission_aksi($temp_Command);
		if (!$permission_aksi->is_accessible_controller()) {
			foreach ($header as $key => $value) {
				if ($value == 'Edit') {
					unset($listMap[$key]);
					unset($header[$key]);
				}
			}
		}
		
		$pageNow = (isset($_GET['page'])) ? $_GET['page'] : 1;
		
		if (string_tools::is_not_empty_or_null($searchKeyword)) {
			$this->model->set_search_keyword($searchKeyword);
		}
		
		$start = ($pageNow * web_constant::$DEFAULT_PAGINATED_SIZE) - web_constant::$DEFAULT_PAGINATED_SIZE;
		
		$rows = $this->svc->select_paged($this->model, $start, web_constant::$DEFAULT_PAGINATED_SIZE);
		// row count for pagination
		$rowCount = $this->svc->select_count($this->model);
		
		$rowArray = array();
		if ($rowCount != 0) {
			$rowArray = $this->generate_html_map($rows,$listMap,$header);
			$countMax = ($pageNow * web_constant::$DEFAULT_PAGINATED_SIZE) > $rowCount ? $rowCount : $pageNow * web_constant::$DEFAULT_PAGINATED_SIZE;
			
			$arrayItem = array("header"=>$header,"rows"=>$rowArray,"footer"=>($pageNow * web_constant::$DEFAULT_PAGINATED_SIZE) - (web_constant::$DEFAULT_PAGINATED_SIZE - 1)  . "-" . $countMax . " dari $rowCount Data " . $this->titleClass);
			$json_result = json_encode($arrayItem);
			
			$return['table'] = form_render::render_json($json_result);
			$return['pagination'] = form_render::pagination_render($pageNow, $rowCount);
			
			echo json_encode($return);
		} else {
			$arrayItem = array("header"=>$header,"rows"=>$rowArray,"footer"=>"0-0 dari 0 Data " . $this->titleClass);
			
			$json_result = json_encode($arrayItem);
			$return['table'] = form_render::render_json($json_result);
			$return['pagination'] = form_render::pagination_null_render();
			echo json_encode($return);
		}
	}
	
	protected function createModel() {
		$reflection = new ReflectionClass($this->className);
		$methods = $reflection->getMethods();
		
		foreach ($methods as $method) {
			$propertiesName = (substr($method->name, 4, 2) == id) ? "id" : substr($method->name, 4); 
			if(substr($method->name, 0, 3) == "set" and isset($_POST[$propertiesName])) {
				call_user_func_array(array($this->model, $method->name), array(($_POST[$propertiesName])));
			}
		}
		return $this->model;
	}
	
	public function add() {
		$this->model = $this->createModel();
		echo $this->_add($this->model);
	}
	
	protected function _add($model) {
		$result = array();
		
		try {
			$this->svc->save($model);
			$result[messageBox] = message_box::valid_box($this->titleClass . " berhasil disimpan!");
			$result[error] = false;
		} catch (Exception $e) {
			$result[messageBox] = message_box::error_box($e->getMessage());
			$result[error] = true;
		}
				
		return json_encode($result);
	}
	
	protected function _add_and_get_id($model) {
		$message = array();
		
		try {
			$message['id'] = $this->svc->save_and_get_id($model);
			$message['messageBox'] = message_box::valid_box($this->titleClass . " berhasil disimpan!");
			$message['error'] = false;
		} catch (Exception $e) {
			$message['messageBox'] = message_box::error_box($e->getMessage());
			$message['error'] = true;
		}
		return $message;
	}
	
	public function edt() {
		$this->model = $this->createModel();
		echo $this->_edt($this->model);
	}
	
	protected function _edt($model) {
		$result = array();
		
		try {
			$this->svc->update($model);
			$result[messageBox] = message_box::valid_box("Update " . $this->titleClass ." berhasil disimpan!");
			$result[error] = false;
		} catch (Exception $e) {
			$result[messageBox] = message_box::error_box($e->getMessage());
			$result[error] = true;
		}
				
		return json_encode($result);
	}
	
	public function del() {
		$listId = $_POST['id'];
		$this->model = $this->createModel();
		echo $this->_del($listId, $this->model);
	}
	
	/**
	 * 
	 * funsi untuk menghapus instance di database
	 * @param array $listId
	 * @param object $model
	 */
	protected function _del($listId, $model) {
		$deleteCount = count($listId);
		$result = array();
		if (string_tools::is_not_empty_or_null($deleteCount)){
			try {
				$this->svc->delete($model);
				$result[messageBox] = message_box::valid_box("$deleteCount data berhasil dihapus.");
				$result[error] = false;
			} catch (Exception $e) {
				$result[messageBox] = message_box::error_box($e->getMessage());
				$result[error] = true;
			}
		} else{
			$result[messageBox] = message_box::warning_box('Tidak ada data yang tercentang!');
			$result[error] = true;
		}
		
		return json_encode($result);
	}

	/**
	 * 
	 * Menghasilkan json untuk getSelect
	 * @param array $field
	 */
	protected function _getById($field) {
		$rows = $this->svc->select($this->model);
		
		$result = array();

		foreach ($field as $key => $value) {
			$result[$value] = $rows[0][$key+1];
		}
		echo json_encode($result);
	}
	
	/**
	 * 
	 * generate option select
	 */
	public function getSelect() {
		$this->_getSelect(false);
	}
	
	/**
	 * 
	 * generate option select
	 * @param boolean $insertNull : memberikan null di select options
	 */
	protected function _getSelect($insertNull = false) {
		$this->model = $this->createModel();
		$this->model->set_order_method("ASC");
		
		$rows = $this->svc->select($this->model);
		if ($insertNull) {
			$select = "<option value=\"\"></option>\n";
		} else if (count($rows) != 1) {
			$select = "<option selected=\"selected\" value=\"00\">-Select-</option>\n";;
		}
		
		foreach ($rows as $row)
		{
			$select .= "<option value=\"$row[0]\">$row[1]</option>\n";
		}
		
		echo $select;
	}
	
	/**
	 * 
	 * generate input checkbox
	 */
	protected function _getCheckbox() {
		$this->model = $this->createModel();
		$this->model->set_order_method("ASC");
		
		$rows = $this->svc->select($this->model);
		
		foreach ($rows as $row) {
			$result .= "<input type='checkbox' checked='checked' name='" . $this->className . "[]' value=" . $row[0] . " />" . $row[1] . "</br>";
		} 
		
		echo $result;
	}
	
	/**
	 * Membuat html detail
	 * @param $header, array list menu
	 * @param $listMap, list mapping $header dan database
	 * @param $create, default true untuk membuat object baru
	 * @param optional array $opt = array("left"=>{0},"right"=>{1})
	 *   
	 * @uses controller /detail.html
	 */
	protected function _detail($header,$listMap,$create=true,$opt=array()) {
		if ($create)
			$this->model = $this->createModel();	
		
		$rows = $this->svc->select($this->model);
		//$rowCount = $this->svc->select_count($this->model);
		
		$rowArray = array();
		//if ($rowCount != 0) {
		if (count($rows) != 0) {
			$rowArray = $this->generate_html_map($rows,$listMap,$header);
		}

		$arrayItem = array("header"=>$header,"rows"=>$rowArray);
		$json_result = json_encode($arrayItem);
		echo form_render::detail_render($json_result,$opt);
	}
	
	protected function _getAutocomplete() {
		$rowArray = array();
		$this->model->set_command($this->Command);
		$rows = $this->svc->select_paged($this->model, 0, 10);
		
		foreach ($rows as $row) {
			$rowArray[]  = array("label"=>$row[0], "value"=>$row[1]);
		}
		
		$result = array("result"=>$rowArray);
		echo json_encode($result);
	}
	
	/**
	 * generate html from mapping
	 * 
	 * @param $tempRow['ID'] -> return checkbox whitin id ID
	 * @param $tempRow['index'] -> return value index
	 */
	protected function generate_html_map($rows,$listMap,$header) {
		$rowArray = array();
		foreach ($rows as $row) {
			$tempRow = array();			
			$tempRow['ID'] = $row[0];
			
			foreach ($listMap as $key => $map) {
				if ($map[0] == 'show') {
					$tempRow[$header[$key]] = $row[$map[1]];
				} else if ($map[0] == 'edit') {
					$tempRow[$header[$key]] = form_render::action_edit($row[$map[1]]);
				} else if ($map[0] == 'detail') {
					$tempRow[$header[$key]] = form_render::action_detail($map[1], $row[$map[2]], $map[3]);
				} else if ($map[0] == 'detail_form') {
					$tempRow[$header[$key]] = form_render::action_detail_form($row[$map[1]], $map[2], $row[$map[3]]);
				} else if ($map[0] == 'action_redirect') {
					if (isset($map[5]))
						$tempRow[$header[$key]] = form_render::action_redirect_url($map[1], $map[2] . $map[3][0] . $row[$map[3][1]] . $map[4][0] . $row[$map[4][1]]
						//, $row[$map[5][0]]
						);
					else 
						$tempRow[$header[$key]] = form_render::action_redirect_url($map[1], $map[2] . $map[3][0] . $row[$map[3][1]] . $map[4][0] . $row[$map[4][1]]);
				}  else if ($map[0] == 'direct') {
					$tempRow[$header[$key]] = $map[1];
				} else if ($map[0] == 'date') {
					$tempRow[$header[$key]] = string_tools::standardDateFormat($row[$map[1]]);
				}
			}
			$rowArray[] = $tempRow;
		}
		return $rowArray;
	}
	
	/**
	 * Check user authority to add and del
	 */
	public function user_authority($type = 'child') {
		$Command = new Axial_Command($this->Command->getControllerName(), 'add', array());
		
		$result['add_shortcut'] = '';
		$result['add'] = '';
		$result['del'] = '';
		$permission_aksi = new permission_aksi($Command);
		if ($permission_aksi->is_accessible_controller()) {
			$result['add_shortcut'] = web_constant::$AUTORITY_ADD_SHORTCUT;
			$result['add'] = web_constant::$AUTORITY_ADD;
		}
			
		$Command->setFunction('del');
		$permission_aksi = new permission_aksi($Command);
		if ($permission_aksi->is_accessible_controller()) {
			$result['del'] = web_constant::$AUTORITY_DEL;
		}
		
		if ($type == 'shortcut') {
			echo $result['add_shortcut'];
		} else if ($type == 'event') {
			if ($result['add'] != '')
				echo 1; // true
			else 
				echo 0; // false
		}else {
			echo $result['add'];
			echo $result['del'];
		}
	}

	/**
	 * generate array direct value
	 */
	protected function mapping_direct($value) {
		return array('direct',$value);
	}
	
	/**
	 * generate array direct id
	 */
	protected function mapping_show($id) {
		return array('show',$id);
	}
	
	/**
	 * generate array direct id
	 */
	protected function mapping_date($id) {
		return array('date',$id);
	}
	
	/**
	 * generate array edit icon
	 */
	protected function mapping_edit($id) {
		return array('edit',$id);
	}
	
	/**
	 * generate array detail link with icon detail
	 */
	protected function mapping_detail($title, $id, $controller) {
		return array('detail',$title, $id, $controller);
	}
	
	/**
	 * generate array detail form link with name linked
	 */
	protected function mapping_detail_form($id, $controller, $label) {
		return array('detail_form', $id, $controller, $label);
	}
	
	/**
	 * 
	 * generate array mapping
	 * @param $title : alt and title in tag <a>
	 * @param $path : url path
	 * @param $arr_nama_obj : array('?nama=','nama_obj')
	 * @param $arr_id_obj : array('&obj=','id_obj')
	 */
	protected function mapping_action_redirect($title,$path,$arr_nama_obj,$arr_id_obj,$label="") {
		return array('action_redirect',$title,$path,$arr_nama_obj,$arr_id_obj,$label);
	}
	
	/**
	 * 
	 * Mendapatkan query user dan role dari user
	 */	
	protected function get_role_detail($is_ins_and=true) {
		require_once 'role_detail_aksi.php';
		$role_detail_aksi = new role_detail_aksi($this->Command);
		$query_role = $role_detail_aksi->get_query_role_detail();
		if ($is_ins_and)
			$query_role = (string_tools::is_not_empty_or_null($query_role)) ? " AND " . $query_role : "";

		return $query_role;
	}
	
	/**
	 * 
	 * Mendapatkan query user dan role dari user
	 */	
	protected function get_role_detail_organisasi($is_ins_and=true) {
		require_once 'role_detail_aksi.php';
		$role_detail_aksi = new role_detail_aksi($this->Command);
		$query_role = $role_detail_aksi->get_query_role_detail_org();
		if ($is_ins_and)
			$query_role = (string_tools::is_not_empty_or_null($query_role)) ? " AND " . $query_role : "";

		return $query_role;
	}
	
	/**
	 * 
	 * Untuk cek apakah deleted record ditampilkan atau tidak (show deleted recored)
	 * 
	 */
	protected function get_role_sdr() {
		require_once 'role_aksi.php';
		$role_aksi = new role_aksi($this->Command);
		$role = $role_aksi->getModelByUsername($this->Command->getUserLogged()->get_username());
		return $role->SHOW_DELETED_RECORD;
	}
	
	/**
	 * 
	 * Return tingkat_organisasi user logged
	 */
	protected function get_tingkat_org_role() {
		include_once 'role_aksi.php';
		$role_aksi = new role_aksi($this->Command);
		$role = $role_aksi->getModelByUsername($this->Command->getUserLogged()->get_username());
		return $role->TINGKAT_ORGANISASI;
	}
	
	/**
	 * 
	 * Untuk filter laporan biodata
	 * @param String $input_name : nama element input, bisa ditambahkan '[]' untuk array
	 */
	protected function _get_menu_filter($input_name) {
		$this->model->set_order_method("ASC");
		$rows = $this->svc->select($this->model);
		$menu_filter = array();
		$menu_filter['name'] = $input_name;
		$menu_filter['input'] = array();

		foreach ($rows as $row) {
			$input_filter = array();
			$input_filter['id'] = $row[0]; // id
			$input_filter['label'] = $row[1]; // nama
			$menu_filter['input'][] = $input_filter;
		}
		return form_render::menu_filter_render($menu_filter);
	}
}