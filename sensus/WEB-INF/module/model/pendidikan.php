<?php 
require_once "base_model.php";

class pendidikan extends base_model{
	private $id_pendidikan;
	private $nama_pendidikan;
	
	function set_id_pendidikan($id_pendidikan) { $this->id_pendidikan = $id_pendidikan; }
	function get_id_pendidikan() { return $this->id_pendidikan; }
	function set_nama_pendidikan($nama_pendidikan) { $this->nama_pendidikan = $nama_pendidikan; }
	function get_nama_pendidikan() { return $this->nama_pendidikan; }
}