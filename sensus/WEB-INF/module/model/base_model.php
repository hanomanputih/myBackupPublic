<?php
class base_model
{
	private $index;
	private $command;
	private $order_by;
	private $order_column;
	private $order_method;
	private $search_keyword;
	private $select_full_prefix;
	private $select_full_suffix;
	private $select_searchable;

	function set_index($index) { $this->index = $index; }
	function get_index() { return $this->index; }
	function set_command($command) { $this->command = $command; }
	function get_command() { return $this->command; }
	function set_order_by($order_by) { $this->order_by = $order_by; }
	function get_order_by() { return $this->order_by; }
	function set_order_column($order_column) { $this->order_column = $order_column; }
	function get_order_column() { return $this->order_column; }
	function set_order_method($order_method) { $this->order_method = $order_method; }
	function get_order_method() { return $this->order_method; }
	function set_search_keyword($search_keyword) { $this->search_keyword = $search_keyword; }
	function get_search_keyword() { return $this->search_keyword; }
	function set_select_full_prefix($select_full_prefix) { $this->select_full_prefix = $select_full_prefix; }
	function get_select_full_prefix() { return $this->select_full_prefix; }
	function set_select_full_suffix($select_full_suffix) { $this->select_full_suffix = $select_full_suffix; }
	function get_select_full_suffix() { return $this->select_full_suffix; }
	function set_select_searchable($select_searchable) { $this->select_searchable = $select_searchable; }
	function get_select_searchable() { return $this->select_searchable; }
	
}