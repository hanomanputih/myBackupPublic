<?php
require_once "base_model.php";

class masjid extends base_model{
	private $id_masjid;
	private $nama_masjid;
	private $masjid_daerah;
	private $masjid_desa;
	private $alamat;
	private $geo;
	private $telepon;
	private $mobile;
	private $web;
	private $email;
	private $desc_masjid;
	
	function set_id_masjid($id_masjid) { $this->id_masjid = $id_masjid; }
	function get_id_masjid() { return $this->id_masjid; }
	function set_nama_masjid($nama_masjid) { $this->nama_masjid = $nama_masjid; }
	function get_nama_masjid() { return $this->nama_masjid; }
	function set_masjid_daerah($masjid_daerah) { $this->masjid_daerah = $masjid_daerah; }
	function get_masjid_daerah() { return $this->masjid_daerah; }
	function set_masjid_desa($masjid_desa) { $this->masjid_desa = $masjid_desa; }
	function get_masjid_desa() { return $this->masjid_desa; }
	function set_alamat($alamat) { $this->alamat = $alamat; }
	function get_alamat() { return $this->alamat; }
	function set_geo($geo) { $this->geo = $geo; }
	function get_geo() { return $this->geo; }
	function set_telepon($telepon) { $this->telepon = $telepon; }
	function get_telepon() { return $this->telepon; }
	function set_mobile($mobile) { $this->mobile = $mobile; }
	function get_mobile() { return $this->mobile; }
	function set_web($web) { $this->web = $web; }
	function get_web() { return $this->web; }
	function set_email($email) { $this->email = $email; }
	function get_email() { return $this->email; }
	function set_desc_masjid($desc_masjid) { $this->desc_masjid = $desc_masjid; }
	function get_desc_masjid() { return $this->desc_masjid; }
}