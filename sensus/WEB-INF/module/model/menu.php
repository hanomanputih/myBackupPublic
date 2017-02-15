<?php 
require_once "base_model.php";

class menu extends base_model{
	private $id_menu;
	private $title_menu;
	private $controller;
	private $end_path;
	private $target;
	private $urut;
	private $menu;
	private $shortcut;
	
	function set_id_menu($id_menu) { $this->id_menu = $id_menu; }
	function get_id_menu() { return $this->id_menu; }
	function set_title_menu($title_menu) { $this->title_menu = $title_menu; }
	function get_title_menu() { return $this->title_menu; }
	function set_controller($controller) { $this->controller = $controller; }
	function get_controller() { return $this->controller; }
	function set_end_path($end_path) { $this->end_path = $end_path; }
	function get_end_path() { return $this->end_path; }
	function set_target($target) { $this->target = $target; }
	function get_target() { return $this->target; }
	function set_urut($urut) { $this->urut = $urut; }
	function get_urut() { return $this->urut; }	
	function set_menu($menu) { $this->menu = $menu; }
	function get_menu() { return $this->menu; }	
	function set_shortcut($shortcut) { $this->shortcut= $shortcut; }
	function get_shortcut() { return $this->shortcut; }	
}