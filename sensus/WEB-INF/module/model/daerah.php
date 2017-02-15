<?php
require_once "base_model.php";

class daerah extends base_model {
	private $id_daerah;
	private $nama_daerah;
	private $desc_daerah;

	function set_id_daerah($id_daerah) { $this->id_daerah = $id_daerah; }
	function get_id() { return $this->id_daerah; }
	function set_nama_daerah($nama_daerah) { $this->nama_daerah = $nama_daerah; }
	function get_nama_daerah() { return $this->nama_daerah; }
	function set_desc_daerah($desc_daerah) { $this->desc_daerah = $desc_daerah; }
	function get_desc_daerah() { return $this->desc_daerah; }

}