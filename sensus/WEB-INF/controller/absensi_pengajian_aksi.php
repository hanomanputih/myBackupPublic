<?php
include_once  "WEB-INF/controller/base_controller.php";

class absensi_pengajian_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Peserta";
		parent::__construct("absensi_pengajian",$command);
	}
		
	public function getList() {
		$qJk = null;
		if ($_GET['jk'] == 'L')
			$qJk = ' and jenis_kelamin="L"';
		else if ($_GET['jk'] == 'P')
			$qJk = ' and jenis_kelamin="P"'; 
					
		$this->model->set_order_column("nama_lengkap");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable('nama_lengkap');
		$this->model->set_select_full_prefix("select id_absensi_pengajian, jamaah, nama_lengkap, jam_absen, kedatangan, nama_kedatangan from absensi_pengajian, jamaah, kedatangan");
		$this->model->set_select_full_suffix("id_jamaah=jamaah and id_kedatangan=kedatangan and pengajian=" . $_GET['pengajian'] . $qJk);
		$header = array("Jamaah","Jam Hadir","Kedatangan");
		$listMap = array();
		
		// check user authority to edit
		$temp_Command = $this->Command;
		$temp_Command->setFunction('edt');
		$permission_aksi = new permission_aksi($temp_Command);
		if (!$permission_aksi->is_accessible_controller()) {
			$listMap = array(
						 $this->mapping_detail_form('jamaah', getScriptUrl() . 'jamaah', 'nama_lengkap'),
						 array('show','jam_absen'),
						 array('show','nama_kedatangan')
						 );
		} else {		
			$listMap = array(
						 $this->mapping_detail_form('jamaah', getScriptUrl() . 'jamaah', 'nama_lengkap'),
						 array('input','jam_absen'),
						 array('radio','kedatangan')
						 );
		}
		
		$this->_getList($header,$listMap);
	}
		
	/**
	 * Membuat list table dan pagination
	 * @param $header, array list menu table
	 * @param $listMap, list mapping $header dan database
	 *  
	 * @uses controller /list.html
	 */
	protected function _getList($header, $listMap) {
		$searchKeyword = $_GET[keyword];		
		$pageNow = (isset($_GET[page])) ? $_GET[page] : 1;
		
		if (string_tools::is_not_empty_or_null($searchKeyword)) {
			$this->model->set_search_keyword($searchKeyword);
		}
		
		$start = ($pageNow * web_constant::$DEFAULT_PAGINATED_SIZE) - web_constant::$DEFAULT_PAGINATED_SIZE;
		
		$rows = $this->svc->select_paged($this->model, $start, web_constant::$DEFAULT_PAGINATED_SIZE);
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
	
	public function add() {
		$this->model = $this->createModel();
		if (string_tools::is_not_empty_or_null($_POST['jamaah']))
			$message = $this->_add($this->model);
		else {
			$result[messageBox] = message_box::error_box('Tidak ada jamaah yang diinput');
			$result[error] = true;
			$message = json_encode($result);
		}
		echo $message;
	}
	
	/**
	 * generate html from mapping
	 * 
	 * @param $tempRow['ID'] -> return checkbox whitin id ID
	 * @param $tempRow['index'] -> return value index
	 */
	protected function generate_html_map($rows,$listMap,$header) {
		include_once 'kedatangan_aksi.php';
		$ked_aksi = new kedatangan_aksi($this->Command);
		$paired_keds = $ked_aksi->getPairedKedatangan();
		$rowArray = array();

		foreach ($rows as $row) {
			$tempRow = array();			
			$tempRow['ID'] = $row[0];
			
			foreach ($listMap as $key => $map) {
				if ($map[0] == 'show') {
					$tempRow[$header[$key]] = $row[$map[1]];
				} else if ($map[0] == 'detail_form') {
					$tempRow[$header[$key]] = form_render::action_detail_form($row[$map[1]], $map[2], $row[$map[3]]);
				} else if ($map[0] == 'radio') {
					$radio = "<div>";
					foreach ($paired_keds as $value) {
						$isChecked = ($value['id']==$row[$map[1]]) ? "checked=\"checked\"" : "";
						$radio .= "<input type=\"radio\" onchange=\"javascript:update_absen('kedatangan', " . $row[0] . ", " . $value['id'] . ")\" name=\"kedatangan" . $row[0] . "\" id=\"kedatangan" . $row[0] . $value['id'] . "\"" . $isChecked . "/><label for=\"kedatangan" . $row[0] . $value['id'] . "\" class=\"opt\">" . $value['value'] . "</label>" . "&nbsp";
					}
					$radio .= "</div>";
					$tempRow[$header[$key]] = $radio;
				} else if ($map[0] == 'input') {
					$tempRow[$header[$key]] = '<input class="tgl" name="' . $row[0] . '" id="' . $row[0] . '" type="text" size="6" value="' . $row[$map[1]] . '"/>';
				}
			}
			$rowArray[] = $tempRow;
		}
		return $rowArray;
	}

	private function getModelById($id) {
		$this->model->set_id_absensi_pengajian($id);
		$result = $this->svc->select_model($this->model);
		return $result[0];
	}
	
	public function edt() {
		$model = $this->getModelById($_POST['id']);
		$this->model->set_id_absensi_pengajian($model->ID_ABSENSI_PENGAJIAN);
		$this->model->set_jamaah($model->JAMAAH);
		$this->model->set_pengajian($model->PENGAJIAN);
		
		if ($_POST['field'] == 'kedatangan')
			$this->model->set_kedatangan($_POST['newVal']);
		else 
			$this->model->set_kedatangan($model->KEDATANGAN);

		if ($_POST['field'] == 'jam_absen')
			$this->model->set_jam_absen($_POST['newVal']);
		else 
			$this->model->set_jam_absen($model->JAM_ABSEN);
		
		echo $this->_edt($this->model);
	}
	
	/**
	 * 
	 * @param id_pengajian $pengajian
	 */
	public function del_absen($pengajian) {
		$result = array();
		try {
			$this->svc->execute_query('delete from absensi_pengajian where pengajian=' . $pengajian);
			$result[messageBox] = message_box::valid_box("Data berhasil dihapus.");
			$result[error] = false;
		} catch (Exception $e) {
			$result[messageBox] = message_box::error_box($e->getMessage());
			$result[error] = true;
		}
		return $result;
	}
	
	/**
	 * @param pengajian : object pengajian
	 */
	public function add_absen($pengajian) {
		$this->model->set_pengajian($pengajian->get_id_pengajian());
		list($tgl,$jam) = explode(' ',$pengajian->get_tanggal_pengajian());
		$this->model->set_jam_absen($jam);
		// hardcode to 'hadir', id 2
		$this->model->set_kedatangan('2');
		
		include_once 'jamaah_aksi.php';
		$jamaah_aksi = new jamaah_aksi($this->Command);
		
		include_once 'jenis_pengajian_detail_aksi.php';
		$jpda = new jenis_pengajian_detail_aksi($this->Command);
		$jpds = $jpda->getStatusSambung($pengajian->get_jenis_pengajian());
		$list_ss = array();
		foreach ($jpds as $ss) {
			$list_ss[] = $ss['STATUS_SAMBUNG'];
		}
		
		include_once 'role_detail_aksi.php';
		$role_detail_aksi = new role_detail_aksi($this->Command);
		$queryOrgLev = $role_detail_aksi->get_query_org($pengajian->get_tingkat_organisasi(), $pengajian->get_organisasi());

		$jamaahs = $jamaah_aksi->getJamaahByOrg($queryOrgLev, $list_ss);
		foreach ($jamaahs as $jamaah) {
			$this->model->set_jamaah($jamaah->id_jamaah);
			$this->_add($this->model);
		}
	}
	
	/**
	 * call from viewer
	 */
	protected function get_kedatangan_opt() {
		include_once 'kedatangan_aksi.php';
		$ked_aksi = new kedatangan_aksi($this->Command);
		return $ked_aksi->getRadioKedatangan();
	}
	
	/**
	 * 
	 * get model absensi pengajian by array id_pengajian
	 * @param array $id_pengajian
	 */
	public function getAbsensiByPengajian($id_pengajian) {
		if (count($id_pengajian) == 0)
			$id_pengajian = array();
		$q = implode(',', $id_pengajian);
		$this->model->set_order_column("nama_kedatangan");
		$this->model->set_select_full_prefix('select nama_kedatangan, count(nama_kedatangan) absen from absensi_pengajian, kedatangan');
		$this->model->set_select_full_suffix('id_kedatangan=kedatangan and pengajian in (' . $q . ') group by nama_kedatangan');
		return $this->svc->select_model($this->model);
	}
	
	public function detail() {
		$this->model->set_order_column("nama_lengkap");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable('nama_lengkap');
		$this->model->set_select_full_prefix("select jamaah, nama_lengkap, jam_absen, kedatangan, nama_kedatangan from absensi_pengajian, jamaah, kedatangan");
		$this->model->set_select_full_suffix("id_jamaah=jamaah and id_kedatangan=kedatangan and pengajian=" . $_POST['id']);
		
		$rows = $this->svc->select($this->model);
		$rowCount = count($rows);
		$header = array('Nama','Keterangan');
		$listMap = array(
						 $this->mapping_show('nama_lengkap'),
						 $this->mapping_show('nama_kedatangan')
						 );
		
		$rowArray = $this->generate_html_map_detail($rows,$listMap,$header);
		$arrayItem = array("header"=>$header,"rows"=>$rowArray["rows"],"footer"=>"$rowCount Jamaah, " . $rowArray["kehadiran"]);
		$json_result = json_encode($arrayItem);
			
		echo form_render::render_json($json_result);
	}
	
	/**
	 * generate html from mapping detail
	 * 
	 */
	protected function generate_html_map_detail($rows,$listMap,$header) {
		include_once 'kedatangan_aksi.php';
		$rowArray = array();

		$idx = 1;
		$kehCount = array();
		foreach ($rows as $row) {
			if (array_key_exists($row['nama_kedatangan'], $kehCount))
				$kehCount[$row['nama_kedatangan']]++;
			else
				$kehCount[$row['nama_kedatangan']] = 1;
			
			$tempRow = array();			
			$tempRow['index'] = $idx++;
			
			foreach ($listMap as $key => $map) {
				if ($map[0] == 'show') {
					$tempRow[$header[$key]] = $row[$map[1]];
				}
			}
			$rowArray[] = $tempRow;
			$kehadiran = "";
			foreach ($kehCount as $key => $value) {
				$kehadiran .= $value . " " . $key . " ";
			}
			
			$result["rows"] = $rowArray;
			$result["kehadiran"] = $kehadiran;
		}
		return $result;
	}
	
}
?>