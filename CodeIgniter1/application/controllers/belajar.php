<?php 
Class Belajar extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('general');
	}

	public function index(){

		$this->general->set_table('data');
		echo $this->general->get_table();
	}
	// public function A(){

}

 ?>