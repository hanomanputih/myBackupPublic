<?php 
require_once "base_model.php";

class menu_function_detail extends base_model{
	private $menu;
	private $menu_function;
	
	function set_menu($menu) { $this->menu = $menu; }
	function get_menu() { return $this->menu; }
	function set_menu_function($menu_function) { $this->menu_function = $menu_function; }
	function get_menu_function() { return $this->menu_function; }
}