<?php 
require_once "base_model.php";

class role extends base_model{
	private $id_role;
	private $nama_role;
	private $tingkat_organisasi;
	private $show_deleted_record;
	
	function set_id_role($id_role) { $this->id_role = $id_role; }
	function get_id_role() { return $this->id_role; }
	function set_nama_role($nama_role) { $this->nama_role = $nama_role; }
	function get_nama_role() { return $this->nama_role; }
	function set_tingkat_organisasi($tingkat_organisasi) { $this->tingkat_organisasi = $tingkat_organisasi; }
	function get_tingkat_organisasi() { return $this->tingkat_organisasi; }
	function set_show_deleted_record($show_deleted_record) { $this->show_deleted_record = $show_deleted_record; }
	function get_show_deleted_record() { return $this->show_deleted_record; }
}