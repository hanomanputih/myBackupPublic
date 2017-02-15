<?php
require_once "base_model.php";

class status_kawin extends base_model
{
	private $id_status_kawin;
	private $nama_status_kawin;

	function set_id_status_kawin($id_status_kawin) { $this->id_status_kawin = $id_status_kawin; }
	function get_id_status_kawin() { return $this->id_status_kawin; }
	function set_nama_status_kawin($nama_status_kawin) { $this->nama_status_kawin = $nama_status_kawin; }
	function get_nama_status_kawin() { return $this->nama_status_kawin; }
}
