<?php
include_once "WEB-INF/controller/base_controller.php";

class anak_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Anak";
		parent::__construct("anak",$command);
	}
	
	/**
	 * 
	 * Delete all old record and insert all new 'anak'
	 * @param int $id_keluarga
	 * @param array $list_new_id
	 */
	public function replace($keluarga,$list_new_id) {
		$this->model = new anak();
		$this->model->set_keluarga(array($keluarga));
		$this->svc->delete($this->model);
		
		$this->model->set_keluarga($keluarga);
		foreach ($list_new_id as $value){
			$this->model->set_anak($value);
			$this->svc->save($this->model);
		}
	}

	public function getList($keluarga) {
		$this->model = $this->createModel();
		$this->model->set_select_full_prefix("select keluarga,anak,nama_lengkap from anak left join jamaah on anak.ANAK=jamaah.ID_JAMAAH");
		$this->model->set_select_full_suffix('keluarga=' . $keluarga);

		$rows = $this->svc->select($this->model);

		foreach ($rows as $row) {
			$listAnak .= form_render::action_detail_form($row['anak'], 'jamaah', $row['nama_lengkap']) . " ";
		}
		
		return $listAnak;
	}

	public function getSelectEdit($keluarga) {
		$this->model = $this->createModel();
		$this->model->set_select_full_prefix("select keluarga,anak,nama_lengkap from anak left join jamaah on anak.ANAK=jamaah.ID_JAMAAH");
		$this->model->set_select_full_suffix('keluarga=' . $keluarga);
				
		$rows = $this->svc->select($this->model);
		$result = array();
		foreach ($rows as $row) {
			$result[] = array("nama"=>$row['nama_lengkap'],"anak"=>$row['anak']);
		}
		
		return $result;
	}
	
	public function del_list($listId) {
		$this->model = $this->createModel();
		$this->model->set_keluarga($listId);
		return $this->_del($listId, $this->model);
	}
}
?>