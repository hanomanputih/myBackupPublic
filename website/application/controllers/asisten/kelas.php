<?php

class Kelas extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("m_kelas","kelas");
		$this->load->model("m_user_daftar","daftar");
		$this->load->model("m_responsi_kelas","responsi");
	}

	public function index()
	{
		
	}

	public function ai($menu="",$menu2="")
	{
		$dataToSend["kelas_ai"] = $this->kelas->getAllKelasAi();
		$dataToSend["jumlah"]  = $this->daftar;
		$dataToView["content"] = $this->load->view("content/asisten/kelas_ai/list_kelas",$dataToSend,TRUE);
		if($menu == "praktikan")
		{
			$dataToSend["praktikan_ai"] = $this->daftar->getAllUserDaftar();
			$dataToSend["kelas"] = $this->kelas->getAllKelasAi();
			if(!empty($menu2))
			{
				$dataToSend["praktikan_ai"] = $this->daftar->getUserDaftarByKelas($menu2);
			}
			$dataToView["content"] = $this->load->view("content/asisten/praktikan_ai/list_praktikan",$dataToSend,TRUE);

		}
		else if($menu == "responsi")
		{
            $dataToSend["responsi"] = $this->responsi->getAllKelasResponsi();
            $dataToSend["kelas"] = $this->responsi->getHariResponsi();
            if(!empty($menu2))
            {
                $dataToSend["responsi"] = $this->responsi->getKelasResponsiByHari($menu2);
            }
            $dataToView["content"] = $this->load->view("content/asisten/responsi/list_responsi",$dataToSend,TRUE);
		}
		$this->load->view("template/template_admin",$dataToView);
	}
}