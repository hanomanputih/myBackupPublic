<?php
include_once  "WEB-INF/controller/base_controller.php";

class masjid_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Masjid";
		parent::__construct("masjid",$command);
	}
	
	public function add() {
		$this->model = $this->createModel();
		
		if (!isset($_POST['masjid_desa']))
			$this->model->set_masjid_desa('0');
		
		if (!isset($_POST['masjid_daerah']))
			$this->model->set_masjid_daerah('0');
			
		echo $this->_add($this->model);
	}
	
	public function edt() {
		$this->model = $this->createModel();
		
		if (!isset($_POST['masjid_desa']))
			$this->model->set_masjid_desa('0');
		
		if (!isset($_POST['masjid_daerah']))
			$this->model->set_masjid_daerah('0');
		
		echo $this->_edt($this->model);
	}
		
	public function getList() {
		$this->model->set_order_column("ID_MASJID");
		$this->model->set_order_method("ASC");
		$header = array("Masjid","Alamat","Detail","Edit");
		$listMap = array(
					 $this->mapping_show('NAMA_MASJID'),
					 $this->mapping_show('ALAMAT'),
					 $this->mapping_detail('Detail Masjid', 'ID_MASJID', 'masjid'),
					 $this->mapping_edit('ID_MASJID')
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('nama_masjid','masjid_daerah','masjid_desa','alamat','geo','telepon','mobile','web','email','desc_masjid');
		$this->_getById($field);
	}
	
	public function detail() {
		$header = array("Nama Masjid","Masjid Desa","Masjid Daerah","Alamat","Geo","Telepon","Mobile","Web","Email","Keterangan");
		$listMap = array(
					 $this->mapping_show('NAMA_MASJID'),
					 $this->mapping_show('MASJID_DESA'),
					 $this->mapping_show('MASJID_DAERAH'),
					 $this->mapping_show('ALAMAT'),
					 $this->mapping_show('GEO'),
					 $this->mapping_show('TELEPON'),
					 $this->mapping_show('MOBILE'),
					 $this->mapping_show('WEB'),
					 $this->mapping_show('EMAIL'),
					 $this->mapping_show('DESC_MASJID'),
					 );
		$this->_detail($header, $listMap);
	}
	
	private function intToStrBoolId($int) {
		return $int == '1' ? 'Ya' : 'Bukan';
	}
	
	/**
	 * generate html from mapping
	 */
	protected function generate_html_map($rows,$listMap,$header) {
		$rowArray = array();
		foreach ($rows as $row) {
			$tempRow = array();			
			$tempRow['ID'] = $row[0];
			
			foreach ($listMap as $key => $map) {
				if ($map[0] == 'show') {
					if ($header[$key] == 'Masjid Daerah' or $header[$key] == 'Masjid Desa')
						$tempRow[$header[$key]] = $this->intToStrBoolId($row[$map[1]]);
					else 
						$tempRow[$header[$key]] = $row[$map[1]];
				} else if ($map[0] == 'edit') {
					$tempRow[$header[$key]] = form_render::action_edit($row[$map[1]]);
				} else if ($map[0] == 'detail') {
					$tempRow[$header[$key]] = form_render::action_detail($map[1], $row[$map[2]], $map[3]);
				} else if ($map[0] == 'detail_form') {
					$tempRow[$header[$key]] = form_render::action_detail_form($row[$map[1]], $map[2], $row[$map[3]]);
				} else if ($map[0] == 'action_redirect') {
					$tempRow[$header[$key]] = form_render::action_redirect_url($map[1], $map[2] . $map[3][0] . $row[$map[3][1]] . $map[4][0] . $row[$map[4][1]]);
				} 
			}
			$rowArray[] = $tempRow;
		}
		return $rowArray;
	}
}
?>