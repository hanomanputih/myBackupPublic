<?php
include_once "WEB-INF/controller/base_controller.php";

class jamaah_aksi extends base_controller {
	public function __construct($command){
		$this->titleClass = "Jamaah";
		parent::__construct("jamaah",$command);
	}
			
	public function getList() {
		$this->model->set_order_column("nama_lengkap");
		$this->model->set_order_method("ASC");
		$this->model->set_select_searchable("nama_lengkap;nama_panggilan;nama_status_sambung;nama_kelompok;telepon;telepon_wali;mobile");
		
		$query_is_show_deleted = ($this->get_role_sdr()) ? "" : " AND jamaah.tanggal_delete=''";
		
		$this->model->set_select_full_prefix("select id_jamaah,nama_lengkap,tempat_lahir,tanggal_lahir,concat(tempat_lahir,', ',DATE_FORMAT(tanggal_lahir, '%d-%b-%Y')) ttl,jenis_kelamin,kelompok,nama_kelompok,id_status_sambung,nama_status_sambung,tanggal_delete from jamaah,kelompok,desa,daerah,status_sambung");
		$this->model->set_select_full_suffix("id_kelompok=kelompok and id_desa=desa and id_daerah=daerah and id_status_sambung=status_sambung" . $this->get_role_detail() . $query_is_show_deleted);
		$header = array("Nama Lengkap","Tempat Tanggal Lahir","JK","Status Sambung","Kelompok","Detail","Edit");
		$listMap = array(
					 $this->mapping_show('nama_lengkap'),
					 $this->mapping_show('ttl'),
					 $this->mapping_show('jenis_kelamin'),
					 $this->mapping_show('nama_status_sambung'),
					 $this->mapping_show('nama_kelompok'),
					 $this->mapping_detail('Detail Jamaah', 'id_jamaah', 'jamaah'),
					 $this->mapping_edit('id_jamaah')
					 );
		$this->_getList($header,$listMap);
	}
	
	public function getById() {
		$this->model = $this->createModel();
		$this->model->set_select_full_prefix('select id_jamaah, nama_lengkap, nama_panggilan, tempat_lahir, tanggal_lahir, jenis_kelamin, nama_ayah, nama_ibu, status_jamaah, tanggal_aktif, status_kawin, pendapatan, harta, status_sambung, kelompok, mubaligh, status_hidup, alamat, geo, telepon, mobile, telepon_wali, web, email, pekerjaan, pendidikan, desc_jamaah, foto from jamaah');
		$field = array('nama_lengkap','nama_panggilan','tempat_lahir','tanggal_lahir','jenis_kelamin','nama_ayah','nama_ibu','status_jamaah','tanggal_aktif','status_kawin','pendapatan','harta','status_sambung','kelompok','mubaligh','status_hidup','alamat','geo','telepon','mobile','telepon_wali','web','email','pekerjaan','pendidikan','desc_jamaah','foto');
		$this->_getById($field);
	}
	
	public function detail() {
		$this->model->set_select_full_prefix('select id_jamaah,nama_lengkap,nama_panggilan,tempat_lahir,tanggal_lahir,jenis_kelamin,nama_ayah,nama_ibu,status_jamaah,nama_status_jamaah,status_kawin,nama_status_kawin,pendapatan,harta,status_sambung,nama_status_sambung,tanggal_aktif,kelompok,nama_kelompok,mubaligh,status_hidup,alamat,geo,telepon,mobile,telepon_wali,web,email,pekerjaan,nama_pekerjaan,pendidikan,nama_pendidikan,desc_jamaah,foto from jamaah,kelompok,status_sambung,status_kawin,pekerjaan,pendidikan,status_jamaah');
		$this->model->set_select_full_suffix('id_kelompok=kelompok and id_status_jamaah=status_jamaah and id_status_sambung=status_sambung and id_status_kawin=status_kawin and id_pekerjaan=pekerjaan and id_pendidikan=pendidikan');
		$header = array('Foto','Nama Lengkap','Nama Panggilan','Tempat Lahir','Tanggal Lahir','Usia','Jenis Kelamin','Nama Ayah','Nama Ibu','Jenis Jamaah','Status Kawin','Pendapatan','Harta','Status Sambung','Mulai Aktif Sambung','Kelompok','Mubaligh/Mubalighot','Status Hidup','Alamat','Geo','Telepon','Mobile','Telepon Wali','Web','Email','Pekerjaan','Pendidikan','Keterangan');
		$listMap = array(
					$this->mapping_show('foto'),
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
					$this->mapping_detail_form('kelompok', 'kelompok', 'nama_kelompok'),
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
					$this->mapping_show('nama_pendidikan'),
					$this->mapping_show('desc_jamaah')
					);
		$this->_detail($header, $listMap);
	}
	
