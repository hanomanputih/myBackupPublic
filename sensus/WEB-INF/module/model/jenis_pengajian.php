<?php
require_once "base_model.php";

class jenis_pengajian extends base_model
{
	private $id_jenis_pengajian;
	private $nama_jenis_pengajian;

	function set_id_jenis_pengajian($id_jenis_pengajian) { $this->id_jenis_pengajian = $id_jenis_pengajian; }
	function get_id_jenis_pengajian() { return $this->id_jenis_pengajian; }
	function set_nama_jenis_pengajian($nama_jenis_pengajian) { $this->nama_jenis_pengajian = $nama_jenis_pengajian; }
	function get_nama_jenis_pengajian() { return $this->nama_jenis_pengajian; }
}
