<?php
include_once  "WEB-INF/controller/base_controller.php";

class laporan_absensi_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Pengajian";
		// override to controller pengajian
		parent::__construct("pengajian",$command);
	}
	
    function _default() {
    	$this->Command->setOption($this->get_menu_filter());
    	show_template_report($this->Command);
    }
    
	/**
	 * 
	 * route report
	 */
	public function getReport() {
		if ($_POST['rtype'] == 'table')
			$this->getList();
		else if ($_POST['rtype'] == 'summary')
			$this->getSummary();
		else if ($_POST['rtype'] == 'summonth')
			$this->getSummaryMonth();
	}
	
    private function implode_array_in($array) {
    	return implode("','",array_values($array));
    }

	private function create_model_filter() {
		$queryOpt = null;
		if (string_tools::is_not_empty_or_null($_POST['tanggal_pengajian'])) {
			$tgl = $_POST['tanggal_pengajian'];
			list($st,$en) = string_tools::between2Date($tgl);
			$queryOpt .= " AND (pengajian.tanggal_pengajian >= '" . $st . "' and pengajian.tanggal_pengajian < '" . $en . "')";
		}
		
		if (string_tools::is_not_empty_or_null($_POST['tingkat_organisasi'])) {
			$queryOpt .= " AND tingkat_organisasi=" . $_POST['tingkat_organisasi'];
		}
		
		if (string_tools::is_not_empty_or_null($_POST['organisasi'])) {
			$queryOpt .= " AND organisasi=" . $_POST['organisasi'];
		}
		
		return $queryOpt;
	}
	
	/**
	 * 
	 * Chart data series generator for summary pengajian
	 */
	protected function getSummary() {
		$result['rtype'] = 'chart';
		
		$jps = $_POST['jenis_pengajian'];
		//absensi pengajian
		include_once 'absensi_pengajian_aksi.php';
		$apa = new absensi_pengajian_aksi($this->Command);
		// jenis pengajian
		include_once 'jenis_pengajian_aksi.php';
		$jpa = new jenis_pengajian_aksi($this->Command);
		
		$this->model = new pengajian();
		$this->model->set_order_column("tgl_pengajian");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix("select id_pengajian, jenis_pengajian, DATE_FORMAT(tanggal_pengajian,('%d-%m-%Y %H:%i:%s')) tgl_pengajian from pengajian");
		
		foreach ($jps as $jp) {
			$this->model->set_select_full_suffix("jenis_pengajian=" . $jp . $this->create_model_filter());
			$obj_ps = $this->svc->select_model($this->model);
			$datas = array();
			
			foreach ($obj_ps as $obj_p) {
				$categories = string_tools::stringToTime($obj_p->tgl_pengajian);
				$obj_as = $apa->getAbsensiByPengajian(array($obj_p->id_pengajian));
				foreach ($obj_as as $obj_a) {
					  $datas[$obj_a->nama_kedatangan][] = (array($categories,intval($obj_a->absen)));
				}
			}
			
			$data = array();
			$pie = array();
			foreach ($datas as $key => $value) {
				$data[] = array('type'=>'column', 'name'=>$key,'data'=>$value);
				$val = 0;
				foreach ($value as $v) {
					$val += $v[1];
				}
				$pie[] = array('name'=>$key, 'y'=>$val);
			}
			$data[] = array('type'=>'pie','name'=>'Summary','data'=>$pie,'center'=>array(50,5),'size'=>80,'showInLegend'=>false,'dataLabels'=>array('enabled'=>false));
			$jpm = $jpa->getModelById($jp);
			$result['chart'][] = array("text"=>"Summary " . $jpm->NAMA_JENIS_PENGAJIAN, "series"=>$data);
		}
		header("Content-type: text/json");
		echo json_encode($result);	
	}
	
	/**
	 * 
	 * Chart data series generator for summary bulanan
	 */
	protected function getSummaryMonth() {
		$result['rtype'] = 'chart';
		
		$jps = $_POST['jenis_pengajian'];
		//absensi pengajian
		include_once 'absensi_pengajian_aksi.php';
		$apa = new absensi_pengajian_aksi($this->Command);
		// jenis pengajian
		include_once 'jenis_pengajian_aksi.php';
		$jpa = new jenis_pengajian_aksi($this->Command);
		
		$this->model = new pengajian();
		$this->model->set_order_column("tgl_pengajian");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix("select id_pengajian, jenis_pengajian, DATE_FORMAT(tanggal_pengajian,('%m-%Y')) tgl_pengajian from pengajian");
		
		foreach ($jps as $jp) {
			$categories = array();
			
			$this->model->set_select_full_suffix("jenis_pengajian=" . $jp . $this->create_model_filter());
			$obj_ps = $this->svc->select_model($this->model);
			$datas = array();
			
			foreach ($obj_ps as $obj_p) {
				$tgl_pengajian = number_format(string_tools::stringToTime('01-' . $obj_p->tgl_pengajian . " 00:00:00"), 0, '', '');
				if (array_key_exists($tgl_pengajian, $categories)) {
					$tmp_arr = $categories[$tgl_pengajian];
					array_push($tmp_arr, $obj_p->id_pengajian);
					$categories[$tgl_pengajian] = $tmp_arr;
				} else {
					$categories[$tgl_pengajian] = array($obj_p->id_pengajian);
				}
			}

			foreach ($categories as $key => $ids) {
				$obj_as = $apa->getAbsensiByPengajian($ids);
				$count = 0;
				foreach ($obj_as as $obj_a) {
					$count += intval($obj_a->absen);
				}
				
				foreach ($obj_as as $obj_a) {
					  $datas[$obj_a->nama_kedatangan][] = (array(doubleval($key),floatval(($obj_a->absen / $count) * 100)));
				}
				
			}
			
			$data = array();
			foreach ($datas as $key => $value) {
				$data[] = array('type'=>'spline', 'name'=>$key,'data'=>$value);
			}
			
			$jpm = $jpa->getModelById($jp);
			$result['chart'][] = array("text"=>"Summary Bulanan " . $jpm->NAMA_JENIS_PENGAJIAN, "series"=>$data);
		}
		header("Content-type: text/json");
		echo json_encode($result);	
	}
	
	/**
	 * 
	 * Get menu filter report
	 */
	private function get_menu_filter() {
		$form = '<form id="sFilter">';
		
		// input search
		$form .= '<div class="sidebar_search"><input type="text" name="tanggal_pengajian" id="keyword" class="search_input_water" value="Tanggal Pengajian" title="Tanggal Pengajian" /><input type="image" class="search_submit" src="' . getScriptUrl() . '/images/search.png" alt="Cari" title="Cari" /></div>';

		// sidebarmenu start
		$form .= '<div class="sidebarmenu">';
		
		// jenis report
		//$form .= '<a class="menuitem submenuheader" href="">Jenis Report</a> <div class="submenu"> <ul> <li><input name="rtype" type="radio" value="table" checked=\'checked\'/>Table</li> <li><input name="rtype" type="radio" value="summary"/>Summary</li> </ul> </div>';
		$form .= '<a class="menuitem submenuheader" href="">Jenis Report</a><div class="submenu"><ul><li><input name="rtype" type="radio" value="summonth" checked=\'checked\'/>Summary Bulanan</li><li><input name="rtype" type="radio" value="summary"/>Summary Pengajian</li></ul></div>';
		
		// tingkat organisasi
		$form .= '<a class="menuitem submenuheader" href="">Organisasi</a><div class="submenu"><ul><li>' . $this->tingkat_organisasi_opt() . '</li><li><select name="organisasi" id="organisasi"></select></li></ul></div>';
		
		// jenis pengajian
		$form .= '<a class="menuitem submenuheader" href="">Jenis Pengajian</a>';
		include_once 'jenis_pengajian_aksi.php';
		$jenis_pengajian_aksi = new jenis_pengajian_aksi($this->Command);
		$form .= $jenis_pengajian_aksi->get_menu_filter();
		
		// search button
		$form .= '<a class="menuitem_green" id="search" href="#">Refine Search</a>';
		
		// reset button
		$form .= '<a class="menuitem_red" id="reset" href="#">Reset</a>';

		// export filter and button
		// $form .= '<a class="menuitem submenuheader" href="">Export Report</a> <div class="submenu"> <ul> <li><input name="type" type="radio" value="xls" checked=\'checked\'/>Excel</li> <li><input name="type" type="radio" value="doc"/>Word</li> </ul> <button class="btn btn-small btn-success applyBtn" id="download">download</button> </div>';
		
		// sidebarmenu and form end
		$form .= '</div></form>';
		return $form;
	}
	
	private function tingkat_organisasi_opt() {
		$level = $this->get_tingkat_org_role();
		if ($level == 4) {
			$radio = "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\" checked=\"checked\"/>Kelompok<br/>";
		} else if ($level == 3) {
			$radio = "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\"/>Kelompok<br/>";
			$radio .= "\n" . "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','desa')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"desa\" value=\"3\" checked=\"checked\"/>Desa<br/>";
		} else if ($level == 2 or $level == 1) {
			$radio = "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\"/>Kelompok<br/>";
			$radio .= "\n" . "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','desa')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"desa\" value=\"3\" />Desa<br/>";
			$radio .= "\n" . "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','daerah')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"daerah\" value=\"2\" checked=\"checked\"/>Dearah<br/>";
		}		
		return $radio;
	}
}
?>