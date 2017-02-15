<?php
require_once "base_model.php";

class todo extends base_model
{
	private $id_todo;
	private $todo;
	private $tanggal;
	
	function set_id_todo($id_todo) { $this->id_todo = $id_todo; }
	function get_id_todo() { return $this->id_todo; }
	function set_todo($todo) { $this->todo = $todo; }
	function get_todo() { return $this->todo; }
	function set_tanggal($tanggal) { $this->tanggal = $tanggal; }
	function get_tanggal() { return $this->tanggal; }
}
