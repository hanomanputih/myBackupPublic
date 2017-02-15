<?php 
require_once "base_model.php";

class menu_function extends base_model{
	private $id_menu_function;
	private $nama_menu_function;
	private $desc_menu_function;
	
	function set_id_menu_function($id_menu_function) { $this->id_menu_function = $id_menu_function; }
	function get_id_menu_function() { return $this->id_menu_function; }
	function set_nama_menu_function($nama_menu_function) { $this->nama_menu_function = $nama_menu_function; }
	function get_nama_menu_function() { return $this->nama_menu_function; }
	function set_desc_menu_function($desc_menu_function) { $this->desc_menu_function = $desc_menu_function; }
	function get_desc_menu_function() { return $this->desc_menu_function; }	
}