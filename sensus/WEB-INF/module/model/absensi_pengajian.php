<?php
require_once "base_model.php";

class absensi_pengajian extends base_model {
	private $id_absensi_pengajian;
	private $pengajian;
	private $jamaah;
	private $jam_absen;
	private $kedatangan;
	
	function set_id_absensi_pengajian($id_absensi_pengajian) { $this->id_absensi_pengajian = $id_absensi_pengajian; }
	function get_id_absensi_pengajian() { return $this->id_absensi_pengajian; }
	function set_pengajian($pengajian) { $this->pengajian = $pengajian; }
	function get_pengajian() { return $this->pengajian; }
	function set_jamaah($jamaah) { $this->jamaah = $jamaah; }
	function get_jamaah() { return $this->jamaah; }
	function set_jam_absen($jam_absen) { $this->jam_absen = $jam_absen; }
	function get_jam_absen() { return $this->jam_absen; }
	function set_kedatangan($kedatangan) { $this->kedatangan = $kedatangan; }
	function get_kedatangan() { return $this->kedatangan; }
}