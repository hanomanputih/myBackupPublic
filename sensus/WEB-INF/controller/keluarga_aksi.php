<?php
include_once "WEB-INF/controller/base_controller.php";

class keluarga_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Keluarga";
		parent::__construct("keluarga",$command);
	}

	public function getList() {
		$this->model->set_order_by("kepala_keluarga");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable("kepala_keluarga");
		$this->model->set_select_full_prefix("select id_keluarga,kelompok,nama_kelompok,kepala_keluarga,suami,(select nama_lengkap from jamaah where jamaah.id_jamaah=suami) nama_suami,istri,(select nama_lengkap from jamaah where jamaah.id_jamaah=istri) nama_istri from keluarga,kelompok,desa,daerah");
		$this->model->set_select_full_suffix("id_kelompok=kelompok and id_desa=desa and id_daerah=daerah" . $this->get_role_detail());

		$header = array("Kepala Keluarga","Kelompok","Suami","Istri","Anak","Edit");
		$listMap = array(
		$this->mapping_show('kepala_keluarga'),
		$this->mapping_detail_form('kelompok','kelompok','nama_kelompok'),
		$this->mapping_detail_form('suami','jamaah','nama_suami'),
		$this->mapping_detail_form('istri','jamaah','nama_istri'),
		$this->mapping_anak('id_keluarga'),
		$this->mapping_edit('id_keluarga')
		);
		$this->_getList($header,$listMap);
	}
	
	public function add() {
		$this->model = $this->createModel();
		$result = $this->_add_and_get_id($this->model);
		
		include_once 'anak_aksi.php';
		$anak_aksi = new anak_aksi($this->Command);
		if (isset($_POST['anak']))
			$anak_aksi->replace($result['id'], $_POST['anak']);
		
		unset($result['id']);
		echo json_encode($result);
	}
	
	public function edt() {
		include_once 'anak_aksi.php';
		$anak_aksi = new anak_aksi($this->Command);
		$this->model = $this->createModel();
		if (isset($_POST['anak']))
			$anak_aksi->replace($this->model->get_id_keluarga(), $_POST['anak']);
		echo $this->_edt($this->model);
	}
	
	public function del() {
		$listId = $_POST[id];
		
		require_once 'anak_aksi.php';
		$anak_aksi = new anak_aksi($this->Command);
		$anak_aksi->del_list($listId);
		
		$this->model = $this->createModel();
		echo $this->_del($listId, $this->model);
	}
	
	/**
	 * generate array anak
	 * @param $id : id_keluarga
	 */
	protected function mapping_anak($id) {
		return array('anak',$id);
	}
	
	/**
	 * generate html from mapping
	 */
	protected function generate_html_map($rows,$listMap,$header) {
		include_once 'anak_aksi.php';
		$anak_aksi = new anak_aksi($this->Command);
		
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
					$tempRow[$header[$key]] = form_render::action_redirect_url($map[1], $map[2] . $map[3][0] . $row[$map[3][1]] . $map[4][0] . $row[$map[4][1]]);
				}  else if ($map[0] == 'direct') {
					$tempRow[$header[$key]] = $map[1];
				} else  if ($map[0] == 'anak') {
					$tempRow[$header[$key]] = $anak_aksi->getList($row[$map[1]]);
				}
			}
			$rowArray[] = $tempRow;
		}
		return $rowArray;
	}

	public function getById() {
		$this->model = $this->createModel();
		$this->model->set_select_full_prefix("select id_keluarga,kelompok,kepala_keluarga,suami,(select nama_lengkap from jamaah where keluarga.SUAMI=jamaah.ID_JAMAAH) nama_suami,istri,(select nama_lengkap from jamaah where keluarga.ISTRI=jamaah.ID_JAMAAH) nama_istri from keluarga");
		$field = array("kelompok","kepala_keluarga","suami","nama_suami","istri","nama_istri");
		$this->_getById($field);
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
		
		include_once 'anak_aksi.php';
		$anak_aksi = new anak_aksi($this->Command);
		$result['anak'] = $anak_aksi->getSelectEdit($this->model->get_id_keluarga());
		echo json_encode($result);
	}
}
?>