	public function add() {
		$this->model = $this->createModel();
		$this->model->set_foto($this->setFoto());
		echo $this->_add($this->model);
	}
	
	public function edt() {
		$this->model = $this->createModel();
		$this->model->set_foto($this->setFoto());
		echo $this->_edt($this->model);
	}
	
	/**
	 * 
	 * fungsi untuk update instance di database
	 * @param array $listId
	 * @param object $model
	 */
	protected function _del($listId, $model) {
		$deleteCount = count($listId);
		$result = array();
		if (string_tools::is_not_empty_or_null($deleteCount)){
			try {
				$this->svc->soft_delete($model);
				$result[messageBox] = message_box::valid_box("$deleteCount data berhasil dihapus.");
				$result[error] = false;
			} catch (Exception $e) {
				$result[messageBox] = message_box::error_box($e->getMessage());
				$result[error] = true;
			}
		} else{
			$result[messageBox] = message_box::warning_box('Tidak ada data yang tercentang!');
			$result[error] = true;
		}
		
		return json_encode($result);
	}
	
	private function setFoto() {
		$filename = "foto/default_" . $_POST['jenis_kelamin'] . ".jpg";
		$image = $_FILES['file']['name'];
		if ($image) {
			$allowedExts = array("jpg", "jpeg", "gif", "png");
			$extension = $this->getExtension($image);
			
			if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")) && in_array(strtolower($extension), $allowedExts)) {
				if ($_FILES["file"]["error"] > 0) {
					$msg = $_FILES["file"]["error"];
		 			$result[messageBox] = message_box::error_box($msg);
					$result[error] = true;
					echo json_encode($result);
					exit();
				} else {
					// increment file name
					$idxFoto = 0;
					do {
						$filename = "foto/" . $_POST['kelompok'] . "_" . $_POST['nama_panggilan'] . ($idxFoto == 0 ? '' : '_' . $idxFoto) . "." . $extension;
						$idxFoto++;
					} while (file_exists($filename));
					move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
			    }
			}
			else {
		 		$msg = "Extensi foto tidak diketahui, silahkan upload file jpeg,png, atau gif";
	 			$result[messageBox] = message_box::error_box($msg);
				$result[error] = true;
				echo json_encode($result);
				exit();
			}
		} else {
			if ($this->Command->getFunction() == 'edt')
				$filename = $_POST['foto'];
		}

		return $filename;
	}

	private function getAge($birthday) {
		return floor((strtotime(date('Y-m-d')) - strtotime($birthday)) / 31556926);	
	}	
	
	private function getExtension($strFileName) {
         $i = strrpos($strFileName,".");
         if (!$i) { return ""; }
         $l = strlen($strFileName) - $i;
         $ext = substr($strFileName,$i+1,$l);
         return $ext;
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
					if ($header[$key] == 'Mubaligh/Mubalighot')
						$tempRow[$header[$key]] = $this->intToStrBoolId($row[$map[1]]);
					else if ($header[$key] == 'Jenis Kelamin')
						$tempRow[$header[$key]] = $row[$map[1]] == 'L' ? 'Laki-laki' : 'Perempuan';
					else if ($header[$key] == 'Usia')
						$tempRow[$header[$key]] = $this->getAge($row[$map[1]]);
					else 
						$tempRow[$header[$key]] = $row[$map[1]];
				} else if ($map[0] == 'edit') {
					if (string_tools::is_not_empty_or_null($row['tanggal_delete']))
						$tempRow[$header[$key]] = form_render::action_activate($row[$map[1]]);
					else 
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
	
	public function getAutocomplete() {
		$this->model->set_order_column("nama");
		$this->model->set_order_method("ASC");
		
		if (isset($_GET['jk']))
			$opt_query .= " and jenis_kelamin='" . $_GET['jk'] . "'";

		$this->model->set_select_full_prefix("select id_jamaah, concat(nama_lengkap,' (',nama_kelompok,')') nama from jamaah,kelompok,desa,daerah");
		$this->model->set_select_full_suffix("(id_kelompok=kelompok and id_desa=desa and daerah=id_daerah) AND concat(nama_lengkap,' (',nama_kelompok,')') like '%" . $_GET['q'] . "%' and jamaah.tanggal_delete=''" . $opt_query . $this->get_role_detail());
		$this->_getAutocomplete();
	}
	
	public function getJamaahByOrg($query_opt, $list_status_sambung) {
		// add '00' if list is null
		if (count($list_ss)==0)
			$list_ss[]='00';
				
		$this->model->set_select_full_prefix("select id_jamaah from jamaah, kelompok, desa, daerah");
		$this->model->set_select_full_suffix("(id_kelompok=kelompok and id_desa=desa and daerah=id_daerah) AND " . $query_opt . ' AND status_sambung in (' . implode(',',$list_status_sambung) . ') and jamaah.tanggal_delete=""');
		return $this->svc->select_model($this->model);
	}
}
?>