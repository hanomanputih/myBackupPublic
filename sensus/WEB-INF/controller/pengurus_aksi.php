<?php
include_once "WEB-INF/controller/base_controller.php";

class pengurus_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Pengurus";
		parent::__construct("pengurus",$command);
	}

	public function getList() {
		$this->model->set_order_by("nama_lengkap");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable("nama_lengkap;nama_kelompok;desc_pengurus");
		$this->model->set_select_full_prefix("select id_pengurus,jamaah,nama_lengkap,jenis_pengurus,nama_jenis_pengurus,tingkat_organisasi,nama_tingkat_organisasi,kelompok,nama_kelompok,desa,nama_desa,daerah,nama_daerah from pengurus,jamaah,jenis_pengurus,tingkat_organisasi,kelompok,desa,daerah");
		$this->model->set_select_full_suffix("id_jamaah=jamaah and id_jenis_pengurus=jenis_pengurus and id_tingkat_organisasi=tingkat_organisasi and id_kelompok=kelompok and id_desa=desa and id_daerah=daerah" . $this->get_role_detail());

		$header = array("Nama","Dapuan","Tingkat","Organisasi","Edit");
		$listMap = array(
		$this->mapping_detail_form('jamaah', 'jamaah', 'nama_lengkap'),
		$this->mapping_show('nama_jenis_pengurus'),
		$this->mapping_show('nama_tingkat_organisasi'),
		array('organisasi'),		
		$this->mapping_edit('id_pengurus')
		);
		$this->_getList($header,$listMap);
	}

	public function getById() {
		$this->model = $this->createModel();
		$field = array("jamaah","nama_lengkap","jenis_pengurus","tingkat_organisasi","desc_pengurus");
		$this->_getById($field);
	}
	
	/**
	 * 
	 * Menghasilkan json untuk getSelect
	 * @param array $field
	 */
	protected function _getById($field) {
		$this->model->set_select_full_prefix("select id_pengurus,jamaah,nama_lengkap,jenis_pengurus,tingkat_organisasi,desc_pengurus from pengurus,jamaah");
		$this->model->set_select_full_suffix("id_jamaah=jamaah and id_pengurus=" . $_POST['id']);
		$rows = $this->svc->select($this->model);
		
		$result = array();
		foreach ($field as $value) {
			$result[$value] = $rows[0][$value];
		}
		echo json_encode($result);
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
					if (isset($map[5]))
						$tempRow[$header[$key]] = form_render::action_redirect_url($map[1], $map[2] . $map[3][0] . $row[$map[3][1]] . $map[4][0] . $row[$map[4][1]], $row[$map[5]]);
					else 
						$tempRow[$header[$key]] = form_render::action_redirect_url($map[1], $map[2] . $map[3][0] . $row[$map[3][1]] . $map[4][0] . $row[$map[4][1]]);
				}  else if ($map[0] == 'direct') {
					$tempRow[$header[$key]] = $map[1];
				} else if ($map[0] == 'date') {
					$tempRow[$header[$key]] = $row[$map[1]];
				} else if ($map[0] == 'organisasi') {
					if ($row['tingkat_organisasi']==1)
						$tempRow[$header[$key]] = $row['nama_tingkat_organisasi'];
					else if ($row['tingkat_organisasi']==2)
						$tempRow[$header[$key]] = $row['nama_daerah'];
					else if ($row['tingkat_organisasi']==3)
						$tempRow[$header[$key]] = $row['nama_desa'];
					else if ($row['tingkat_organisasi']==4)
						$tempRow[$header[$key]] = form_render::action_detail_form($row['kelompok'], 'kelompok', $row['nama_kelompok']);
				}
			}
			$rowArray[] = $tempRow;
		}
		return $rowArray;
	}
}
?>