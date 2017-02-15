<?php
include_once  "WEB-INF/controller/base_controller.php";

class jenis_pengajian_detail_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Jenis Pengajian Detail";
		parent::__construct("jenis_pengajian_detail",$command);
	}
	
	public function getList() {
		$this->model = $this->createModel();
		$this->model->set_jenis_pengajian($_GET['jenis_pengajian']);
		include_once 'status_sambung_aksi.php';
		$status_sambung_aksi = new status_sambung_aksi($this->Command);
		$rows = $status_sambung_aksi->status_sambung_selected($this->model);
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
			$this->svc->execute_query('delete from jenis_pengajian_detail where status_sambung='. $this->model->get_status_sambung() . ' and jenis_pengajian=' . $this->model->get_jenis_pengajian());
			$result[messageBox] = message_box::valid_box("$deleteCount data berhasil dihapus.");
			$result[error] = false;
		} catch (Exception $e) {
			$result[messageBox] = $e->getMessage();
			$result[error] = true;
		}
		
		echo json_encode($result);
	}
	
	public function getStatusSambung($jenis_pengajian) {
		$this->model->set_jenis_pengajian($jenis_pengajian);
		return $this->svc->select($this->model);
	}
}
?>