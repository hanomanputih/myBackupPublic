<?php 
require_once "base_model.php";

class user extends base_model{
	private $id_user;
	private $username;
	private $nama_lengkap;
	private $password;
	private $role;
	private $last_session;
	
	function set_id_user($id_user) { $this->id_user = $id_user; }
	function get_id_user() { return $this->id_user; }
	function set_username($username) { $this->username = $username; }
	function get_username() { return $this->username; }
	function set_nama_lengkap($nama_lengkap) { $this->nama_lengkap = $nama_lengkap; }
	function get_nama_lengkap() { return $this->nama_lengkap; }
	function set_password($password) { $this->password = $password; }
	function get_password() { return $this->password; }
	function set_role($role) { $this->role = $role; }
	function get_role() { return $this->role; }
	function set_last_session($last_session) { $this->last_session = $last_session; }
	function get_last_session() { return $this->last_session; }

	public function __toString() {
		return 'id : ' . $this->get_id_user() . ',' . 'usernama : ' .	$this->get_username();
	}
}