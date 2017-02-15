<?php
require_once "base_model.php";

class pekerjaan extends base_model
{
	private $id_pekerjaan;
	private $nama_pekerjaan;
	private $desc_pekerjaan;

	function set_id_pekerjaan($id_pekerjaan) { $this->id_pekerjaan = $id_pekerjaan; }
	function get_id() { return $this->id_pekerjaan; }
	function set_nama_pekerjaan($nama_pekerjaan) { $this->nama_pekerjaan = $nama_pekerjaan; }
	function get_nama_pekerjaan() { return $this->nama_pekerjaan; }
	function set_desc_pekerjaan($desc_pekerjaan) { $this->desc_pekerjaan = $desc_pekerjaan; }
	function get_desc_pekerjaan() { return $this->desc_pekerjaan; }

}