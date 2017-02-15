<?php
include_once "WEB-INF/controller/base_controller.php";

class pengajian_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Pengajian";
		parent::__construct("pengajian",$command);
	}
			
	public function getList() {
		$this->model->set_order_column("tanggal_pengajian");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable("jenis_kelompok;nama_kelompok;tanggal_pengajian;desc_pengajian");
		$this->model->set_select_full_prefix("select id_pengajian,jenis_pengajian,nama_jenis_pengajian, case tingkat_organisasi when 2 then (select nama_daerah from daerah where id_daerah=organisasi) when 3 then (select nama_desa from desa where id_desa=organisasi) when 4 then (select nama_kelompok from kelompok where id_kelompok=organisasi) END nama_org, tanggal_pengajian, concat(nama_jenis_pengajian,' ',tanggal_pengajian) detail_acara from pengajian,jenis_pengajian");
		$this->model->set_select_full_suffix("id_jenis_pengajian=jenis_pengajian" . $this->get_role_detail_organisasi());
		$header = array("Jenis Pengajian","Organisasi","Tanggal","Peserta","Detail","Edit");
		$listMap = array(
					 $this->mapping_show('nama_jenis_pengajian'),
					 $this->mapping_show('nama_org'),
					 $this->mapping_date('tanggal_pengajian'),
					 $this->mapping_action_redirect('Detail Function',getScriptUrl() . 'absensi_pengajian/secret.html',array('?detail_acara=','detail_acara'),array('&pengajian=','id_pengajian')),
					 $this->mapping_detail('Detail Pengajian', 'id_pengajian', 'pengajian'),
					 $this->mapping_edit('id_pengajian')
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$field = array('jenis_pengajian','tingkat_organisasi','organisasi','tanggal_pengajian','alquran_bacaan','alquran_bacaan_ayat','alquran_surat','alquran_ayat','penyampai_alquran','alhadist','alhadist_halaman','penyampai_alhadist','nasehat_materi','penasehat','materi_lain','penyampai_materi_lain','desc_pengajian');
		$this->_getById($field);
	}
	
	public function detail() {
		$this->model->set_select_full_prefix('select id_pengajian,jenis_pengajian, case tingkat_organisasi when 2 then (select nama_daerah from daerah where id_daerah=organisasi) when 3 then (select nama_desa from desa where id_desa=organisasi) when 4 then (select nama_kelompok from kelompok where id_kelompok=organisasi) END nama_org,nama_jenis_pengajian,tanggal_pengajian,concat((select count(*) from absensi_pengajian where pengajian=id_pengajian)," jamaah") peserta,alquran_bacaan,alquran_bacaan_ayat,alquran_surat,alquran_ayat,penyampai_alquran,alhadist,alhadist_halaman,penyampai_alhadist,nasehat_materi,penasehat,materi_lain,penyampai_materi_lain,desc_pengajian from pengajian,jenis_pengajian');
		$this->model->set_select_full_suffix('id_jenis_pengajian=jenis_pengajian');
		$header = array('Pengajian','Organisasi','Tanggal Pengajian','Peserta','Alquran Bacaan','Alquran Bacaan Ayat','Alquran Surat','Alquran Ayat','Penyampai Alquran','Alhadist','Alhadist Halaman','Penyampai Alhadist','Nasehat Materi','Penasehat','Materi Lain','Penyampai Materi Lain','Deskripsi');
		
		$listMap = array(
					$this->mapping_show('nama_jenis_pengajian'),
					$this->mapping_show('nama_org'),
					$this->mapping_date('tanggal_pengajian'),
					$this->mapping_detail_form('id_pengajian', 'absensi_pengajian', 'peserta'),
					$this->mapping_show('alquran_bacaan'),
					$this->mapping_show('alquran_bacaan_ayat'),
					$this->mapping_show('alquran_surat'),
					$this->mapping_show('alquran_ayat'),
					$this->mapping_show('penyampai_alquran'),
					$this->mapping_show('alhadist'),
					$this->mapping_show('alhadist_halaman'),
					$this->mapping_show('penyampai_alhadist'),
					$this->mapping_show('nasehat_materi'),
					$this->mapping_show('penasehat'),
					$this->mapping_show('materi_lain'),
					$this->mapping_show('penyampai_materi_lain'),
					$this->mapping_show('desc_pengajian')
					 );
		$this->_detail($header, $listMap);
	}
	
	public function add() {
		$this->model = $this->createModel();
		if (string_tools::is_not_empty_or_null($_POST['alquran_ayat']))
			$this->model->set_alquran_ayat(implode("-",$_POST['alquran_ayat']));
		if (string_tools::is_not_empty_or_null($_POST['alhadist_halaman']))
			$this->model->set_alhadist_halaman(implode("-",$_POST['alhadist_halaman']));
		if (string_tools::is_not_empty_or_null($_POST['alquran_bacaan_ayat']))
			$this->model->set_alquran_bacaan_ayat(implode("-",$_POST['alquran_bacaan_ayat']));
		$this->model->set_tanggal_pengajian(($_POST['tanggal'] . " " . $_POST['jam']));
		$result = $this->_add_and_get_id($this->model);
		$this->model->set_id_pengajian($result['id']);
		unset($result['id']);

		//add data
		include_once 'absensi_pengajian_aksi.php';
		$absensi_pengajian_aksi = new absensi_pengajian_aksi($this->Command);
		$absensi_pengajian_aksi->add_absen($this->model);
		
		echo json_encode($result);		
	}
	
	public function edt() {
		$this->model = $this->createModel();
		if (string_tools::is_not_empty_or_null($_POST['alquran_ayat']))
			$this->model->set_alquran_ayat(implode("-",$_POST['alquran_ayat']));
		if (string_tools::is_not_empty_or_null($_POST['alhadist_halaman']))
			$this->model->set_alhadist_halaman(implode("-",$_POST['alhadist_halaman']));
		if (string_tools::is_not_empty_or_null($_POST['alquran_bacaan_ayat']))
			$this->model->set_alquran_bacaan_ayat(implode("-",$_POST['alquran_bacaan_ayat']));
		$this->model->set_tanggal_pengajian(($_POST['tanggal'] . " " . $_POST['jam']));
		echo $this->_edt($this->model);
	}
	
	public function del() {
		$listId = $_POST[id];
		$this->model = $this->createModel();
		
		//delete restrict data
		include_once 'absensi_pengajian_aksi.php';
		$absensi_pengajian_aksi = new absensi_pengajian_aksi($this->Command);
		
		foreach ($listId as $pengajian) {
			$absensi_pengajian_aksi->del_absen($pengajian);
		}
		
		echo $this->_del($listId, $this->model);
	}
	
	// called from viewer
	protected function tingkat_organisasi_opt() {
		$level = $this->get_tingkat_org_role();

		if ($level == 4) {
			$radio = "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\" checked=\"checked\"/><label for=\"kelompok\" class=\"opt\">Kelompok</label>";
		} else if ($level == 3) {
			$radio = "\n" . "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','desa')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"desa\" value=\"3\" checked=\"checked\"/><label for=\"desa\" class=\"opt\">Desa</label>";
		} else if ($level == 2) {
			$radio = "\n" . "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','daerah')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"daerah\" value=\"2\" checked=\"checked\"/><label for=\"daerah\" class=\"opt\">Dearah</label>";
		} else if ($level == 1) {
			$radio = "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','kelompok')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"kelompok\" value=\"4\" checked=\"checked\"/><label for=\"kelompok\" class=\"opt\">Kelompok</label>";
			$radio .= "\n" . "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','desa')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"desa\" value=\"3\" /><label for=\"desa\" class=\"opt\">Desa</label>";
			$radio .= "\n" . "<input onchange=\"javascript:getSelectOptionsWithController('organisasi','daerah')\" type=\"radio\" name=\"tingkat_organisasi\" id=\"daerah\" value=\"2\" /><label for=\"daerah\" class=\"opt\">Dearah</label>";
		}
		return $radio;
	}
	
	public function fulCal($start,$end) {
		$this->model->set_order_column("tanggal_pengajian");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable("jenis_kelompok;nama_kelompok;tanggal_pengajian;desc_pengajian");
		$this->model->set_select_full_prefix("select id_pengajian,jenis_pengajian,nama_jenis_pengajian, case tingkat_organisasi when 2 then (select nama_daerah from daerah where id_daerah=organisasi) when 3 then (select nama_desa from desa where id_desa=organisasi) when 4 then (select nama_kelompok from kelompok where id_kelompok=organisasi) END nama_org, tanggal_pengajian, nama_jenis_pengajian, color, bordercolor, textcolor from pengajian,jenis_pengajian,jenis_event");
		// id_jenis_event = 1 -> pengajian
		$this->model->set_select_full_suffix("id_jenis_pengajian=jenis_pengajian and id_jenis_event=1 and tanggal_pengajian > DATE('$start') and tanggal_pengajian < DATE('$end')" . $this->get_role_detail_organisasi());
		return $this->svc->select($this->model);
	}
}
?>