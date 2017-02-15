<?php

class Akun extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("user_status") == 1)
		{
			$this->load->model("m_tahun_ajaran","ta");
		}
		else
		{
			redirect(base_url()."superadmin/login","refresh");
		}
	}

	public function index()
	{
		// imamsrifkan : konfigurasi tahun ajaran tiap laporan
		$dataToView["ta"] = $this->ta->getAllTahunAjaran();
	}
}