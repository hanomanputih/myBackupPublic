<?php
include_once "WEB-INF/controller/base_controller.php";

class event_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Event";
		parent::__construct("event",$command);
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
				
		if (isset($_POST['st_date']) and isset($_POST['st_time']))
			$this->model->set_start_event($_POST['st_date'] . " " . $_POST['st_time']);
		if (isset($_POST['en_date']) and isset($_POST['en_time']))
			$this->model->set_end_event($_POST['en_date'] . " " . $_POST['en_time']);
	
		$this->model->set_tingkat_organisasi_visible($_POST['tingkat_organisasi']);
		$this->model->set_tingkat_organisasi_create($this->get_tingkat_org_role());
		
		include_once 'role_detail_aksi.php';
		$rda = new role_detail_aksi($this->Command);
		$id_first = $rda->get_list_org();
		$this->model->set_organisasi_create($id_first['organisasi'][0]);
		$this->model->set_organisasi_visible($_POST['organisasi']);
		return $this->model;
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
				//$this->svc->delete($model);
				$result[messageBox] = "Event berhasil dihapus";
				$result[error] = false;
			} catch (Exception $e) {
				$result[messageBox] = $e->getMessage();
				$result[error] = true;
			}
		} else{
			$result[messageBox] = 'Tidak ada data yang tercentang!';
			$result[error] = true;
		}
		
		echo json_encode($result);
	}
	
	public function fullCal() {
		$start = date("Y-m-d",$_GET[start]);
		$end = date("Y-m-d",$_GET[end]);
				
		$this->model = new event();
		//$this->model->set_id_event($_GET[id]);
		$this->model->set_select_full_prefix("select id_event,nama_event,start_event,end_event,color,bordercolor,textcolor,allday_event from event,jenis_event");
		$this->model->set_select_full_suffix("id_jenis_event=jenis_event and end_event > DATE('$start') and start_event < DATE('$end')");
		
		/*
		 * color : background
		 * textColor : text Color
		 * borderColor : border color
		 */
		$header = array("title","start","end","url","allDay","color","borderColor","textColor");
		
		$rows = $this->svc->select($this->model);
		$rowCount = count($rows);
		
		$rowArray = array();
		if ($rowCount != 0) {
			foreach ($rows as $row)
			{
				$rowArray[]  = array("id"=>$row[0],
									 $header[0] => $row['nama_event'],
									 $header[1] => $row['start_event'],
									 $header[2] => $row['end_event'],
									 $header[3] => "javascript:detailForm(" . $row['id_event'] . ",'event');",
									 $header[4] => string_tools::intToBool($row['allday_event']),
									 $header[5] => $row['color'],
									 $header[6] => $row['bordercolor'],
									 $header[7] => $row['textcolor']
									); 
			}
		}
		
		include_once 'pengajian_aksi.php';
		$penAksi = new pengajian_aksi($this->Command);
		$rows = array();
		$rows = $penAksi->fulCal($start,$end);
		$rowCount = count($rows);
		
		if ($rowCount != 0) {
			foreach ($rows as $row)
			{
				$rowArray[]  = array("id"=>$row[0],
									 $header[0] => $row['nama_jenis_pengajian'],
									 $header[1] => $row['tanggal_pengajian'],
									 $header[2] => $row['tanggal_pengajian'],
									 $header[3] => "javascript:detailForm(" . $row['id_pengajian'] . ",'pengajian');",
									 $header[4] => string_tools::intToBool(0),
									 $header[5] => $row['color'],
									 $header[6] => $row['bordercolor'],
									 $header[7] => $row['textcolor']
									); 
			}
		}

		$json_result = json_encode($rowArray);
		echo $json_result;
	}
		
	public function getById() {
		$this->model = $this->createModel();
		$this->model->set_select_full_prefix("select id_event,nama_event,jenis_event,start_event,end_event,allday_event,tingkat_organisasi_visible,organisasi_visible,desc_event from event");
		$field = array("nama_event","jenis_event","start_event","end_event","allday_event","tingkat_organisasi_visible","organisasi_visible","desc_event");
		$this->_getById($field);
	}
	
	public function detail() {
		$this->model = new event();
		$this->model->set_id_event($_POST['id']);
		$this->model->set_select_full_prefix("select id_event,nama_event,concat((select nama_tingkat_organisasi from tingkat_organisasi where id_tingkat_organisasi=tingkat_organisasi_create),' ', case tingkat_organisasi_create when 2 then (select nama_daerah from daerah where id_daerah=organisasi_create) when 3 
												then (select nama_desa from desa where id_desa=organisasi_create) when 4 then (select nama_kelompok from kelompok where id_kelompok=organisasi_create) END) nama_org_create,
												concat((select nama_tingkat_organisasi from tingkat_organisasi where id_tingkat_organisasi=tingkat_organisasi_visible),' ', case tingkat_organisasi_visible when 2 then (select nama_daerah from daerah where id_daerah=organisasi_visible) when 3 then (select nama_desa from desa where id_desa=organisasi_visible) 
												when 4 then (select nama_kelompok from kelompok where id_kelompok=organisasi_visible) END) nama_org_visible ,jenis_event,nama_jenis_event,start_event,
												end_event,allday_event,desc_event from event,jenis_event");
		$this->model->set_select_full_suffix("id_jenis_event=jenis_event");
		$header = array("Event","Jenis Event","Dibuat oleh","Tanggal Mulai","Tanggal Selesai","Tempat Acara","Deskripsi");
		$listMap = array(
					 $this->mapping_show('nama_event'),
					 $this->mapping_show('nama_jenis_event'),
					 $this->mapping_show('nama_org_create'),
					 $this->mapping_show('start_event'),
					 $this->mapping_show('end_event'),
					 $this->mapping_show('nama_org_visible'),
					 $this->mapping_show('desc_event')
					 );
					 
		$opt = array();
		// check data authority to edit or delete
		$tmp_event = new event();
		$tmp_event->set_id_event($_POST['id']);
		$tmp_e_m = $this->svc->select($tmp_event);
		include_once 'role_detail_aksi.php';
		$rda = new role_detail_aksi($this->Command);
		$list_org = $rda->get_list_org();
		if (($list_org['tingkat_organisasi'] == 1) or (($tmp_e_m[0]['TINGKAT_ORGANISASI_CREATE'] == $list_org['tingkat_organisasi']) and (in_array($tmp_e_m[0]['ORGANISASI_CREATE'], $list_org['organisasi'])))) {
			// check user authority to edit and delete
			$temp_Command = $this->Command;
			$temp_Command->setFunction('edt');
			$permission_aksi = new permission_aksi($temp_Command);
			if ($permission_aksi->is_accessible_controller()) {
				$opt['left'] = '<div class="button" id="uniform-submit" style="-moz-user-select: none;"><span onclick="javascript:edit_form(' . $_POST['id'] . ')">edit</span></div>';
			}
			$temp_Command->setFunction('del');
			$permission_aksi = new permission_aksi($temp_Command);
			if ($permission_aksi->is_accessible_controller()) {
				$opt['right'] = '<div class="button" id="uniform-submit" style="-moz-user-select: none;"><span onclick="javascript:deleteEvent(' . $_POST['id'] . ')">delete</span></div>';
			}
		}
		
		$this->_detail($header,$listMap,false,$opt);				
	}
	
	// called from viewer
	protected function tingkat_organisasi_opt() {
		$level = $this->get_tingkat_org_role();

		if ($level == 4) {
			$radio = "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\" checked=\"checked\"/><label for=\"kelompok\" class=\"opt\">Kelompok</label>";
		} else if ($level == 3) {
			$radio = "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\" checked=\"checked\"/><label for=\"kelompok\" class=\"opt\">Kelompok</label>";
			$radio .= "&nbsp;<input onchange=\"javascript:getSelectOptionsWithController('organisasi','desa')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"desa\" value=\"3\" checked=\"checked\"/><label for=\"desa\" class=\"opt\">Desa</label>";
		} else if ($level == 2) {
			$radio = "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\" checked=\"checked\"/><label for=\"kelompok\" class=\"opt\">Kelompok</label>";
			$radio .= "&nbsp;<input onchange=\"javascript:getSelectOptionsWithController('organisasi','desa')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"desa\" value=\"3\" /><label for=\"desa\" class=\"opt\">Desa</label>";
			$radio .= "&nbsp;<input onchange=\"javascript:getSelectOptionsWithController('organisasi','daerah')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"daerah\" value=\"2\" checked=\"checked\"/><label for=\"daerah\" class=\"opt\">Dearah</label>";
		} else if ($level == 1) {
			$radio = "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\" checked=\"checked\"/><label for=\"kelompok\" class=\"opt\">Kelompok</label>";
			$radio .= "&nbsp;<input onchange=\"javascript:getSelectOptionsWithController('organisasi','desa')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"desa\" value=\"3\" /><label for=\"desa\" class=\"opt\">Desa</label>";
			$radio .= "&nbsp;<input onchange=\"javascript:getSelectOptionsWithController('organisasi','daerah')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"daerah\" value=\"2\" /><label for=\"daerah\" class=\"opt\">Dearah</label>";
		}
		return $radio;
	}
}
?>