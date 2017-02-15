<?php
require_once "base_model.php";

class anak extends base_model {
	private $keluarga;
	private $anak;

	function set_keluarga($keluarga) { $this->keluarga = $keluarga; }
	function get_keluarga() { return $this->keluarga; }
	function set_anak($anak) { $this->anak = $anak; }
	function get_anak() { return $this->anak; }
}