<?php
include_once "WEB-INF/controller/base_controller.php";

class role_detail_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Role Detail";
		parent::__construct("role_detail",$command);
	}
		
	public function add() {
		$this->model = $this->createModel();
		$result = array();
		// delete all before insert
		$listId = $_POST['role'];
		$this->model = $this->createModel();
		$this->_del($listId, $this->model);
		
		try {
			$listOrg = array();
			if (string_tools::is_not_empty_or_null($_POST['organisasi'])) {
				$listOrg = $_POST['organisasi'];
			}
			
			$this->model->set_role($_POST['role'][0]);
			foreach ($listOrg as $org) {
				$this->model->set_organisasi($org);
				$this->svc->save($this->model);
			}
			$result[messageBox] = message_box::valid_box($this->titleClass . " berhasil disimpan!");
			$result[error] = false;
		} catch (Exception $e) {
			$result[messageBox] = $e->getMessage();
			$result[error] = true;
		}
				
		echo json_encode($result);
	}
	
	public function getById() {
		$this->model = new role_detail();
		$this->model->set_role($_POST['id']);
		
		require_once 'role_aksi.php';
		$role_aksi = new role_aksi($this->Command);
		$role = $role_aksi->getModelById($_POST['id']);
		$tingkat_organisasi = $role->TINGKAT_ORGANISASI;
		
		/**
		 * 1 : pusat // bypass
		 * 2 : daerah
		 * 3 : desa
		 * 4 : kelompok
		 */
		if ($tingkat_organisasi == 2)
			$this->model->set_select_full_prefix("select role, organisasi, nama_daerah nama from role_detail left join daerah on role_detail.organisasi=daerah.id_daerah");
		else if ($tingkat_organisasi == 3)
			$this->model->set_select_full_prefix("select role, organisasi, nama_desa nama from role_detail left join desa on role_detail.organisasi=desa.id_desa");
		else if ($tingkat_organisasi == 4)
			$this->model->set_select_full_prefix("select role, organisasi, nama_kelompok nama from role_detail left join kelompok on role_detail.organisasi=kelompok.id_kelompok");
		else if ($tingkat_organisasi == 1);
		
		$role_details = $this->svc->select_model($this->model);
		
		$list_organisasi = array();
		foreach ($role_details as $role_detail) {
			$organisasi = array();
			$organisasi['id'] = $role_detail->organisasi;
			$organisasi['nama'] = $role_detail->nama;
			$list_organisasi[] = $organisasi;
		}
		
		$result = array("organisasi" => $list_organisasi);
		echo json_encode($result);
	}
	
	/**
	 * 1 : pusat // bypass
	 * 2 : daerah
	 * 3 : desa
	 * 4 : kelompok
	 */
	public function getAutocomplete() {
		require_once 'role_aksi.php';
		$role_aksi = new role_aksi($this->Command);
		$role = $role_aksi->getModelById($_GET['role']);
		$tingkat_organisasi = $role->TINGKAT_ORGANISASI;
		$organisasi = null;
		if ($tingkat_organisasi == 2) {
			require_once 'daerah_aksi.php';
			$organisasi = new daerah_aksi($this->Command);
		} else if ($tingkat_organisasi == 3) {
			require_once 'desa_aksi.php';
			$organisasi = new desa_aksi($this->Command);
		} else if ($tingkat_organisasi == 4) {
			require_once 'kelompok_aksi.php';
			$organisasi = new kelompok_aksi($this->Command);
		} else if ($tingkat_organisasi == 1) {;}
		
		$organisasi->getAutocomplete();
	}
	
	/**
	 * 
	 * 1 : pusat // bypass
	 * 2 : daerah
	 * 3 : desa
	 * 4 : kelompok
	 */
	public function get_query_org($tingkat_organisasi, $organisasi) {
		$controller = $this->Command->getControllerName();
		if ($tingkat_organisasi == 2) {
			$query = " id_daerah in (" . $organisasi . ") ";
		} else if ($tingkat_organisasi == 3) {
			if ($controller == 'daerah') {
				require_once 'desa_aksi.php';;
				$desa_aksi = new desa_aksi($this->Command);
				$query = " id_daerah in (" . $desa_aksi->get_list_daerah($organisasi) . ") ";
			} else {
				$query = " id_desa in (" . $organisasi . ") ";
			} 
		} else if ($tingkat_organisasi == 4) {
			if ($controller == 'daerah') {
				require_once 'kelompok_aksi.php';;
				$kel_aksi = new kelompok_aksi($this->Command);
				$query = " id_daerah in (" . $kel_aksi->get_list_daerah($organisasi) . ") ";
			} else if ($controller == 'desa') {
				require_once 'kelompok_aksi.php';;
				$kel_aksi = new kelompok_aksi($this->Command);
				$query = " id_desa in (" . $kel_aksi->get_list_desa($organisasi) . ") ";
			} else {
				$query = " id_kelompok in (" . $organisasi . ") ";
			}
		}  else if ($tingkat_organisasi == 1) {;}	//bypass pusat (grant to all)
		
		return $query;
	}
	
	/**
	 * call from base controller 
	 */
	public function get_query_role_detail() {
		require_once 'role_aksi.php';
		$role_aksi = new role_aksi($this->Command);

		$role = $role_aksi->getModelByUsername($this->Command->getUserLogged()->get_username());
		$tingkat_organisasi = $role->TINGKAT_ORGANISASI;
		$this->model = new role_detail();
		$this->model->set_role($role->ID_ROLE);
		$role_details = $this->svc->select_model($this->model);
		$list_id = array();
		foreach ($role_details as $r_d) {
			$list_id[] = $r_d->ORGANISASI;
		}
		
		$this->log->logInfo('Tingkat Org -> ' . $tingkat_organisasi . ' Controller -> ' . $this->Command->getControllerName() . " :: Function -> " . $this->Command->getFunction());
		
		// handler if list_id isnull
		if (count($list_id) != 0)
			$id = implode(",", $list_id);
		else 
			$id = 00;
		return $this->get_query_org($tingkat_organisasi, $id);
	}
	
	/**
	 * call from base controller 
	 *  
	 * 1 : pusat // bypass
	 * 2 : daerah
	 * 3 : desa
	 * 4 : kelompok
	 */
	public function get_query_role_detail_org() {
		$query = "";
		require_once 'role_aksi.php';
		$role_aksi = new role_aksi($this->Command);

		$role = $role_aksi->getModelByUsername($this->Command->getUserLogged()->get_username());
		$tingkat_organisasi = $role->TINGKAT_ORGANISASI;
		$this->model = new role_detail();
		$this->model->set_role($role->ID_ROLE);
		$role_details = $this->svc->select_model($this->model);
		$list_id = array();
		foreach ($role_details as $r_d) {
			$list_id[] = $r_d->ORGANISASI;
		}
		
		// handler if list_id isnull
		if (count($list_id) != 0)
			$id = implode(",", $list_id);
		else 
			$id = 00;
		
		if ($tingkat_organisasi == 2) {
			$query = " tingkat_organisasi=2 and organisasi in (" . $id . ") ";
		} else if ($tingkat_organisasi == 3) {
			$query = " tingkat_organisasi=3 and organisasi in (" . $id . ") "; 
		} else if ($tingkat_organisasi == 4) {
			$query = " tingkat_organisasi=4 and organisasi in (" . $id . ") ";
		}  else if ($tingkat_organisasi == 1) {;}	//bypass pusat (grant to all)
		
		return $query;
	}
	
	/**
	 * 
	 * get list organisasi detail
	 * @return array('tingkat_organisasi','organisasi') id organisasi berdasarkan role user logged
	 */
	public function get_list_org() {
		require_once 'role_aksi.php';
		$role_aksi = new role_aksi($this->Command);

		$role = $role_aksi->getModelByUsername($this->Command->getUserLogged()->get_username());
		$tingkat_organisasi = $role->TINGKAT_ORGANISASI;
		$this->model = new role_detail();
		$this->model->set_role($role->ID_ROLE);
		$role_details = $this->svc->select_model($this->model);
		$list_id = array();
		foreach ($role_details as $r_d) {
			$list_id[] = $r_d->ORGANISASI;
		}
		
		$result['tingkat_organisasi'] = $tingkat_organisasi;
		$result['organisasi'] = $list_id;
		return $result;
	}
}