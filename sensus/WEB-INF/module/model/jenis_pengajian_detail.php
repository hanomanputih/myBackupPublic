<?php
require_once "base_model.php";

class jenis_pengajian_detail extends base_model
{
	private $jenis_pengajian;
	private $status_sambung;
	
	function set_jenis_pengajian($jenis_pengajian) { $this->jenis_pengajian = $jenis_pengajian; }
	function get_jenis_pengajian() { return $this->jenis_pengajian; }
	function set_status_sambung($status_sambung) { $this->status_sambung = $status_sambung; }
	function get_status_sambung() { return $this->status_sambung; }
}
