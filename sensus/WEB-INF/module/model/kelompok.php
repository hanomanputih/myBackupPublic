<?php
require_once "base_model.php";

class kelompok extends base_model {
	private $id_kelompok;
	private $nama_kelompok;
	private $desa;
	private $masjid;
	private $desc_kelompok;

	function set_id_kelompok($id_kelompok) { $this->id_kelompok = $id_kelompok; }
	function get_id() { return $this->id_kelompok; }
	function set_nama_kelompok($nama_kelompok) { $this->nama_kelompok = $nama_kelompok; }
	function get_nama_kelompok() { return $this->nama_kelompok; }
	function set_desa($desa) { $this->desa = $desa; }
	function get_desa() { return $this->desa; }
	function set_masjid($masjid) { $this->masjid = $masjid; }
	function get_masjid() { return $this->masjid; }
	function set_desc_kelompok($desc_kelompok) { $this->desc_kelompok = $desc_kelompok; }
	function get_desc_kelompok() { return $this->desc_kelompok; }
}