<?php 
class Admin extends CI_controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('general');
		$this->load->library('form_validation');
	}

public function index(){
	$this->general->set_table('pegawai');
	$this->load->view('template');

}


}

 ?>