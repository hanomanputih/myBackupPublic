<?php
require_once "base_model.php";

class jamaah extends base_model{
	private $id_jamaah;
	private $nama_lengkap;
	private $nama_panggilan;
	private $tempat_lahir;
	private $tanggal_lahir;
	private $jenis_kelamin;
	private $nama_ayah;
	private $nama_ibu;
	private $alamat;
	private $geo;
	private $telepon;
	private $mobile;
	private $telepon_wali;
	private $web;
	private $email;
	private $status_jamaah;
	private $tanggal_aktif;
	private $status_kawin;
	private $pendapatan;
	private $harta;
	private $status_sambung;
	private $kelompok;
	private $mubaligh;
	private $status_hidup;
	private $pekerjaan;
	private $pendidikan;
	private $tanggal_delete;
	private $desc_jamaah;
	private $foto;
	
	function set_id_jamaah($id_jamaah) { $this->id_jamaah = $id_jamaah; }
	function get_id_jamaah() { return $this->id_jamaah; }
	function set_nama_lengkap($nama_lengkap) { $this->nama_lengkap = $nama_lengkap; }
	function get_nama_lengkap() { return $this->nama_lengkap; }
	function set_nama_panggilan($nama_panggilan) { $this->nama_panggilan = $nama_panggilan; }
	function get_nama_panggilan() { return $this->nama_panggilan; }
	function set_tempat_lahir($tempat_lahir) { $this->tempat_lahir = $tempat_lahir; }
	function get_tempat_lahir() { return $this->tempat_lahir; }
	function set_tanggal_lahir($tanggal_lahir) { $this->tanggal_lahir = $tanggal_lahir; }
	function get_tanggal_lahir() { return $this->tanggal_lahir; }
	function set_jenis_kelamin($jenis_kelamin) { $this->jenis_kelamin = $jenis_kelamin; }
	function get_jenis_kelamin() { return $this->jenis_kelamin; }
	function set_nama_ayah($nama_ayah) { $this->nama_ayah = $nama_ayah; }
	function get_nama_ayah() { return $this->nama_ayah; }
	function set_nama_ibu($nama_ibu) { $this->nama_ibu = $nama_ibu; }
	function get_nama_ibu() { return $this->nama_ibu; }
	function set_alamat($alamat) { $this->alamat = $alamat; }
	function get_alamat() { return $this->alamat; }
	function set_geo($geo) { $this->geo = $geo; }
	function get_geo() { return $this->geo; }
	function set_telepon($telepon) { $this->telepon = $telepon; }
	function get_telepon() { return $this->telepon; }
	function set_mobile($mobile) { $this->mobile = $mobile; }
	function get_mobile() { return $this->mobile; }
	function set_telepon_wali($telepon_wali) { $this->telepon_wali = $telepon_wali; }
	function get_telepon_wali() { return $this->telepon_wali; }
	function set_web($web) { $this->web = $web; }
	function get_web() { return $this->web; }
	function set_email($email) { $this->email = $email; }
	function get_email() { return $this->email; }
	function set_status_jamaah($status_jamaah) { $this->status_jamaah = $status_jamaah; }
	function get_status_jamaah() { return $this->status_jamaah; }
	function set_tanggal_aktif($tanggal_aktif) { $this->tanggal_aktif = $tanggal_aktif; }
	function get_tanggal_aktif() { return $this->tanggal_aktif; }
	function set_status_kawin($status_kawin) { $this->status_kawin = $status_kawin; }
	function get_status_kawin() { return $this->status_kawin; }
	function set_pendapatan($pendapatan) { $this->pendapatan = $pendapatan; }
	function get_pendapatan() { return $this->pendapatan; }
	function set_harta($harta) { $this->harta = $harta; }
	function get_harta() { return $this->harta; }
	function set_status_sambung($status_sambung) { $this->status_sambung = $status_sambung; }
	function get_status_sambung() { return $this->status_sambung; }
	function set_kelompok($kelompok) { $this->kelompok = $kelompok; }
	function get_kelompok() { return $this->kelompok; }
	function set_mubaligh($mubaligh) { $this->mubaligh = $mubaligh; }
	function get_mubaligh() { return $this->mubaligh; }
	function set_status_hidup($status_hidup) { $this->status_hidup = $status_hidup; }
	function get_status_hidup() { return $this->status_hidup; }
	function set_pekerjaan($pekerjaan) { $this->pekerjaan = $pekerjaan; }
	function get_pekerjaan() { return $this->pekerjaan; }
	function set_pendidikan($pendidikan) { $this->pendidikan = $pendidikan; }
	function get_pendidikan() { return $this->pendidikan; }
	function set_tanggal_delete($tanggal_delete) { $this->tanggal_delete = $tanggal_delete; }
	function get_tanggal_delete() { return $this->tanggal_delete; }
	function set_desc_jamaah($desc_jamaah) { $this->desc_jamaah = $desc_jamaah; }
	function get_desc_jamaah() { return $this->desc_jamaah; }
	function set_foto($foto) { $this->foto = $foto; }
	function get_foto() { return $this->foto; }
}