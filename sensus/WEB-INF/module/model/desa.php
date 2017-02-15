<?php
require_once "base_model.php";

class desa extends base_model {
	private $id_desa;
	private $nama_desa;
	private $daerah;
	private $desc_desa;

	function set_id_desa($id_desa) { $this->id_desa = $id_desa; }
	function get_id() { return $this->id_desa; }
	function set_nama_desa($nama_desa) { $this->nama_desa = $nama_desa; }
	function get_nama_desa() { return $this->nama_desa; }
	function set_daerah($daerah) { $this->daerah = $daerah; }
	function get_daerah() { return $this->daerah; }
	function set_desc_desa($desc_desa) { $this->desc_desa = $desc_desa; }
	function get_desc_desa() { return $this->desc_desa; }
}