<?php
include_once "WEB-INF/controller/base_controller.php";

class kelompok_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "kelompok";
		parent::__construct("kelompok",$command);
	}

	public function getList() {
		$this->model->set_order_by("nama_kelompok");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable("nama_kelompok;nama_masjid;nama_desa;nama_daerah;desc_kelompok");
		$this->model->set_select_full_prefix("select id_kelompok,nama_kelompok,masjid,nama_masjid,desa,nama_desa,daerah,nama_daerah,desc_kelompok from kelompok,masjid,desa,daerah");
		$this->model->set_select_full_suffix("id_masjid=masjid and id_desa=desa and id_daerah=daerah" . $this->get_role_detail());

		$header = array("Kelompok","Masjid","Desa","Daerah","Deskripsi","Edit");
		$listMap = array(
						$this->mapping_show('nama_kelompok'),
						$this->mapping_detail_form('masjid','masjid','nama_masjid'),
						$this->mapping_show('nama_desa'),
						$this->mapping_show('nama_daerah'),
						$this->mapping_show('desc_kelompok'),
						$this->mapping_edit('id_kelompok')
					);
		$this->_getList($header,$listMap);
	}

	public function getById() {
		$this->model = $this->createModel();
		$field = array("nama_kelompok","desa","masjid","desc_kelompok");
		$this->_getById($field);
	}

	public function getSelect() {
		$this->model->set_order_column("nama_kelompok");
		$this->model->set_select_full_prefix("select id_kelompok,nama_kelompok from kelompok, desa, daerah");
		$this->model->set_select_full_suffix("id_desa=desa and id_daerah=daerah" . $this->get_role_detail());
		if(isset($_GET['checkbox']))
			$this->_getCheckbox();
		else
			$this->_getSelect(false);
	}
	
	public function detail() {
		$header = array("Kelompok","Masjid","Desa","Daerah","Keterangan");
		$this->model->set_select_full_prefix("select id_kelompok,nama_kelompok,masjid,nama_masjid,desa,nama_desa,daerah,nama_daerah,desc_kelompok from kelompok,masjid,desa,daerah");
		$this->model->set_select_full_suffix("id_masjid=masjid and id_desa=desa and id_daerah=daerah and id_kelompok=" . $_POST['id']);
		$listMap = array(
						 $this->mapping_show('nama_kelompok'),
						 $this->mapping_detail_form('masjid', 'masjid', 'nama_masjid'),
						 $this->mapping_show('nama_desa'),
						 $this->mapping_show('nama_daerah'),
						 $this->mapping_show('desc_kelompok'),
					);
		$this->_detail($header, $listMap, false);
	}
	
	public function getAutocomplete() {
		$this->model->set_order_column("nama_kelompok");
		$this->model->set_order_method("ASC");
		
		$this->model->set_select_full_suffix("nama_kelompok like '%" . $_GET['q'] . "%'" . $this->get_role_detail());
		$this->_getAutocomplete();
	}
	
	public function get_list_daerah($list_kel) {
		$this->model->set_select_full_prefix("select distinct(daerah) daerah from kelompok,desa");
		$this->model->set_select_full_suffix("id_desa=desa and id_kelompok in (" . $list_kel . ")");
		$daerahs = $this->svc->select_model($this->model);
		$l_daerah = array();
		foreach ($daerahs as $daerah) {
			$l_daerah[] = $daerah->daerah;
		}
		return implode(",", $l_daerah);
	}
	
	public function get_list_desa($list_kel) {
		$this->model->set_select_full_prefix("select distinct(desa) desa from kelompok");
		$this->model->set_select_full_suffix("id_kelompok in (" . $list_kel . ")");
		$desas = $this->svc->select_model($this->model);
		$l_desa = array();
		foreach ($desas as $desa) {
			$l_desa[] = $desa->desa;
		}
		return implode(",", $l_desa);
	}
	
	/**
	 * 
	 * return query
	 * @param organisasi $organisasi
	 * @param $tingkat_organisasi : tingkat organisasi 1/2/3/4
	 */
	public function getQueryById($organisasi, $tingkat_organisasi) {
		$this->model->set_order_column("id_kelompok");
		$this->model->set_order_method("ASC");
		$this->model->set_select_full_prefix("select id_kelompok, id_desa, id_daerah from kelompok, desa, daerah");
		$this->model->set_select_full_suffix("(id_desa=desa and daerah=id_daerah) and id_kelompok=" . $id);
		$klps = $this->svc->select($this->model);
		
		/**
		 * 1 : pusat -> bypass
		 * 2 : daerah
		 * 3 : desa
		 * 4 : kelompok
		 */
		$query_opt = '';
		if ($tingkat_organisasi == '2')
			$query_opt .= 'daerah=' . $klps[0]['id_daerah'];
		else if ($tingkat_organisasi == '3')
			$query_opt .= 'desa=' . $klps[0]['id_desa'];
		else if ($tingkat_organisasi == '4')
			$query_opt .= 'kelompok=' . $klps[0]['id_kelompok'];
		
		return $query_opt;
	}
}
?>