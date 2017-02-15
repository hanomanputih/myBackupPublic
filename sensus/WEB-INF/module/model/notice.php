<?php
require_once "base_model.php";

class notice extends base_model
{
	private $id_notice;
	private $notice;
	
	function set_id_notice($id_notice) { $this->id_notice = $id_notice; }
	function get_id_notice() { return $this->id_notice; }
	function set_notice($notice) { $this->notice = $notice; }
	function get_notice() { return $this->notice; }
}
