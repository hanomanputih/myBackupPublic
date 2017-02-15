<?php
include_once "WEB-INF/controller/base_controller.php";

class jenis_event_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Jenis Event";
		parent::__construct("jenis_event",$command);
	}
	
	public function getList() {
		$header = array("Jenis Event","Warna","Deskripsi","Edit");
		$listMap = array(
					 $this->mapping_show('NAMA_JENIS_EVENT'),
					 array('color'),
					 $this->mapping_show('DESC_JENIS_EVENT'),
					 $this->mapping_edit('ID_JENIS_EVENT')
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array("nama_jenis_event","color","bordercolor","textcolor","desc_jenis_event");
		$this->_getById($field);
	}
	
	public function getSelect() {
		$this->model->set_order_column("nama_jenis_event");
		$this->_getSelect();
	}
	
	private function get_div_color($col,$borCol,$texCol) {
		$divCol = '<div class="colorPicker-swatch" style="background-color: ' . $col . '; border-color: ' . $borcol . '; color: ' . $texCol . ';" align="center">A</div>';
		return $divCol;
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
					$tempRow[$header[$key]] = $row[$map[1]];
				} else if ($map[0] == 'edit') {
					$tempRow[$header[$key]] = form_render::action_edit($row[$map[1]]);
				} else if ($map[0] == 'detail') {
					$tempRow[$header[$key]] = form_render::action_detail($map[1], $row[$map[2]], $map[3]);
				} else if ($map[0] == 'detail_form') {
					$tempRow[$header[$key]] = form_render::action_detail_form($row[$map[1]], $map[2], $row[$map[3]]);
				} else if ($map[0] == 'action_redirect') {
					$tempRow[$header[$key]] = form_render::action_redirect_url($map[1], $map[2] . $map[3][0] . $row[$map[3][1]] . $map[4][0] . $row[$map[4][1]]);
				} else if ($map[0] == 'color') {
					$tempRow[$header[$key]] = $this->get_div_color($row['COLOR'],$row['BORDERCOLOR'],$row['TEXTCOLOR']);
				} 
			}
			$rowArray[] = $tempRow;
		}
		return $rowArray;
	}
}	
?>