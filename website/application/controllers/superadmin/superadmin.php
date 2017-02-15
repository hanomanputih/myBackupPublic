<?php

class Superadmin extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	public function Index()
	{
		if($this->session->userdata("user_status") == 1)
		{
			redirect(base_url()."superadmin/home","refresh");
            exit;
		}
		else
		{
			redirect(base_url()."superadmin/login","refresh");
			exit;
		}
	}
}