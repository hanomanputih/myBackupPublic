<?php
require_once "base_model.php";

class keluarga extends base_model{
	private $id_keluarga;
	private $kelompok;
	private $kepala_keluarga;
	private $suami;
	private $istri;

	function set_id_keluarga($id_keluarga) { $this->id_keluarga = $id_keluarga; }
	function get_id_keluarga() { return $this->id_keluarga; }
	function set_kelompok($kelompok) { $this->kelompok = $kelompok; }
	function get_kelompok() { return $this->kelompok; }
	function set_kepala_keluarga($kepala_keluarga) { $this->kepala_keluarga = $kepala_keluarga; }
	function get_kepala_keluarga() { return $this->kepala_keluarga; }
	function set_suami($suami) { $this->suami = $suami; }
	function get_suami() { return $this->suami; }
	function set_istri($istri) { $this->istri = $istri; }
	function get_istri() { return $this->istri; }
}