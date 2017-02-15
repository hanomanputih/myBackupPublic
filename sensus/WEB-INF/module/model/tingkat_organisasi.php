<?php
require_once "base_model.php";

class tingkat_organisasi extends base_model
{
	private $id_tingkat_organisasi;
	private $nama_tingkat_organisasi;

	function set_id_tingkat_organisasi($id_tingkat_organisasi) { $this->id_tingkat_organisasi = $id_tingkat_organisasi; }
	function get_id_tingkat_organisasi() { return $this->id_tingkat_organisasi; }
	function set_nama_tingkat_organisasi($nama_tingkat_organisasi) { $this->nama_tingkat_organisasi = $nama_tingkat_organisasi; }
	function get_nama_tingkat_organisasi() { return $this->nama_tingkat_organisasi; }
}
