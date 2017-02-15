<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_login'))
		{
			$this->load->model('model_init','init');
			$this->init->init_footer();
		}
		else
		{
			redirect(base_url());
			exit;
		}
	}

	public function index()
	{
		$data_send['content'] = $this->load->view('content/dashboard/home','',true);
		$this->load->view('template/index',$data_send);
	}
}