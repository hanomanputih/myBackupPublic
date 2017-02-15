<?php

class Kcb extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
                $this->load->model("m_repositori","repo");
                $this->load->model("m_agenda","agenda");
                $this->load->model("m_berita","berita");
                $this->load->model("m_user_daftar","daftar");
                $this->load->model("m_user_responsi","daftar_responsi");
                $this->load->model("m_kelas_praktikum_kcb","praktikum_kcb");
                $this->load->model("m_data_kcb","kcb");
                $this->load->model("m_responsi_kelas","kelas_responsi");
                $this->load->model('m_general', 'general');
                
            $this->load->library("pagination");
            
        $this->general->set_table('website_tahun_ajaran');
        $this->general->where(array('ta_status'=>'active'));
        $get = $this->general->get_row_array();
        if($get)
        {
            $config = array('ta_id'=>$get['ta_id']);
            $this->session->set_userdata($config);
        }
    }

	public function index()
	{
        $this->pendaftaran("","");
	}

	// imamsrifkan : fungsi untuk melakukan pendaftaran praktikum kcb
	public function pendaftaran($menu="",$id="")
	{
	$dataToSend["title"] = "KSC Laboratory: Pendaftaran Praktikum";

        $dataToSend["side_repo"] = $this->repo->getRepoLimitByAttr(5,array('website_repositori.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["side_berita"] = $this->berita->getBeritaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["berita"] = $this->berita->getBeritaAndAgendaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));

        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_tugas","",TRUE);
        $dataToSend["daftar_kcb"] = $this->daftar->getUserDaftarByAttr(array('ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["list_kelas"] = $this->praktikum_kcb->getKelasKcbByAttr(array('ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["jumlah_praktikan"] = $this->daftar;
        $dataToView["content"] = $this->load->view("content/user/praktikum/kcb/daftar/list_pendaftar",$dataToSend,TRUE);
        
        if($menu == "daftar")
        {
            if(!empty($id))
            {
                $dataToSend["status"] = $this->praktikum_kcb->getStatusKelasKcb();
                $dataToSend["kelas_id"] = $id;
                // $data = array("website_user_daftar.kelas_id"=>$id);
                $dataToSend["kelas"] = $this->praktikum_kcb->getKelasKcbById($id);
                $dataToSend["jumlah_praktikan"] = $this->daftar->getCountUserDaftarById($id);
                $dataToSend["praktikan"] = $this->daftar->getUserDaftarByKelasId($id);
                $dataToView["content"] = $this->load->view("content/user/praktikum/kcb/daftar/form_daftar",$dataToSend,TRUE);
            }
        }
        $this->load->view("template/template_user",$dataToView);
	}

	// imamsrifkan : fungsi untuk melakukan pendaftaran responsi kcb
	public function responsi($menu="")
	{
		$dataToSend["title"] = "KSC Laboratory: Pendaftaran Responsi";

        $config = array(
            "base_url"=>base_url()."kcb/responsi",
            "total_rows"=>$this->kelas_responsi->countAllRowResponsi(),
            "per_page"=>10,
            "num_links"=>5,
            "prev_link"=>false,
            "next_link"=>false,
            "cur_tag_open"=>" [<span style='font-weight:normal'>",
            "cur_tag_close"=>"</span>]",
            "first_link"=>"First",
            "last_link"=>"Last",
            );
        $this->pagination->initialize($config);
		$dataToSend["side_repo"] = $this->repo->getRepoLimit(5);
		$dataToSend["side_agenda"] = $this->agenda->getAgendaLimit(5);
		$dataToSend["side_berita"] = $this->berita->getBeritaLimit(5);

		$dataToSend["kelas_responsi"] = $this->kelas_responsi->getAllResponsiByPage($config["per_page"],$this->uri->segment(3));
		$dataToSend["data_responsi"] = $this->daftar_responsi;
		$dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_tugas","",true);
		$dataToView["content"] = $this->load->view("content/user/praktikum/kcb/responsi/list_responsi",$dataToSend,true);

		$this->load->view("template/template_user",$dataToView);	
	}

	// imamsrifkan : proses pendaftaran
	public function daftar()
	{
		$dataToSave = array(
			"daftar_nim"=>$this->input->post("nim",true),
			"kelas_id"=>$this->input->post("id_kelas",true),
			);
		$nama = $this->input->post("nama",true);
		if(!empty($dataToSave["daftar_nim"]))
		{
			if(!preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/',$dataToSave["daftar_nim"]))
            {
                $data["stats"] = "not-number";
            }
            if(!preg_match('/^[a-zA-Z\ \']+$/',$nama))
           	{
               $data["stats"] = "not-alpha";
           	}
           	else
           	{
           		if(!strlen($dataToSave["daftar_nim"]) == 8)
           		{
           			$data["stats"] = "not-8";
           		}
           		else
           		{
           			// imamsrifkan : periksa jumlah pendaftar berdasarkan kelas
                    $checkCount = $this->daftar->getCountUserDaftarByKelas($dataToSave["kelas_id"]);
                    // imamsrifkan : periksa jumlah kuota setiap kelas
                    $getKuota = $this->praktikum_kcb->getKelasKcbById($dataToSave["kelas_id"]);
                    if($checkCount["total"] != $getKuota["kelas_kuota"])
                    {
                    	$checkNim = $this->kcb->getDataByNim($dataToSave["daftar_nim"]);
                    	if($checkNim)
                    	{
                    		$check = $this->daftar->getUserDaftarByNim($dataToSave["daftar_nim"]);
                    		if(!$check)
                    		{
                    			$insert = $this->daftar->insertUserDaftar($dataToSave);
                    			if($insert > 0)
                    			{
                    				$data["stats"] = true;
                    			}
                    			else
                    			{
                    				$data["stats"] = false;
                    			}
                    		}
                    		else
                    		{
                    			$data = $check;
                    			$data["stats"] = "duplikat";
                    		}
                    	}
                    	else
                    	{
                    		$data["stats"] = "tidak";
                    	}
                    }
                    else
                    {
                    	$data["stats"] = "penuh";
                    }
           		}
           	}
		}
		else
		{
			$data["stats"] = "kosong";
		}
		echo json_encode($data);
	}
	
	// imamsrifkan : fungsi mengambil data praktikan kcb
	public function getData()
	{
		$nim = $this->input->post("nim",true);
		$getData = $this->kcb->getDataByNimByAttr($nim,array('ta_id'=>  $this->session->userdata("ta_id")));
		if($getData)
		{
			$data = $getData;
			$data["stats"] = true;
		}
		else
		{
			$data["stats"] = false;
		}
		echo json_encode($data);
	}

	// imamsrifkan : proses menambahkan data praktikan responsi
	public function proses_tambah()
	{
		$id_responsi = $this->input->post("responsi_id",true);
		$nim = $this->input->post("nim",true);
		$val = 0;
        $temp = 0;
		$insert = 0;

        if($nim[0] == $nim[1] or $nim[0] == $nim[2] or $nim[1] == $nim[2])
        {
            $data["valid"] = "error";
            echo json_encode($data);
            exit;
        }
		foreach($nim as $result)
		{
			$checkDataNim = $this->kcb->getDataByNim($nim[$val]);
            $checkResponsiNim = $this->daftar_responsi->getDataResponsiByNim($nim[$val]);
            if(!empty($nim[$val]))
            {
                if(!preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/',$nim[$val]))
                {
                    $data["valid"] = "not-number";
                    echo json_encode($data);
                    exit;

                }
                if(!$checkDataNim)
                {

                    $data["valid"] = "empty";
                    $data["nim"] = $nim[$val];
                    echo json_encode($data);
                    exit;
                }
                if($checkResponsiNim)
                {
                    
                    $data = $checkResponsiNim;
                    $data["valid"] = "duplikat";
                    echo json_encode($data);
                    exit;
                } 
            }
            else
            {
                $data["valid"] = "kosong";
                echo json_encode($data);
                exit;
            }
            $val++;

		}
            // imamsrifkan : periksa jumlah praktikan setiap jadwal
        $count = $this->daftar_responsi->countDataResponsiByKelas($id_responsi);
        if($count < 3)
        {
            $val = 0;
            foreach($nim as $result)
            {
                if(!empty($nim[$val]))
                {
                    $insert = $this->daftar_responsi->insertDataResponsi(array("praktikan_nim"=>$nim[$val],"responsi_id"=>$id_responsi));    
                    
                }
                $val++;
            }
            if($insert > 0)
            {
                $data["valid"] = true;
                echo json_encode($data);
                exit; 
            }
            else
            {
                $data["valid"] = false;
                echo json_encode($data);
                exit;
            }
        }
        else
        {
            $data["valid"] = "full";
            echo json_encode($data);
            exit;
        }
	}

    // imamsrifkan : fungsi mengambil data praktikan responsi
    public function getDataPraktikan()
    {
        $dataToSave = array(
            "praktikan_nim"=>$this->input->post("nim",true),
            "praktikan_responsi_id"=>$this->input->post("id_responsi",true)
            );
        $get = $this->kcb->getDataByNim($dataToSave["praktikan_nim"]);
        if($get)
        {
            $data = $get;
            $data["stats"] = "success";
        }
        else
        {
            $data["stats"] = "error";
        }
        echo json_encode($data);
    }
}