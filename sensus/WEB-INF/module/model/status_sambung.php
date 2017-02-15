<?php
require_once "base_model.php";
class status_sambung extends base_model{
	private $id_status_sambung;
	private $nama_status_sambung;
	private $desc_status_sambung;

	function set_id_status_sambung($id_status_sambung) { $this->id_status_sambung = $id_status_sambung; }
	function get_id_status_sambung() { return $this->id_status_sambung; }
	function set_nama_status_sambung($nama_status_sambung) { $this->nama_status_sambung = $nama_status_sambung; }
	function get_nama_status_sambung() { return $this->nama_status_sambung; }
	function set_desc_status_sambung($desc_status_sambung) { $this->desc_status_sambung = $desc_status_sambung; }
	function get_desc_status_sambung() { return $this->desc_status_sambung; }

}