<?php 
require_once "base_model.php";

class sessions extends base_model{
	private $id_session;
	private $data;
	private $expires;
	
	function set_id_session($id_session) { $this->id_session = $id_session; }
	function get_id_session() { return $this->id_session; }
	function set_data($data) { $this->data = $data; }
	function get_data() { return $this->data; }
	function set_expires($expires) { $this->expires = $expires; }
	function get_expires() { return $this->expires; }
		
}