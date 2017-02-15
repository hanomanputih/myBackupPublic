<?php
include_once "WEB-INF/controller/base_controller.php";
	
class kedatangan_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Kedatangan";
		parent::__construct("kedatangan",$command);
	}

	public function getList() {
		$header = array("Kedatangan","Edit");
		$listMap = array(
					 $this->mapping_show(1),
					 $this->mapping_edit(0)
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('nama_kedatangan');
		$this->_getById($field);	
	}
	
	public function getRadioKedatangan($idChecked=00) {
		$kedatangas = $this->svc->select_model($this->model);
		foreach ($kedatangas as $ked) {
			$isChecked = ($ked->ID_KEDATANGAN==$idChecked) ? "checked=\"checked\"" : "";
			$radio .= "<input type=\"radio\" name=\"kedatangan\" id=\"kedatangan\" value=\"" . $ked->ID_KEDATANGAN . "\" " . $isChecked . "/><label for=\"kedatangan\" class=\"opt\">" . $ked->NAMA_KEDATANGAN . "</label>" . "&nbsp";
		}
		return $radio;
	}
	
	public function getPairedKedatangan() {
		$result = array();
		$kedatangas = $this->svc->select_model($this->model);
		foreach ($kedatangas as $ked) {
			$result[] = array("id"=>$ked->ID_KEDATANGAN,"value"=>$ked->NAMA_KEDATANGAN);
		}
		return $result;
	}
}
?>