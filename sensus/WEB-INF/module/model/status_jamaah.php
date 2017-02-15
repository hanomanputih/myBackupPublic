<?php
require_once "base_model.php";
class status_jamaah extends base_model{
	private $id_status_jamaah;
	private $nama_status_jamaah;
	private $desc_status_jamaah;

	function set_id_status_jamaah($id_status_jamaah) { $this->id_status_jamaah = $id_status_jamaah; }
	function get_id_status_jamaah() { return $this->id_status_jamaah; }
	function set_nama_status_jamaah($nama_status_jamaah) { $this->nama_status_jamaah = $nama_status_jamaah; }
	function get_nama_status_jamaah() { return $this->nama_status_jamaah; }
	function set_desc_status_jamaah($desc_status_jamaah) { $this->desc_status_jamaah = $desc_status_jamaah; }
	function get_desc_status_jamaah() { return $this->desc_status_jamaah; }

}