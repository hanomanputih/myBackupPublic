<?php
require_once "base_model.php";

class role_detail extends base_model {
	private $role;
	private $organisasi;
	
	function set_role($role) { $this->role = $role; }
	function get_role() { return $this->role; }
	function set_organisasi($organisasi) { $this->organisasi = $organisasi; }
	function get_organisasi() { return $this->organisasi; }
}