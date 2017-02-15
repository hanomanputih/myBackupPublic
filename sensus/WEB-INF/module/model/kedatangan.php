<?php 
require_once "base_model.php";

class kedatangan extends base_model{
	private $id_kedatangan;
	private $nama_kedatangan;
	
	function set_id_kedatangan($id_kedatangan) { $this->id_kedatangan = $id_kedatangan; }
	function get_id_kedatangan() { return $this->id_kedatangan; }
	function set_nama_kedatangan($nama_kedatangan) { $this->nama_kedatangan = $nama_kedatangan; }
	function get_nama_kedatangan() { return $this->nama_kedatangan; }
}