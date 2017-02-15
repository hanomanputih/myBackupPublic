<?php 
require_once "base_model.php";

class permission extends base_model{
	private $role;
	private $menu;
	private $menu_function;
	
	function set_role($role) { $this->role = $role; }
	function get_role() { return $this->role; }
	function set_menu($menu) { $this->menu = $menu; }
	function get_menu() { return $this->menu; }
	function set_menu_function($menu_function) { $this->menu_function = $menu_function; }
	function get_menu_function() { return $this->menu_function; }
}