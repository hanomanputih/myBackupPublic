<?php
require_once "base_model.php";

class pengurus extends base_model {
	private $id_pengurus;
	private $jamaah;
	private $jenis_pengurus;
	private $tingkat_organisasi;
	private $desc_pengurus;
	
	function set_id_pengurus($id_pengurus) { $this->id_pengurus = $id_pengurus; }
	function get_id_pengurus() { return $this->id_pengurus; }
	function set_jamaah($jamaah) { $this->jamaah = $jamaah; }
	function get_jamaah() { return $this->jamaah; }
	function set_jenis_pengurus($jenis_pengurus) { $this->jenis_pengurus = $jenis_pengurus; }
	function get_jenis_pengurus() { return $this->jenis_pengurus; }
	function set_tingkat_organisasi($tingkat_organisasi) { $this->tingkat_organisasi = $tingkat_organisasi; }
	function get_tingkat_organisasi() { return $this->tingkat_organisasi; }
	function set_desc_pengurus($desc_pengurus) { $this->desc_pengurus = $desc_pengurus; }
	function get_desc_pengurus() { return $this->desc_pengurus; }
}