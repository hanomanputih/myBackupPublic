<?php
require_once "base_model.php";

class jenis_pengurus extends base_model
{
	private $id_jenis_pengurus;
	private $nama_jenis_pengurus;
	private $desc_jenis_pengurus;

	function set_id_jenis_pengurus($id_jenis_pengurus) { $this->id_jenis_pengurus = $id_jenis_pengurus; }
	function get_id() { return $this->id_jenis_pengurus; }
	function set_nama_jenis_pengurus($nama_jenis_pengurus) { $this->nama_jenis_pengurus = $nama_jenis_pengurus; }
	function get_nama_jenis_pengurus() { return $this->nama_jenis_pengurus; }
	function set_desc_jenis_pengurus($desc_jenis_pengurus) { $this->desc_jenis_pengurus = $desc_jenis_pengurus; }
	function get_desc_jenis_pengurus() { return $this->desc_jenis_pengurus; }

}