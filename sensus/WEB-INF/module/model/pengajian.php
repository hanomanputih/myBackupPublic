<?php 
require_once "base_model.php";

class pengajian extends base_model{
	private $id_pengajian;
	private $tingkat_organisasi;
	private $organisasi;
	private $jenis_pengajian;
	private $tanggal_pengajian;
	private $alquran_bacaan;
	private $alquran_bacaan_ayat;
	private $alquran_surat;
	private $alquran_ayat;
	private $penyampai_alquran;
	private $alhadist;
	private $alhadist_halaman;
	private $penyampai_alhadist;
	private $nasehat_materi;
	private $penasehat;
	private $materi_lain;
	private $penyampai_materi_lain;
	private $desc_pengajian;
	
	function set_id_pengajian($id_pengajian) { $this->id_pengajian = $id_pengajian; }
	function get_id_pengajian() { return $this->id_pengajian; }
	function set_tingkat_organisasi($tingkat_organisasi) { $this->tingkat_organisasi = $tingkat_organisasi; }
	function get_tingkat_organisasi() { return $this->tingkat_organisasi; }
	function set_organisasi($organisasi) { $this->organisasi = $organisasi; }
	function get_organisasi() { return $this->organisasi; }
	function set_jenis_pengajian($jenis_pengajian) { $this->jenis_pengajian = $jenis_pengajian; }
	function get_jenis_pengajian() { return $this->jenis_pengajian; }
	function set_tanggal_pengajian($tanggal_pengajian) { $this->tanggal_pengajian = $tanggal_pengajian; }
	function get_tanggal_pengajian() { return $this->tanggal_pengajian; }
	function set_alquran_bacaan($alquran_bacaan) { $this->alquran_bacaan = $alquran_bacaan; }
	function get_alquran_bacaan() { return $this->alquran_bacaan; }
	function set_alquran_bacaan_ayat($alquran_bacaan_ayat) { $this->alquran_bacaan_ayat = $alquran_bacaan_ayat; }
	function get_alquran_bacaan_ayat() { return $this->alquran_bacaan_ayat; }
	function set_alquran_surat($alquran_surat) { $this->alquran_surat = $alquran_surat; }
	function get_alquran_surat() { return $this->alquran_surat; }
	function set_alquran_ayat($alquran_ayat) { $this->alquran_ayat = $alquran_ayat; }
	function get_alquran_ayat() { return $this->alquran_ayat; }
	function set_penyampai_alquran($penyampai_alquran) { $this->penyampai_alquran = $penyampai_alquran; }
	function get_penyampai_alquran() { return $this->penyampai_alquran; }
	function set_alhadist($alhadist) { $this->alhadist = $alhadist; }
	function get_alhadist() { return $this->alhadist; }
	function set_alhadist_halaman($alhadist_halaman) { $this->alhadist_halaman = $alhadist_halaman; }
	function get_alhadist_halaman() { return $this->alhadist_halaman; }
	function set_penyampai_alhadist($penyampai_alhadist) { $this->penyampai_alhadist = $penyampai_alhadist; }
	function get_penyampai_alhadist() { return $this->penyampai_alhadist; }
	function set_nasehat_materi($nasehat_materi) { $this->nasehat_materi = $nasehat_materi; }
	function get_nasehat_materi() { return $this->nasehat_materi; }
	function set_penasehat($penasehat) { $this->penasehat = $penasehat; }
	function get_penasehat() { return $this->penasehat; }
	function set_materi_lain($materi_lain) { $this->materi_lain = $materi_lain; }
	function get_materi_lain() { return $this->materi_lain; }
	function set_penyampai_materi_lain($penyampai_materi_lain) { $this->penyampai_materi_lain = $penyampai_materi_lain; }
	function get_penyampai_materi_lain() { return $this->penyampai_materi_lain; }
	function set_desc_pengajian($desc_pengajian) { $this->desc_pengajian = $desc_pengajian; }
	function get_desc_pengajian() { return $this->desc_pengajian; }
}