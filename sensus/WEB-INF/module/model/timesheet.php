<?php 
require_once "base_model.php";

class timesheet extends base_model{
	private $id_timesheet;
	private $produk;
	private $task_type;
	private $start_date;
	private $end_date;
	private $desc_timesheet;
	
	function set_id_timesheet($id_timesheet) { $this->id_timesheet = $id_timesheet; }
	function get_id_timesheet() { return $this->id_timesheet; }
	function set_produk($produk) { $this->produk = $produk; }
	function get_produk() { return $this->produk; }
	function set_task_type($task_type) { $this->task_type = $task_type; }
	function get_task_type() { return $this->task_type; }
	function set_start_date($start_date) { $this->start_date = $start_date; }
	function get_start_date() { return $this->start_date; }
	function set_end_date($end_date) { $this->end_date = $end_date; }
	function get_end_date() { return $this->end_date; }
	function set_desc_timesheet($desc_timesheet) { $this->desc_timesheet = $desc_timesheet; }
	function get_desc_timesheet() { return $this->desc_timesheet; }
		
}