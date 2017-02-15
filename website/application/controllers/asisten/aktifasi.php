<?php

class Aktifasi extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("m_kelas","kelas");
		$this->load->model("m_modul","modul");
		$this->load->model("m_user_daftar","daftar");
	}

	public function index()
	{
		$dataToSend["sidebar"] = $this->load->view("content/asisten/aktifasi/right_side","",TRUE);
		$dataToView["content"] = $this->load->view("content/asisten/aktifasi/home_aktifasi",$dataToSend,TRUE);
		$this->load->view("template/template_admin",$dataToView);
	}

	// imamsrifkan : fungsi untuk aktifasi kelas ai
	public function kelas($menu="",$id="")
    {
        $dataToSend["sidebar"] = $this->load->view("content/asisten/aktifasi/right_side","",TRUE);
        $dataToSend["kelas_ai"] = $this->kelas->getAllKelasAi();
        $dataToSend["hari"] = $this->kelas->getHariKelasAi();
        $dataToSend["aktifasi"] = $this->kelas->getStatusKelasAi();
        $dataToSend["total"] = $this->daftar;
        $dataToView["content"] = $this->load->view("content/asisten/aktifasi/kelas_ai/list_kelas",$dataToSend,TRUE);
        if($menu == "status")
        {
//            imamsrifkan : aktifasi kelas praktikum AI
            if(!empty($id))
            {
                $update = $this->kelas->updateStatusKelasAi($id);
            }
            redirect(base_url()."asisten/aktifasi/kelas","refresh");
            exit;
        }
        else if(!empty($menu))
        {
            $dataToSend["kelas_ai"] = $this->kelas->getKelasAiByHari($menu);
            $dataToView["content"] = $this->load->view("content/asisten/aktifasi/kelas_ai/list_kelas",$dataToSend,TRUE);
        }
        $this->load->view("template/template_admin",$dataToView);
	}

	// imamsrifkan : fungsi untuk aktifasi modul pertemuan
	public function modul($menu="",$id="")
	{
		if($menu == "nonaktif")
		{
			if(!empty($id))
			{
				$dataToEdit = array(
					"modul_id"=>$id,
					"modul_status"=>"non-aktif",
				);
				$this->modul->updateStatusModul($dataToEdit);
				redirect(base_url()."asisten/aktifasi/modul","refresh");
				exit;
			}
			else
			{
				$this->modul->updateAllStatusModul();
				redirect(base_url()."asisten/aktifasi/modul","refresh");
				exit;
			}
		}
		else if($menu == "aktif")
		{
			if(!empty($id))
			{
				$dataToEdit = array(
					"modul_id"=>$id,
					"modul_status"=>"aktif",
				);
				$this->modul->updateStatusModul($dataToEdit);
				redirect(base_url()."asisten/aktifasi/modul","refresh");
				exit;
			}
		}
		$dataToSend["sidebar"] = $this->load->view("content/asisten/aktifasi/right_side","",TRUE);
		$dataToSend["modul"] = $this->modul->getAllModul();
		$dataToView["content"] = $this->load->view("content/asisten/aktifasi/modul/list_modul",$dataToSend,TRUE);
		$this->load->view("template/template_admin",$dataToView);
	} 

	// imamsrifkan : fungsi untuk aktifasi upload tugas pbo
	public function tugas($menu="",$id="")
	{
		$dataToSend["sidebar"] = $this->load->View("content/asisten/aktifasi/right_side","",TRUE);
		$dataToSend["kelas_tugas"] = $this->kelas->getAllKelasTugas();
		$dataToView["content"] = $this->load->view("content/asisten/aktifasi/kelas_tugas/list_tugas",$dataToSend,TRUE);
		if($menu == "nonaktif")
		{
			// imamsrifkan : fungsi menon-aktifkan kelas berdasarkan id
			if(!empty($id))
			{
				$dataToEdit = array(
					"kelas_id"=>$id,
					"kelas_status"=>"non-aktif",
					);
				$update = $this->kelas->updateStatusKelas($dataToEdit);
				redirect(base_url()."asisten/aktifasi/tugas","refresh");
				exit;
			}
			else
			{
				$update = $this->kelas->updateAllStatusKelasTugas();
				redirect(base_url()."asisten/aktifasi/tugas","refresh");
				exit;
			}
		}
		else if($menu == "aktif")
		{
			// imamsrifkan : fungsi untuk mengaktifkan kelas berdasarkan id
			if(!empty($id))
			{
				$dataToEdit = array(
					"kelas_id"=>$id,
					"kelas_status"=>"aktif",
					);
				$update = $this->kelas->updateStatusKelas($dataToEdit);
				redirect(base_url()."asisten/aktifasi/tugas","refresh");
				exit;	
			}
			else
			{
				$update = $this->kelas->updateAllStatusKelasTugas();
				redirect(base_url()."asisten/aktifasi/tugas","refresh");
				exit;
			}
		}
		$this->load->view("template/template_admin",$dataToView);
	}
}