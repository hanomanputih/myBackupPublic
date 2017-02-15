<?php
require_once "base_model.php";

class event extends base_model {
	private $id_event;
	private $tingkat_organisasi_create;
	private $organisasi_create;
	private $nama_event;
	private $jenis_event;
	private $start_event;
	private $end_event;
	private $allday_event;
	private $tingkat_organisasi_visible;
	private $organisasi_visible;
	private $desc_event;
	
	function set_id_event($id_event) { $this->id_event = $id_event; }
	function get_id_event() { return $this->id_event; }
	function set_tingkat_organisasi_create($tingkat_organisasi_create) { $this->tingkat_organisasi_create = $tingkat_organisasi_create; }
	function get_tingkat_organisasi_create() { return $this->tingkat_organisasi_create; }
	function set_organisasi_create($organisasi_create) { $this->organisasi_create = $organisasi_create; }
	function get_organisasi_create() { return $this->organisasi_create; }
	function set_nama_event($nama_event) { $this->nama_event = $nama_event; }
	function get_nama_event() { return $this->nama_event; }
	function set_jenis_event($jenis_event) { $this->jenis_event = $jenis_event; }
	function get_jenis_event() { return $this->jenis_event; }
	function set_start_event($start_event) { $this->start_event = $start_event; }
	function get_start_event() { return $this->start_event; }
	function set_end_event($end_event) { $this->end_event = $end_event; }
	function get_end_event() { return $this->end_event; }
	function set_allday_event($allday_event) { $this->allday_event = $allday_event; }
	function get_allday_event() { return $this->allday_event; }
	function set_tingkat_organisasi_visible($tingkat_organisasi_visible) { $this->tingkat_organisasi_visible = $tingkat_organisasi_visible; }
	function get_tingkat_organisasi_visible() { return $this->tingkat_organisasi_visible; }
	function set_organisasi_visible($organisasi_visible) { $this->organisasi_visible = $organisasi_visible; }
	function get_organisasi_visible() { return $this->organisasi_visible; }
	function set_desc_event($desc_event) { $this->desc_event = $desc_event; }
	function get_desc_event() { return $this->desc_event; }
}