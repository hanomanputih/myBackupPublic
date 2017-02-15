<?php
require_once "base_model.php";

class jenis_event extends base_model {
	private $id_jenis_event;
	private $nama_jenis_event;
	private $color;
	private $bordercolor;
	private $textcolor;
	private $desc_jenis_event;
	
	function set_id_jenis_event($id_jenis_event) { $this->id_jenis_event = $id_jenis_event; }
	function get_id_jenis_event() { return $this->id_jenis_event; }
	function set_nama_jenis_event($nama_jenis_event) { $this->nama_jenis_event = $nama_jenis_event; }
	function get_nama_jenis_event() { return $this->nama_jenis_event; }
	function set_color($color) { $this->color = $color; }
	function get_color() { return $this->color; }
	function set_bordercolor($bordercolor) { $this->bordercolor = $bordercolor; }
	function get_bordercolor() { return $this->bordercolor; }
	function set_textcolor($textcolor) { $this->textcolor = $textcolor; }
	function get_textcolor() { return $this->textcolor; }
	function set_desc_jenis_event($desc_jenis_event) { $this->desc_jenis_event = $desc_jenis_event; }
	function get_desc_jenis_event() { return $this->desc_jenis_event; }
}