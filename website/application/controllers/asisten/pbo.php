<?php

class Pbo extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("user_status") == 2)
		{
			$this->load->model("m_tahun_ajaran","ta");
			$this->load->model("m_data_pbo","pbo");
			$this->load->model("m_kelas_pbo","kelas");
		}
		else
		{
			redirect(base_url()."asisten/login","refresh");
			exit;
		}
	}

	public function index()
	{
        redirect(base_url()."asisten/pbo/praktikan","refresh");
        exit;
	}

	public function praktikan($menu="",$id="")
	{
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend["pbo"] = $this->pbo->getDataPboByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["total"] = $this->pbo->countDataPboByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["kelas"] = $this->kelas->getKelasPboByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToView["content"] = $this->load->view("content/asisten/pbo/praktikan/list_praktikan",$dataToSend,TRUE);

        if($menu == "tambah")
        {
            if($this->session->userdata("ta_status") == "active")
            {
            $dataToView["content"] = $this->load->view("content/asisten/pbo/praktikan/add_praktikan","",TRUE);
            }
            else
            {
                redirect(base_url()."asisten/pbo/praktikan");
                exit;
            }
        }
        else if($menu == "edit")
        {
            if(!empty($id))
            {
                $dataToSend["pbo"] = $this->pbo->getDataPboById($id);
                $dataToView["content"] = $this->load->view("content/asisten/pbo/praktikan/edit_praktikan",$dataToSend,TRUE);
            }
            else
            {
                redirect(base_url()."asisten/pbo/praktikan","refresh");
                exit;
            }
        }
        else if($menu == "hapus")
        {
           $id = $this->input->post("id",true);
           $delete  = $this->pbo->deleteDataPbo($id);
           if($delete > 0)
           {
                echo true;
           }
           else
           {
                echo false;
           }
        }
        else
        {
            if(!empty($menu))
            {
                $dataToSend["pbo"] = $this->pbo->getDataPboByAttr(array("kelas_nama"=>$menu,"ta_id"=>  $this->session->userdata("ta_id")));
                $dataToView["content"] = $this->load->view("content/asisten/pbo/praktikan/list_praktikan",$dataToSend,TRUE);    
            }
        }
		$this->load->view("template/template_admin",$dataToView);
	}

	// imamsrifkan : fungsi menampilkan kelas pbo
	public function kelas($menu="",$menu2="")
	{
        
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        
        $dataToSend["kelas"] = $this->kelas->getKelasPboByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToView["content"] = $this->load->view("content/asisten/pbo/kelas/list_kelas",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            if($this->session->userdata("ta_status") == "active")
            {
            $dataToView["content"] = $this->load->view("content/asisten/pbo/kelas/add_kelas","",TRUE);
            }
            else
            {
                redirect(base_url()."asisten/pbo/kelas");
                exit;
            }
        }
        else if($menu == "edit")
        {
            if($this->session->userdata("ta_status") == "active")
            {
                if(!empty($menu2))
                {
                    $dataToSend["kelas"] = $this->kelas->getKelasPboById($menu2);
                    $dataToView["content"] = $this->load->view("content/asisten/pbo/kelas/edit_kelas",$dataToSend,TRUE);
                }
            }
            else
            {
                redirect(base_url()."asisten/pbo/kelas");
                exit;
            }
        }
        else if($menu == "hapus")
        {
            if(!empty($menu2))
            {
                $delete = $this->kelas->deleteKelasPbo($menu2);
                redirect(base_url()."asisten/pbo/kelas","refresh");
                exit;
            }
        }
        $this->load->view("template/template_admin",$dataToView);
	}

	public function nilai($menu="")
	{
		$dataToSend["ta"] = $this->ta->getAllTahunAjaran();
		$dataToView["content"] = $this->load->view("content/asisten/nilai/list_nilai",$dataToSend,TRUE);
		if($menu == "tambah")
		{
			$dataToView["content"] = $this->load->view("content/asisten/nilai/add_nilai",$dataToSend,TRUE);
		}
		
        $this->load->view("template/template_admin",$dataToView);
	}


	public function proses_tambah_nilai()
	{
		$dataToCheck = array(
			"praktikan_nim"=>$this->input->post("nim",TRUE),
			);
		// $checkNim = $this->
	}


	//    imamsrifkan : fungsi untuk proses ubah data kelas Pbo
    public function proses_edit_pbo()
    {
        // imamsrifkan : data yang akan diedit
        $dataToEdit = array(
            "kelas_id"=>  $this->input->post("id_kelas",TRUE),
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_keterangan"=>  $this->input->post("keterangan_kelas",TRUE),
        );
        // imamsrifkan : data yang akan diperiksa
        $dataToCheck = array(
            "kelas_id !="=> $this->input->post("id_kelas",TRUE),
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_keterangan"=>  $this->input->post("keterangan_kelas",TRUE),
            "ta_id"=>  $this->session->userdata("ta_id"),
        );
        if(!empty($dataToEdit["kelas_nama"]) AND !empty($dataToEdit["kelas_keterangan"]))
        {
            $check = $this->kelas->getKelasPboByAttr($dataToCheck);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $update = $this->kelas->updateKelasPbo($dataToEdit);
                if($update)
                {
                    echo TRUE;
                }
                else
                {
                    echo FALSE;
                } 
            }
        }
        else
        {
            echo "kosong";
        }
    }
	
	//    imamsrifkan : fungsi untuk menambahkan kelas Pbo
    public function proses_tambah_pbo()
    {
        $dataToAdd = array(
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_keterangan"=>  $this->input->post("keterangan_kelas",TRUE),
            "kelas_status"=> "non-aktif",
            "ta_id"=>  $this->session->userdata("ta_id"),
        );
        $dataToCheck = array(
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_keterangan"=>  $this->input->post("keterangan_kelas",TRUE),
            "ta_id"=>  $this->session->userdata("ta_id"),
        );
        
        if(!empty($dataToAdd["kelas_nama"]) AND !empty($dataToAdd["kelas_keterangan"]))
        {
            $check_data = $this->kelas->getKelasPboByAttr($dataToCheck);
            if($check_data)
            {
                echo "duplikat";
            }
            else
            {
                $insert = $this->kelas->insertKelasPbo($dataToAdd);
                if($insert)
                {
                    echo TRUE;
                }
                else
                {
                    echo FALSE;
                }
            }
        }
        else
        {
            echo "kosong";
        }
    }

    //    imamsrifkan : fungsi untuk proses meyimpan data user pendaftar
    public function proses_tambah_praktikan()
    {
        $dataToSave = array(
            "pbo_nim"=>  $this->input->post("nim_praktikan",TRUE),
            "pbo_nama"=> $this->input->post("nama_praktikan",TRUE),
            "pbo_angkatan" => "20".substr($this->input->post("nim_praktikan"),0,2),
            "kelas_id"=>  $this->input->post("id_kelas",TRUE),
        );
            if(!empty($dataToSave["pbo_nim"]) AND !empty($dataToSave["kelas_id"]) AND !empty($dataToSave["pbo_nama"]))
            {
                if(!preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/',$dataToSave["pbo_nim"]))
                {
                    $data["stats"] = "not-number";
                }
                if(!preg_match('/^[a-zA-Z\ \']+$/',$dataToSave["pbo_nama"]))
                {
                    $data["stats"] =  "not-alpha";
                }
                else
                {
                    $checkNim = $this->pbo->getDataPboByNim($dataToSave["pbo_nim"]);
                    if($checkNim)
                    {
                        $data = $checkNim;
                        $data["stats"] = "avail";
                    }
                    else
                    {
                        if(strlen($dataToSave["pbo_nim"]) == 8)
                        {
                            $insert = $this->pbo->insertDataPbo($dataToSave);
                            if($insert > 0)
                            {
                                $data["stats"] = true;
                            }
                            else
                            {
                                $dataToSave["stats"] = false;
                            }
                        }
                        else
                        {
                            $data["stats"] = "not-8";
                        }
                    }
                }
            }
            else
            {
                $data["stats"] =  "kosong";
            } 
            echo json_encode($data);
    }

     //    imamsrifkan : fungsi untuk proses ubah data praktikan
    public function proses_edit_praktikan()
    {
        $dataToSave = array(
            "pbo_id"=>  $this->input->post("id_praktikan",TRUE),
            "pbo_nim"=>  $this->input->post("nim_praktikan",TRUE),
            "pbo_nama"=>  $this->input->post("nama_praktikan",TRUE),
            "pbo_angkatan"=> "20".substr($this->input->post("nim_praktikan"), 0, 2),
            "kelas_id" => $this->input->post("id_kelas",TRUE),
        );     
        if(!empty($dataToSave["pbo_nama"]) AND !empty($dataToSave["kelas_id"]))
        {   
            if(!preg_match('/^[a-zA-Z\ \']+$/',$dataToSave["pbo_nama"]))
            {
                 echo "not-alpha";
            }
            else
            {
                $update = $this->pbo->updateDataPbo($dataToSave);
                if($update > 0)
                {
                    echo true;
                }
                else
                {
                    echo false;
                }
            }
        }
        else
        {
            echo "kosong";
        }
            
    }
}