<?php
include_once  "WEB-INF/controller/base_controller.php";

class laporan_biodata_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Jamaah";
		// override to controller jamaah
		parent::__construct("jamaah",$command);
	}
	
    function _default() {
    	$this->Command->setOption($this->get_menu_filter());
    	show_template_report($this->Command);
    }
    
    private function implode_array_in($array) {
    	return implode("','",array_values($array));
    }

	private function create_model_filter() {
		$queryOpt = null;
		if (string_tools::is_not_empty_or_null($_GET['tingkat_organisasi'])) {
			$tingkat_organisasi = $_GET['tingkat_organisasi'];
			if ($tingkat_organisasi == 2) {
				if (string_tools::is_not_empty_or_null($_GET['daerah']))
					$queryOpt .= " AND daerah in (" . implode(',',$_GET['daerah']) . ")";
				else 
					$queryOpt .= $this->get_role_detail();
			} else if ($tingkat_organisasi == 3) {
				if (string_tools::is_not_empty_or_null($_GET['desa']))
					$queryOpt .= " AND desa in (" . implode(',',$_GET['desa']) . ")";
				else 
					$queryOpt .= $this->get_role_detail();
			} else if ($tingkat_organisasi == 4) {
				if (string_tools::is_not_empty_or_null($_GET['kelompok']))
					$queryOpt .= " AND kelompok in (" . implode(',',$_GET['kelompok']) . ")";
				else 
					$queryOpt .= $this->get_role_detail();
			}  else if ($tingkat_organisasi == 1) {;}	//bypass pusat (grant to all)
		} else {
			$queryOpt .= $this->get_role_detail();
		}
		if (isset($_GET['jenis_kelamin']))
			$queryOpt .= " AND jamaah.jenis_kelamin in ('" . $this->implode_array_in($_GET['jenis_kelamin']) . "')";
		if (isset($_GET['status_jamaah']))
			$queryOpt .= " AND jamaah.status_jamaah in ('" . $this->implode_array_in($_GET['status_jamaah']) . "')";
		if (isset($_GET['status_kawin']))
			$queryOpt .= " AND jamaah.status_kawin in ('" . $this->implode_array_in($_GET['status_kawin']) . "')";
		if (isset($_GET['status_sambung']))
			$queryOpt .= " AND jamaah.status_sambung in ('" . $this->implode_array_in($_GET['status_sambung']) . "')";
		if (isset($_GET['mubaligh']))
			$queryOpt .= " AND jamaah.mubaligh in ('" . $this->implode_array_in($_GET['mubaligh']) . "')";
		if (isset($_GET['pekerjaan']))
			$queryOpt .= " AND jamaah.pekerjaan in ('" . $this->implode_array_in($_GET['pekerjaan']) . "')";
		if (isset($_GET['pendidikan']))
			$queryOpt .= " AND jamaah.pendidikan in ('" . $this->implode_array_in($_GET['pendidikan']) . "')";
		if (string_tools::is_not_empty_or_null($_GET['tanggal_aktif'])) {
			$tgl_aktif = $_GET['tanggal_aktif'];
			list($st,$en) = string_tools::between2Date($tgl_aktif);
			$queryOpt .= " AND (jamaah.tanggal_aktif >= '" . $st . "' and jamaah.tanggal_aktif < '" . $en . "')";
		}
		if (string_tools::is_not_empty_or_null($_GET['tanggal_lahir'])) {
			$tgl_lahir = $_GET['tanggal_lahir'];
			list($st,$en) = string_tools::between2Date($tgl_lahir);
			$queryOpt .= " AND (jamaah.tanggal_lahir >= '" . $st . "' and jamaah.tanggal_lahir < '" . $en . "')";
		}	
		
		// never show deleted record
		$queryOpt .= " AND jamaah.tanggal_delete=''";
		return $queryOpt;
	}
	
	/**
	 * 
	 * route report
	 */
	public function getReport() {
		if ($_GET['rtype'] == 'table')
			$this->getList();
		else if ($_GET['rtype'] == 'summary')
			$this->getSummary();
	}
	
	/**
	 * 
	 * Chart
	 */
	protected function getSummary() {
		$return['rtype'] = 'chart';
		$chart = array();

		// jenis kelamin
		$this->model = new jamaah();
		$this->model->set_order_column("L");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix("select * from (select count(*) L from jamaah,kelompok,desa,daerah where jamaah.JENIS_KELAMIN='L' and (id_kelompok=kelompok and id_desa=desa and id_daerah=daerah)" . $this->create_model_filter() .  ") L, (select count(*) P from jamaah,kelompok,desa,daerah where jamaah.JENIS_KELAMIN='P' and (id_kelompok=kelompok and id_desa=desa and id_daerah=daerah)" . $this->create_model_filter() . ") P");
		$jks = $this->svc->select_model($this->model);
		$jk = $jks[0];
		$temp = array();
		$temp['text'] = 'Jenis Kelamin';
		$temp['chart'][] = array('Laki-laki', intval($jk->L));
		$temp['chart'][] = array('Perempuan', intval($jk->P));
		$chart[] = $temp;

		// mubaligh
		$this->model = new jamaah();
		$this->model->set_order_column("B");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix("select * from (select count(*) B from jamaah,kelompok,desa,daerah where jamaah.mubaligh=0 and (id_kelompok=kelompok and id_desa=desa and id_daerah=daerah)" . $this->create_model_filter() .  ") B,(select count(*) L from jamaah,kelompok,desa,daerah where jamaah.mubaligh=1 and jamaah.jenis_kelamin='L' and (id_kelompok=kelompok and id_desa=desa and id_daerah=daerah)" . $this->create_model_filter() . ") L,(select count(*) P from jamaah,kelompok,desa,daerah where jamaah.mubaligh=1 and jamaah.jenis_kelamin='P' and (id_kelompok=kelompok and id_desa=desa and id_daerah=daerah)" . $this->create_model_filter() .  ") P");
		$mbs = $this->svc->select_model($this->model);
		$mb = $mbs[0];
		$temp = array();
		$temp['text'] = 'Mubalig/Mubalighot';
		$temp['chart'][] = array('Mubaligh', intval($mb->L));
		$temp['chart'][] = array('Mubalighot', intval($mb->P));
		$temp['chart'][] = array('Bukan keduanya', intval($mb->B));
		$chart[] = $temp;
		
		// status kawin
		$this->model = new jamaah();
		$this->model->set_order_column("nama_status_kawin");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix("select id_status_kawin, nama_status_kawin, (select count(*) from jamaah,kelompok,desa,daerah where status_kawin=id_status_kawin and (id_kelompok=kelompok and id_desa=desa and id_daerah=daerah)" . $this->create_model_filter() . ") jumlah from status_kawin");
		$sks = $this->svc->select_model($this->model);
		$temp = array();
		$temp['text'] = 'Status Kawin';
		foreach ($sks as $sk) {
			$temp['chart'][] = array($sk->nama_status_kawin, intval($sk->jumlah));
		}
		$chart[] = $temp;
		
		// status sambung
		$this->model = new jamaah();
		$this->model->set_order_column("nama_status_sambung");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix("select id_status_sambung, nama_status_sambung, (select count(*) from jamaah,kelompok,desa,daerah where status_sambung=id_status_sambung and (id_kelompok=kelompok and id_desa=desa and id_daerah=daerah)" . $this->create_model_filter() . ") jumlah from status_sambung");
		$sss = $this->svc->select_model($this->model);
		$temp = array();
		$temp['text'] = 'Status Sambung';
		foreach ($sss as $ss) {
			$temp['chart'][] = array($ss->nama_status_sambung, intval($ss->jumlah));
		}
		$chart[] = $temp;
		
		// status jamaah
		$this->model = new jamaah();
		$this->model->set_order_column("nama_status_jamaah");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix("select id_status_jamaah, nama_status_jamaah, (select count(*) from jamaah,kelompok,desa,daerah where status_jamaah=id_status_jamaah and (id_kelompok=kelompok and id_desa=desa and id_daerah=daerah)" . $this->create_model_filter() . ") jumlah from status_jamaah");
		$sjs = $this->svc->select_model($this->model);
		$temp = array();
		$temp['text'] = 'Status Jamaah';
		foreach ($sjs as $sj) {
			$temp['chart'][] = array($sj->nama_status_jamaah, intval($sj->jumlah));
		}
		$chart[] = $temp;
		
		// pekerjaan
		$this->model = new jamaah();
		$this->model->set_order_column("nama_pekerjaan");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix("select id_pekerjaan, nama_pekerjaan, (select count(*) from jamaah,kelompok,desa,daerah where pekerjaan=id_pekerjaan and (id_kelompok=kelompok and id_desa=desa and id_daerah=daerah) " . $this->create_model_filter() . ") jumlah from pekerjaan");
		$works = $this->svc->select_model($this->model);
		$temp = array();
		$temp['text'] = 'Pekerjaan';
		foreach ($works as $work) {
			if (intval($work->jumlah) != 0)
				$temp['chart'][] = array($work->nama_pekerjaan, intval($work->jumlah));
		}
		$chart[] = $temp;

		// pendidikan
		$this->model = new jamaah();
		$this->model->set_order_column("nama_pendidikan");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix("select id_pendidikan, nama_pendidikan, (select count(*) from jamaah,kelompok,desa,daerah where pendidikan=id_pendidikan and (id_kelompok=kelompok and id_desa=desa and id_daerah=daerah)" . $this->create_model_filter() . ") jumlah from pendidikan");
		$pends = $this->svc->select_model($this->model);
		$temp = array();
		$temp['text'] = 'Pendidikan';
		foreach ($pends as $pend) {
			if (intval($pend->jumlah) != 0)
				$temp['chart'][] = array($pend->nama_pendidikan, intval($pend->jumlah));
		}
		$chart[] = $temp;
		
		$return['charts'] = $chart;
		header("Content-type: text/json");
		echo json_encode($return);
	}
    
	/**
	 * 
	 * List tabel
	 */
	protected function getList() {
		$this->model->set_order_column("nama_lengkap");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable("nama_lengkap;nama_panggilan;nama_status_sambung;nama_kelompok");
		$this->model->set_select_full_prefix("select id_jamaah,nama_lengkap,tempat_lahir,tanggal_lahir,concat(tempat_lahir,', ',DATE_FORMAT(tanggal_lahir,'%d-%b-%Y')) ttl,jenis_kelamin,kelompok,nama_kelompok,id_status_sambung,nama_status_sambung from jamaah,kelompok,desa,daerah,status_sambung");
		$this->model->set_select_full_suffix("id_kelompok=kelompok and id_desa=desa and id_daerah=daerah and id_status_sambung=status_sambung" . $this->create_model_filter() . $this->get_role_detail());
		$header = array("Nama Lengkap","Tempat Tanggal Lahir","Usia","JK","Status Sambung","Kelompok");
		$listMap = array(
					 $this->mapping_show('nama_lengkap'),
					 $this->mapping_show('ttl'),
					 $this->mapping_show('tanggal_lahir'),
					 $this->mapping_show('jenis_kelamin'),
					 $this->mapping_show('nama_status_sambung'),
					 $this->mapping_show('nama_kelompok'),
					 );
		$this->_getList($header,$listMap);
	}
	
	/**
	 * 
	 * List tabel to be printed
	 */
	public function getListPrint() {
		$this->model->set_order_column("nama_lengkap");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix('select id_jamaah,nama_lengkap,nama_panggilan,tempat_lahir,tanggal_lahir,jenis_kelamin,nama_ayah,nama_ibu,status_jamaah,nama_status_jamaah,status_kawin,nama_status_kawin,pendapatan,harta,status_sambung,nama_status_sambung,tanggal_aktif,kelompok,nama_kelompok,mubaligh,status_hidup,alamat,geo,telepon,mobile,telepon_wali,web,email,pekerjaan,nama_pekerjaan,pendidikan,nama_pendidikan,foto from jamaah,kelompok,desa,daerah,status_sambung,status_kawin,pekerjaan,pendidikan,status_jamaah');
		$this->model->set_select_full_suffix('id_kelompok=kelompok and id_desa=desa and id_daerah=daerah and id_status_jamaah=status_jamaah and id_status_sambung=status_sambung and id_status_kawin=status_kawin and id_pekerjaan=pekerjaan and id_pendidikan=pendidikan' . $this->create_model_filter() . $this->get_role_detail());
		$header = array('Nama Lengkap','Nama Panggilan','Tempat Lahir','Tanggal Lahir','Usia','Jenis Kelamin','Nama Ayah','Nama Ibu','Status Jamaah','Status Kawin','Pendapatan','Harta','Status Sambung','Mulai Aktif Sambung','Kelompok','Mubaligh/Mubalighot','Status Hidup','Alamat','Geo','Telepon','Mobile','Telepon Wali','Web','Email','Pekerjaan','Pendidikan');
			$listMap = array(
					$this->mapping_show('nama_lengkap'),
					$this->mapping_show('nama_panggilan'),
					$this->mapping_show('tempat_lahir'),
					$this->mapping_date('tanggal_lahir'),
					$this->mapping_show('tanggal_lahir'), // untuk Usia
					$this->mapping_show('jenis_kelamin'),
					$this->mapping_show('nama_ayah'),
					$this->mapping_show('nama_ibu'),
					$this->mapping_show('nama_status_jamaah'),
					$this->mapping_show('nama_status_kawin'),
					$this->mapping_show('pendapatan'),
					$this->mapping_show('harta'),
					$this->mapping_show('nama_status_sambung'),
					$this->mapping_date('tanggal_aktif'),
					$this->mapping_show('nama_kelompok'),
					$this->mapping_show('mubaligh'),
					$this->mapping_show('status_hidup'),
					$this->mapping_show('alamat'),
					$this->mapping_show('geo'),
					$this->mapping_show('telepon'),
					$this->mapping_show('mobile'),
					$this->mapping_show('telepon_wali'),
					$this->mapping_show('web'),
					$this->mapping_show('email'),
					$this->mapping_show('nama_pekerjaan'),
					$this->mapping_show('nama_pendidikan')
					);
				
		$fFields = $_GET['fields'];
		$headerCount = count($header);
		for ($i = 0; $i < $headerCount; $i++) {
			if (!in_array($header[$i], $fFields))
				unset($header[$i]);
		}
		
		$report_ext = $_GET['type'];
		$nama_file = 'Report_Biodata_' . date("dmY");
		$this->_getListPrint($header, $listMap, $report_ext, $nama_file);
	}
	
	/**
	 * 
	 * Calculate age from birtDat
	 * @param Date (format Y-m-d)  $birthday
	 */
	private function getAge($birthday) {
		return floor( (strtotime(date('Y-m-d')) - strtotime($birthday)) / 31556926);	
	}
	
	private function intToStrBoolId($int) {
		return $int == '1' ? 'Ya' : 'Bukan';
	}
	
	/**
	 * generate html from mapping
	 * 
	 * @param $tempRow['ID'] -> return checkbox whitin id ID
	 * @param $tempRow['index'] -> return value index
	 */
	protected function generate_html_map($rows,$listMap,$header) {
		$rowArray = array();
		$idx = 1;
		foreach ($rows as $row) {
			$tempRow = array();			
			$tempRow['index'] = $idx++;
			
			foreach ($listMap as $key => $map) {
				if ($map[0] == 'show') {
					if ($header[$key] == 'Mubaligh/Mubalighot')
						$tempRow[$header[$key]] = $this->intToStrBoolId($row[$map[1]]);
					else if ($header[$key] == 'Jenis Kelamin')
						$tempRow[$header[$key]] = $row[$map[1]] == 'L' ? 'Laki-laki' : 'Perempuan';
					else if ($header[$key] == 'Usia')
						$tempRow[$header[$key]] = $this->getAge($row[$map[1]]);
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
				} else if ($map[0] == 'date') {
					$tempRow[$header[$key]] = string_tools::standardDateFormat($row[$map[1]]);
				}
			}
			$rowArray[] = $tempRow;
		}
		return $rowArray;
	}
	
    /**
	 * Membuat list table
	 * @param $header, array list menu table
	 * @param $listMap, list mapping $header dan database
	 *  
	 * @uses controller /list.html
	 */
	protected function _getList($header, $listMap) {
		$searchKeyword = $_GET['keyword'];
		
		if (string_tools::is_not_empty_or_null($searchKeyword)) {
			$this->model->set_search_keyword($searchKeyword);
		}
		
		$rows = $this->svc->select($this->model);
		$rowCount = $this->svc->select_count($this->model);
		
		$rowArray = array();
		$return['rtype'] = "table";
		if ($rowCount != 0) {
			$rowArray = $this->generate_html_map($rows,$listMap,$header);
			
			$arrayItem = array("header"=>$header,"rows"=>$rowArray,"footer"=>($rowCount ." Data " . $this->titleClass));
			$json_result = json_encode($arrayItem);
			
			$return['table'] = form_render::render_json($json_result);
			
			echo json_encode($return);
		} else {
			$arrayItem = array("header"=>$header,"rows"=>$rowArray,"footer"=>"0 Data " . $this->titleClass);
			
			$json_result = json_encode($arrayItem);
			$return['table'] = form_render::render_json($json_result);
			echo json_encode($return);
		}
	}
	
    /**
	 * Membuat list table untuk di print
	 * @param $header, array list menu table
	 * @param $listMap, list mapping $header dan database
	 * @param $report_ext : pdf, xls, doc
	 * @param $nama_file : nama file
	 *  
	 * @uses controller /list.html
	*/
	protected function _getListPrint($header, $listMap, $report_ext, $nama_file) {
		if ($report_ext == 'xls' or $report_ext == 'doc') {
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=" . $nama_file .  "." . $report_ext);
			header("Pragma: no-cache");
			header("Expires: 0");
		}
		
		$searchKeyword = $_GET[keyword];
		
		if (string_tools::is_not_empty_or_null($searchKeyword)) {
			$this->model->set_search_keyword($searchKeyword);
		}
		
		$rows = $this->svc->select($this->model);
		$rowCount = $this->svc->select_count($this->model);
		
		$rowArray = array();
		if ($rowCount != 0) {
			$rowArray = $this->generate_html_map($rows,$listMap,$header);
			
			$arrayItem = array("header"=>$header,"rows"=>$rowArray,"footer"=>($rowCount ." Data " . $this->titleClass));
			$json_result = json_encode($arrayItem);
			
			echo form_render::render_print_report($json_result);
		} else {
			$arrayItem = array("header"=>$header,"rows"=>$rowArray,"footer"=>"0 Data " . $this->titleClass);
			
			$json_result = json_encode($arrayItem);
			echo form_render::render_print_report($json_result);
		}
	}
	
	/**
	 * 
	 * Get menu filter report
	 */
	private function get_menu_filter() {
		$form = '<form id="sFilter">';
		
		// input search
		$form .= '<div class="sidebar_search"> <input type="text" name="keyword" id="keyword" class="search_input_water" value="Pencarian" title="Pencarian" /> <input type="image" class="search_submit" src="' . getScriptUrl() . '/images/search.png" alt="Cari" title="Cari" /> </div>';

		// sidebarmenu start
		$form .= '<div class="sidebarmenu">';

		// jenis report
		$form .= '<a class="menuitem submenuheader" href="">Jenis Report</a> <div class="submenu"> <ul> <li><input name="rtype" type="radio" value="table" checked=\'checked\'/>Table</li> <li><input name="rtype" type="radio" value="summary"/>Summary</li> </ul> </div>';
		
		// tingkat organisasi
		$form .= '<a class="menuitem submenuheader" href="">Organisasi</a><div class="submenu"><ul><li>' . $this->tingkat_organisasi_opt() . '</li><li><div id="div_org"></div></li></ul></div>';
		
		// jenis kelamin
		$form .= '<a class="menuitem submenuheader" href="">Jenis Kelamin</a> <div class="submenu"> <ul> <li><input name="jenis_kelamin[]" type="checkbox" value="L" checked=\'checked\'/>Laki-laki</li> <li><input name="jenis_kelamin[]" type="checkbox" value="P" checked=\'checked\'/>Perempuan</li> </ul> </div>';
		
		// mubaligh
		$form .= '<a class="menuitem submenuheader" href="">Mubaligh/Mubalighot</a> <div class="submenu"> <ul> <li><input name="mubaligh[]" type="checkbox" value="1" checked=\'checked\'/>Ya</li> <li><input name="mubaligh[]" type="checkbox" value="0" checked=\'checked\'/>Bukan</li> </ul> </div>';
		
		// tanggal aktif range
		$form .= '<a class="menuitem submenuheader" href="">Tanggal Aktif</a> <div class="submenu"> <ul> <li><input type="text" name="tanggal_aktif" id="tanggal_aktif"/></li> </ul> </div>';
		
		// tanggal lahir range
		$form .= '<a class="menuitem submenuheader" href="">Tanggal Lahir</a> <div class="submenu"> <ul> <li><input type="text" name="tanggal_lahir" id="tanggal_lahir"/></li> </ul> </div>';

		// status kawin
		$form .= '<a class="menuitem submenuheader" href="">Status Kawin</a>';
		include_once 'status_kawin_aksi.php';
		$status_kawin_aksi = new status_kawin_aksi($this->Command);
		$form .= $status_kawin_aksi->get_menu_filter();
		
		// status jamaah
		$form .= '<a class="menuitem submenuheader" href="">Status Jamaah</a>';
		include_once 'status_jamaah_aksi.php';
		$status_jamaah_aksi = new status_jamaah_aksi($this->Command);
		$form .= $status_jamaah_aksi->get_menu_filter();
		
		// status sambung
		$form .= '<a class="menuitem submenuheader" href="">Status Sambung</a>';
		include_once 'status_sambung_aksi.php';
		$status_sambung_aksi = new status_sambung_aksi($this->Command);
		$form .= $status_sambung_aksi->get_menu_filter();
		
		// pekerjaan
		$form .= '<a class="menuitem submenuheader" href="">Pekerjaan</a>';
		include_once 'pekerjaan_aksi.php';
		$pekerjaan_aksi = new pekerjaan_aksi($this->Command);
		$form .= $pekerjaan_aksi->get_menu_filter();
		
		// pendidikan
		$form .= '<a class="menuitem submenuheader" href=""> Pendidikan</a>';
		include_once 'pendidikan_aksi.php';
		$pendidikan_aksi = new pendidikan_aksi($this->Command);
		$form .= $pendidikan_aksi->get_menu_filter();
		
		// search button
		$form .= '<a class="menuitem_green" id="search" href="#">Refine Search</a>';
		
		// reset button
		$form .= '<a class="menuitem_red" id="reset" href="#">Reset</a>';

		// export filter and button
		$form .= '<a class="menuitem submenuheader" href="">Export Report</a> <div class="submenu"> <ul> <li><input name="type" type="radio" value="xls" checked=\'checked\'/>Excel</li> <li><input name="type" type="radio" value="doc"/>Word</li> </ul><button class="btn btn-small btn-success applyBtn" id="ffilter">field filter</button> <button class="btn btn-small btn-success applyBtn" id="download">download</button> </div>';
		
		// sidebarmenu and form end
		$form .= '</div></form>';
		return $form;
	}
	
	private function tingkat_organisasi_opt() {
		$level = $this->get_tingkat_org_role();
		if ($level == 4) {
			$radio = "<input onclick=\"javascript:getCbOrganisasi('kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\" checked=\"checked\"/>Kelompok<br/>";
		} else if ($level == 3) {
			$radio = "<input onclick=\"javascript:getCbOrganisasi('kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\" checked=\"checked\"/>Kelompok<br/>";
		} else if ($level == 2) {
			$radio = "<input onclick=\"javascript:getCbOrganisasi('kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\"/>Kelompok" . "&nbsp";
			$radio .= "<input onclick=\"javascript:getCbOrganisasi('desa')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"desa\" value=\"3\" checked=\"checked\"/>Desa<br/>";
		} else if ($level == 1) {
			$radio = "<input onclick=\"javascript:getCbOrganisasi('kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\"/>Kelompok<br/>";
			$radio .= "\n" . "<input onclick=\"javascript:getCbOrganisasi('desa')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"desa\" value=\"3\" />Desa<br/>";
			$radio .= "\n" . "<input onclick=\"javascript:getCbOrganisasi('daerah')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"daerah\" value=\"2\" checked=\"checked\" />Dearah<br/>";
		}
		return $radio;
	}
}
?>