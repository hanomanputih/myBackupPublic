<?php

class Kcb extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("user_status") == 1)
		{
                        $this->load->model("m_tahun_ajaran","ta");
			$this->load->model("m_kelas_kcb","kelas");
			$this->load->model("m_kelas_praktikum_kcb","praktikum");
			$this->load->model("m_user_daftar","daftar");
                        $this->load->model("m_user_responsi","daftar_responsi");
                        $this->load->model("m_data_kcb","kcb");
			$this->load->model("m_responsi_kelas","responsi");
			$this->load->model("m_data_kcb","data");

                        $this->load->library("pagination");
		}
		else
		{
			redirect(base_url()."superadmin/login","refresh");
			exit;
		}
	}

	public function index()
	{
		$this->kelas();
	}

    // imamsrifkan : fungsi untuk menampilkan data kelas teori kcb
    public function kelas($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        $dataToSend["kelas_ai"] = $this->kelas->getKelasKcbByAttr(array("ta_id"=>$this->session->userdata("ta_id")));
        $dataToSend["jumlah"] = $this->kcb;
        $dataToView["content"] = $this->load->view("content/sadmin/kelas_teori_ai/list_kelas",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            if($this->session->userdata("ta_status") == "active")
            {
                $dataToView["content"] = $this->load->view("content/sadmin/kelas_teori_ai/add_kelas","",TRUE);
            }
            else
            {
                redirect(base_url()."superadmin/kcb/kelas");
                exit;
            }
        }
        else if($menu == "edit")
        {
            if($this->session->userdata("ta_status") == "active")
            {
                if(!empty($id))
                {
                    $dataToSend["kelas_ai"] = $this->kelas->getKelasKcbById($id);
                    $dataToView["content"] = $this->load->view("content/sadmin/kelas_teori_ai/edit_kelas",$dataToSend,TRUE);
                }
                else
                {
                    redirect(base_url()."superadmin/kcb/kelas","refresh");
                    exit;
                }
            }
            else
            {
                redirect(base_url()."superadmin/kcb/kelas");
                exit;
            }
        }
        else if($menu == "hapus")
        {
           $id = $this->input->post("id_kelas",TRUE);
           $delete = $this->kelas->deleteKelasKcb($id);
           if($delete > 0)
           {
                echo true;
           }
           else
           {
                echo false;
           }
        }
        $this->load->view("template/template_sadmin",$dataToView);  
    }

	// imamsrifkan : fungsi menampilkan data kelas praktikum kcb
	public function praktikum($menu="",$id="")
	{
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

	$dataToSend["kelas_ai"] = $this->praktikum->getKelasKcbByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["jumlah"] = $this->daftar;
        $dataToView["content"] = $this->load->view("content/sadmin/kelas_praktikum_ai/list_kelas",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            if($this->session->userdata("ta_status") == "active")
            {
        	$dataToView["content"] = $this->load->view("content/sadmin/kelas_praktikum_ai/add_kelas","",TRUE);
            }
            else
            {
                redirect(base_url()."superadmin/kcb/praktikum");
                exit;
            }
        }
        else if($menu == "edit")
        {
            if(!empty($id))
            {
                if($this->session->userdata("ta_status") == "active")
                {
                    $dataToSend["kelas_ai"] = $this->praktikum->getKelasKcbById($id);
                    $dataToView["content"] = $this->load->view("content/sadmin/kelas_praktikum_ai/edit_kelas",$dataToSend,TRUE);
                }
                else
                {
                    redirect(base_url()."superadmin/kcb/praktikum");
                    exit;
                }
            }
            else
            {
                    redirect(base_url()."superadmin/kcb/praktikum");
                    exit;
            }
        }
        else if($menu == "hapus")
        {
        	$id = $this->input->post("id_kelas",TRUE);
        	$delete = $this->praktikum->deleteKelasKcb($id);
        	if($delete > 0)
        	{
        		echo true;
        	}
        	else
        	{
        		echo false;
        	}
        }
        $this->load->view("template/template_sadmin",$dataToView);
	}

	// imamsrifkan : fungsi menampilkan data mahasiswa kcb
	public function mahasiswa($menu="",$id="")
	{
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

		$dataToSend["kelas"] = $this->kelas->getKelasKcbByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
		$dataToSend["mahasiswa"] = $this->data->getDataByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
                $dataToSend["total"] = $this->data->countDataByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
		$dataToView["content"] = $this->load->view("content/sadmin/mahasiswa_ai/list_mahasiswa",$dataToSend,TRUE);
		if($menu == "tambah")
		{
                    if($this->session->userdata("ta_status") == "active")
                    {
			$dataToView["content"] = $this->load->view("content/sadmin/mahasiswa_ai/add_mahasiswa","",TRUE);
                    }
                    else
                    {
                        redirect(base_url()."superadmin/kcb/mahasiswa");
                        exit;
                    }
		}
		else if($menu == "edit")
		{
			if(!empty($id))
			{
                            if($this->session->userdata("ta_status") == "active")
                            {
				$dataToSend["kelas"] = $this->kelas;
				$dataToSend["mahasiswa"] = $this->data->getDataById($id);
				$dataToView["content"] = $this->load->view("content/sadmin/mahasiswa_ai/edit_mahasiswa",$dataToSend,TRUE);
                            }
                            else
                            {
                                redirect(base_url()."superadmin/kcb/mahasiswa");
                                exit;
                            }
			}
			else
			{
				redirect(base_url()."superadmin/kcb/mahasiswa","refresh");
				exit;
			}
		}
		else if($menu == "hapus")
		{
			$id_mahasiswa = $this->input->post("id_mahasiswa",TRUE);
			$delete = $this->data->deleteData($id_mahasiswa);
			if($delete > 0)
			{
				echo TRUE;
			}
			else
			{
				echo FALSE;
			}
			exit;

		}
		else if(!empty($menu))
		{
			$dataToSend["mahasiswa"] = $this->data->getDataByKelas($menu);
			$dataToView["content"] = $this->load->view("content/sadmin/mahasiswa_ai/list_mahasiswa",$dataToSend,TRUE);
		}
		$this->load->view("template/template_sadmin",$dataToView);

	}

	// imamsrifkan : fungsi menampilkan data praktikan kcb
	public function praktikan($menu="",$id="")
	{
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

	$dataToSend["praktikan_ai"] = $this->daftar->getUserDaftarByAtribut(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["kelas"] = $this->praktikum->getKelasKcbByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["jumlah"] = $this->daftar->countUserDaftarByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["total"] = $this->kcb->countDataByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToView["content"] = $this->load->view("content/sadmin/praktikan_ai/list_praktikan",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            if($this->session->userdata("ta_status") == "active")
            {
                $dataToView["content"] = $this->load->view("content/sadmin/praktikan_ai/add_praktikan",$dataToSend,TRUE);
            }
            else
            {
                redirect(base_url()."superadmin/kcb/praktikan");
                exit;
            }
        }
        else if($menu == "edit")
        {
        	if(!empty($id))
        	{
                    if($this->session->userdata("ta_status") == "active")
                    {
                        $dataToSend["praktikan_ai"] = $this->daftar->getUserDaftarById($id);
                        $dataToSend["kelas"] = $this->praktikum;
                        $dataToView["content"] = $this->load->view("content/sadmin/praktikan_ai/edit_praktikan",$dataToSend,TRUE);
                    }
                    else
                    {
                        redirect(base_url()."superadmin/kcb/praktikan");
                        exit;
                    }
        	}
        	else
        	{
        		redirect(base_url()."superadmin/kcb/praktikan","refresh");
        		exit;
        	}
        }
        else if($menu == "hapus")
        {
        	if(!empty($id))
        	{
        		$this->daftar->deleteUserDaftar($id);
        	}
        	redirect(base_url()."superadmin/kcb/praktikan","refresh");
        }
        else if($menu == "belum-daftar")
        {
            $dataToSend["praktikan_ai"] = $this->daftar->getUserNotDaftar(array("ta_id"=>  $this->session->userdata("ta_id")));
            $dataToView["content"] = $this->load->view("content/sadmin/praktikan_ai/list_notpraktikan",$dataToSend,TRUE);
        }
        else if(!empty($menu))
        {
                $dataToGet = array(
                    "website_kelas_praktikum.kelas_nama"=>$menu,
                    "ta_id"=>  $this->session->userdata("ta_id"),
                    );
        	$dataToSend["praktikan_ai"] = $this->daftar->getUserDaftarByAtribut($dataToGet);
        	$dataToView["content"] = $this->load->view("content/sadmin/praktikan_ai/list_praktikan",$dataToSend,TRUE);
        }
        $this->load->view("template/template_sadmin",$dataToView);
	}

    // imamsrifkan : fungsi untuk menampilkan jadwal responsi kcb
    public function responsi($menu="", $menu2="", $menu3="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        $dataToSend["responsi"] = $this->responsi->getResponsiByAtribut(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["dataResponsi"] = $this->daftar_responsi;
        $dataToSend["hari"] = $this->responsi->getHariResponsi();
        $dataToSend["cekKelas"] = $this->daftar_responsi;
        $dataToSend["total"] = $this->responsi->countResponsiByAttr(array("ta_id"=>$this->session->userdata("ta_id")));
        $dataToSend["jumlah"] = $this->responsi->countActiveResponsi();
        $dataToView["content"] = $this->load->view("content/sadmin/responsi/jadwal/list_responsi",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            $dataToView["content"] = $this->load->view("content/sadmin/responsi/jadwal/add_responsi","",TRUE);
        }
        else if($menu == "edit")
        {
            if(!empty($menu2))
            {
                if($this->session->userdata("ta_status") == "active")
                {
                    $dataToSend["responsi"] = $this->responsi->getResponsiById($menu2);    
                    $dataToView["content"] = $this->load->view("content/sadmin/responsi/jadwal/edit_responsi",$dataToSend,TRUE);
                }
                else
                {
                    redirect(base_url()."superadmin/kcb/responsi");
                    exit;
                }
            }
            else
            {
                redirect(base_url()."superadmin/kcb/responsi","refresh");
                exit;
            }
            
        }
        else if($menu == "hapus")
        {
            $id = $this->input->post("id_responsi",TRUE);
            $delete = $this->responsi->deleteResponsi($id);
            if($delete > 0)
            {
                echo true;
            }
            else
            {
                echo false;
            }
        }
        else if($menu == "praktikan")
        {
            $dataToSend["responsi"] = $this->responsi->getResponsiByAtribut(array("ta_id"=>  $this->session->userdata("ta_id")));
            $dataToView["content"] = $this->load->view("content/sadmin/responsi/data/list_data",$dataToSend,TRUE);

            if($menu2 == "tambah")
            {
                $dataToView["content"] = $this->load->view("content/sadmin/responsi/data/add_data",$dataToSend,TRUE);
            }
            else if($menu2 == "edit")
            {
                if(!empty($menu3))
                {
                    $dataToSend["dataResponsi"] = $this->daftar_responsi->getDataResponsiByJadwal($menu3);
                    $dataToView["content"] = $this->load->view("content/sadmin/responsi/data/edit_data",$dataToSend,TRUE);
                }
                else
                {
                    redirect(base_url()."superadmin/kcb/responsi/praktikan","refresh");
                    exit;
                }
            }
            else if($menu2 == "belum-daftar")
            {
                $dataToSend["jumlah"] = $this->daftar_responsi->countDataResponsiByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
                $dataToSend["total"] = $this->kcb->countDataByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
                $dataToSend["dataResponsi"] = $this->daftar_responsi->getDataNotResponsi(array("ta_id"=>  $this->session->userdata("ta_id")));
                $dataToView["content"] = $this->load->view("content/sadmin/responsi/data/list_notdata",$dataToSend,TRUE);

            }
            else if(!empty($menu2))
            {
                $dataToSend["responsi"] = $this->responsi->getResponsiByDay($menu2);
                $dataToView["content"] = $this->load->view("content/sadmin/responsi/data/list_data",$dataToSend,TRUE);
            }
        }
        else
        {
            if(!empty($menu))
            {
                $dataToSend["responsi"] = $this->responsi->getResponsiByDay($menu);
                $dataToView["content"] = $this->load->view("content/sadmin/responsi/jadwal/list_responsi",$dataToSend,TRUE);
            }
        }

        $this->load->view("template/template_sadmin",$dataToView);
    }


	//    imamsrifkan : fungsi untuk proses meyimpan data user pendaftar
    public function proses_tambah_praktikan()
    {
        $dataToSave = array(
            "daftar_nim"=>  $this->input->post("nim_praktikan",TRUE),
            "kelas_id"=>  $this->input->post("id_kelas",TRUE),
        );
        $dataToCheck = array("daftar_nim"=>$this->input->post("nim_praktikan",TRUE));
        
        
        	if(!empty($dataToSave["daftar_nim"]) AND !empty($dataToSave["kelas_id"]))
	        {
	        	if(!preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/',$dataToSave["daftar_nim"]))
		        {
		            echo "not-number";
		        }
		        else
		        {
                    $checkNim = $this->kcb->getDataByNim($dataToSave["daftar_nim"]);
                    if($checkNim)
                    {
    		            if(strlen($dataToSave["daftar_nim"]) == 8)
    		            {
    			            $check = $this->daftar->getUserDaftarByAtribut($dataToCheck);
    			            if($check)
    			            {
    			                echo "duplikat";
    			            }
    			            else
    			            {
    			                $insert = $this->daftar->insertUserDaftar($dataToSave);
    			                if($insert > 0)
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
    		            	echo "not-8";
    		            }
                    }
                    else
                    {
                        echo "not-found";
                    }
		        }
	        }
	        else
	        {
	            echo "kosong";
	        } 
    }

    //    imamsrifkan : fungsi untuk proses ubah data user pendaftar
    public function proses_edit_praktikan()
    {
        $dataToSave = array(
            "daftar_id"=>  $this->input->post("id_daftar",TRUE),
            "daftar_nim"=>  $this->input->post("nim_praktikan",TRUE),
            "kelas_id"=>  $this->input->post("id_kelas",TRUE),
        );        

            $update = $this->daftar->updateUserDaftar($dataToSave);
            if($update > 0)
            {
                echo TRUE;
            }
            else
            {
                echo FALSE;
            }
        
    }

    // imamsrifkan : fungsi untuk proses menambahkan data mahasiswa
    public function proses_tambah_mahasiswa()
    {
    	$dataToSave = array(
    		"praktikan_nim"=> $this->input->post("nim_mahasiswa",TRUE),
    		"praktikan_nama"=> $this->input->post("nama_mahasiswa",TRUE),
    		"kelas_id"=> $this->input->post("id_kelas",TRUE),
    		);
    	if(!empty($dataToSave["praktikan_nim"]) AND !empty($dataToSave["praktikan_nama"]) AND !empty($dataToSave["kelas_id"]))
    	{
    		if(!preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/',$dataToSave["praktikan_nim"]))
	        {
	            echo "not-number";
	        }
	        else
	        {
	        	if(strlen($dataToSave["praktikan_nim"]) == 8)
	        	{
	        		$checkNim = $this->data->getDataByNim($dataToSave["praktikan_nim"]);
	        		if(!$checkNim)
	        		{
	        			$insert = $this->data->insertData($dataToSave);
	        			if($insert > 0 )
	        			{
	        				echo TRUE;
	        			}
	        			else
	        			{
	        				echo FALSE;
	        			}
	        		}
	        		else
	        		{
	        			echo "duplikat";
	        		}
	        	}
	        	else
	        	{
	        		echo "not-8";
	        	}
	        }
    	}
    	else
    	{
    		echo "kosong";
    	}
    }

    // imamsrifkan : fungsi untuk proses ubah data mahasiswa kcb
    public function proses_edit_mahasiswa()
    {
    	$dataToSave = array(
    		"praktikan_id"=>$this->input->post("id_mahasiswa",TRUE),
    		"praktikan_nim"=>$this->input->post("nim_mahasiswa",TRUE),
    		"praktikan_nama"=>$this->input->post("nama_mahasiswa",TRUE),
    		"kelas_id"=>$this->input->post("id_kelas",TRUE),
    		);
    	if(!empty($dataToSave["praktikan_nama"]))
    	{
    		$update = $this->data->updateData($dataToSave);
    		if($update > 0)
    		{
    			echo TRUE;
    		}
    		else
    		{
    			echo FALSE;
    		}
    	}
    	else
    	{
    		echo "kosong";
    	}
    }

// imamsrifkan : fungsi proses tambah kelas praktikum  kcb
    public function proses_tambah_kelas()
    {   
        $dataToCheck = array(
                "kelas_nama"=>  $this->input->post("nama_kelas", true),
                "kelas_hari"=>  $this->input->post("hari_kelas", true),
    		"kelas_tanggal"=>$this->input->post("tanggal_kelas",TRUE),
    		"kelas_jam"=>$this->input->post("jam_kelas",TRUE),
    		"kelas_keterangan"=>$this->input->post("keterangan_kelas",TRUE),
                "ta_id"=>  $this->session->userdata("ta_id"),
        );
        $dataToCheck2["kelas_kuota"] = $this->input->post("kuota_kelas", true);
    	$dataToSave = array(
    		"kelas_nama"=>$this->input->post("nama_kelas",TRUE),
    		"kelas_hari"=>$this->input->post("hari_kelas",TRUE),
    		"kelas_tanggal"=>$this->input->post("tanggal_kelas",TRUE),
    		"kelas_jam"=>$this->input->post("jam_kelas",TRUE),
    		"kelas_keterangan"=>$this->input->post("keterangan_kelas",TRUE),
                "ta_id"=>  $this->session->userdata("ta_id"),
    	);
        if(!empty($dataToSave["kelas_nama"]) and !empty($dataToSave["kelas_hari"]) and !empty($dataToSave["kelas_tanggal"]) and !empty($dataToSave["kelas_jam"]) and !empty($dataToSave["kelas_keterangan"]) and !empty($dataToCheck2["kelas_kuota"]))
    	{
    		if(!preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/',$dataToCheck2["kelas_kuota"]))
            {
                echo "not-number";
            }
            else
            {
            	$check = $this->praktikum->getKelasKcbByAttr($dataToCheck);
	    		if(!$check)
	    		{
                            $dataToSave["kelas_status"] = "non-aktif";
                            $dataToSave["kelas_kuota"] = $this->input->post("kuota_kelas",TRUE);
	    			$insert  = $this->praktikum->insertKelasKcb($dataToSave);
	    			if($insert > 0)
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
	    			echo "duplikat";
	    		}
            }
    		
    	}	
    	else
    	{
    		echo "kosong";
    	}
    }

    // imamsrifkan : fungsi untuk proses ubah data kelas praktikum kcb
    public function proses_edit_kelas()
    {
        // imamsrifkan : data yang akan di simpan
    	$dataToSave = array(
            "kelas_id"=>  $this->input->post("id_kelas",TRUE),
            "kelas_nama"=>  $this->input->post("nama_kelas",TRUE),
            "kelas_hari"=>  $this->input->post("hari_kelas",TRUE),
            "kelas_tanggal"=>  $this->input->post("tanggal_kelas",TRUE),
            "kelas_jam"=>  $this->input->post("jam_kelas",TRUE),
            "kelas_keterangan"=> $this->input->post("keterangan_kelas",TRUE),
            "kelas_kuota"=> $this->input->post("kuota_kelas",TRUE),
            "ta_id"=>  $this->session->userdata("ta_id"),
        );
        
        // imamsrifkan : periksa ketersediaan kelas berdasarkan atribut
        $dataToCheck = array(
            "kelas_id !="=>  $this->input->post("id_kelas",TRUE),
            "kelas_hari"=>  $this->input->post("hari_kelas",TRUE),
            "kelas_tanggal"=>  $this->input->post("tanggal_kelas",TRUE),
            "kelas_jam"=>  $this->input->post("jam_kelas",TRUE),
            "ta_id" => $this->session->userdata("ta_id"),
        );
        
        // imamsrifkan : periksa ketersediaan nama_kelas
        $dataToNama = array(
            "kelas_id !="=>$this->input->post("id_kelas",TRUE),
            "kelas_nama"=>$this->input->post("nama_kelas",TRUE),
            "ta_id"=>  $this->session->userdata("ta_id"),
            );

        if(!empty($dataToSave["kelas_nama"]) AND !empty($dataToSave["kelas_hari"]) AND !empty($dataToSave["kelas_tanggal"]) AND !empty($dataToSave["kelas_jam"]))
        {
            $checkAttr = $this->praktikum->getKelasKcbByAttr($dataToCheck);
            $checkNama = $this->praktikum->getKelasKcbByAttr($dataToNama);
            if($checkAttr OR $checkNama)
            {
                echo "duplikat";
            }
            else
            {
                $update = $this->praktikum->updateKelasKcb($dataToSave);
                if($update > 0)
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

    // imamsrifkan : fungsi untuk proses tambah kelas teori
    public function proses_tambah_teori()
    {
        $dataToSave = array(
            "kelas_nama"=>$this->input->post("nama_kelas",TRUE),
            "kelas_status"=>"tampil",
            "ta_id"=>  $this->session->userdata("ta_id"),
            );

        if(!empty($dataToSave["kelas_nama"]))
        {
            $dataToCheck = array(
                "kelas_nama"=>$dataToSave["kelas_nama"],
                "ta_id"=>  $this->session->userdata("ta_id"),
            );
            $checkNama = $this->kelas->getKelasKcbByAttr($dataToCheck);
            if(!$checkNama)
            {
                $insert = $this->kelas->insertKelasKcb($dataToSave);
                if($insert > 0)
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
                echo "duplikat";
            }
        }
        else
        {
            echo "kosong";
        }   
    }

    // imamsrifkan : fungsi proses update data kelas teori
    public function proses_edit_teori()
    {
        $dataToSave = array(
            "kelas_id"=>$this->input->post("id_kelas",TRUE),
            "kelas_nama"=>$this->input->post("nama_kelas",TRUE),
            );
        $dataToCheck = array(
            "kelas_id !="=>$this->input->post("id_kelas",TRUE),
            "kelas_nama"=>$this->input->post("nama_kelas",TRUE),
            );


        if(!empty($dataToSave["kelas_nama"]))
        {
            $check = $this->kelas->getKelasKcbByAttr($dataToCheck);
            if(!$check)
            {
                $update = $this->kelas->updateKelasKcb($dataToSave);
                if($update > 0)
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
                echo "duplikat";
            }
        }
        else
        {
            echo "kosong";
        }
    }

    // imamsrifkan : fungsi proses penambahan jadwal responsi
    public function proses_tambah_responsi()
    {
        $tg = $this->input->post("tanggal_responsi",TRUE);
        $bl = $this->input->post("bulan_responsi",TRUE);
        $th = $this->input->post("tahun_responsi",TRUE);
        $tanggal = $this->input->post("tahun_responsi",TRUE)."-".$this->input->post("bulan_responsi",TRUE)."-".$this->input->post("tanggal_responsi",TRUE);
        $tgl = $tanggal." 00:00 AM";
        $hari = date("D",human_to_unix($tgl));
        switch ($hari) {
            case 'Sun':
            $hari = "minggu"; 
                break;
            case 'Mon':
            $hari = "senin";
                break;
            case 'Tue':
            $hari = "selasa";
                break;
            case 'Wed':
            $hari = "rabu";
                break;
            case 'Thu':
            $hari = "kamis";
                break;
            case 'Fri':
            $hari = "jumat";
                break;
            case 'Sat':
            $hari = "sabtu";
                break;
            
            default:
            $hari = "kosong";
                break;
        }
        $dataToSave = array(
            "responsi_kelompok"=>0,
            "responsi_tanggal"=>$tanggal,
            "responsi_hari"=>$hari,
            "responsi_jam"=>$this->input->post("jam_responsi",TRUE),
            "responsi_ruang"=>$this->input->post("ruang_responsi",TRUE),
            "responsi_status"=>"tidak",
            "responsi_status_aktif"=>"non-aktif",
            "ta_id"=>  $this->session->userdata("ta_id"),
            );

        if(!empty($tg) AND !empty($bl) AND !empty($th) AND !empty($dataToSave["responsi_jam"]) AND !empty($dataToSave["responsi_ruang"]))
        {
            $check = $this->responsi->getResponsiByAttr($dataToSave);
            if(!$check)
            {
                 $insert = $this->responsi->insertResponsi($dataToSave);
                if($insert > 0)
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
                echo "duplikat";
            }
           
        }
        else
        {
            echo "kosong";
        }
    }
    // imamsrifkan : proses update responsi
    public function proses_edit_responsi()
    {
        $tg = $this->input->post("tanggal_responsi",TRUE);
        $bl = $this->input->post("bulan_responsi",TRUE);
        $th = $this->input->post("tahun_responsi",TRUE);
        $tanggal = $this->input->post("tahun_responsi",TRUE)."-".$this->input->post("bulan_responsi",TRUE)."-".$this->input->post("tanggal_responsi",TRUE);
        $tgl = $tanggal." 00:00 AM";
        $hari = date("D",human_to_unix($tgl));
        switch ($hari) {
            case 'Sun':
            $hari = "minggu"; 
                break;
            case 'Mon':
            $hari = "senin";
                break;
            case 'Tue':
            $hari = "selasa";
                break;
            case 'Wed':
            $hari = "rabu";
                break;
            case 'Thu':
            $hari = "kamis";
                break;
            case 'Fri':
            $hari = "jumat";
                break;
            case 'Sat':
            $hari = "sabtu";
                break;
            
            default:
            $hari = "kosong";
                break;
        }
        $dataToSave = array(
            "responsi_id"=>$this->input->post("id_responsi",TRUE),
            "responsi_tanggal"=>$tanggal,
            "responsi_jam"=>$this->input->post("jam_responsi",TRUE),
            "responsi_ruang"=>$this->input->post("ruang_responsi",TRUE),
            );
        $dataToCheck = array(
            "responsi_id !="=>$this->input->post("id_responsi",TRUE),
            "responsi_tanggal"=>$tanggal,
            "responsi_jam"=>$this->input->post("jam_responsi",TRUE),
            "responsi_ruang"=>$this->input->post("ruang_responsi",TRUE),
            );
        if(!empty($tg) AND !empty($bl) AND !empty($th) AND !empty($dataToSave["responsi_jam"]) AND !empty($dataToSave["responsi_ruang"]))
        {
            $check = $this->responsi->getResponsiByAttr($dataToCheck);
            if(!$check)
            {
                $update = $this->responsi->updateResponsi($dataToSave);
                if($update > 0)
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
                echo "duplikat";
            }
        }
        else
        {
            echo "kosong";
        }
    }

    // imamsrifkan : proses menambahkan data responsi
    public function proses_tambah_data_responsi()
    {
        $nim= $this->input->post("daftar_nim",TRUE);
        $id_responsi = $this->input->post("responsi_id",TRUE);
        $val = 0;
        $insert = 0;
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
                    $data["valid"] = "duplikat";
                    $data["nim"] = $nim[$val];
                    $data["kelas"] = $checkResponsiNim["responsi_id"];
                    echo json_encode($data);
                    exit;
                }   
                
            }
            $val++;
        }
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
//            imamsrifkan : update data jadwal responsi
            $get = array(
                "responsi"=>$id_responsi,
                "responsi_max"=>$this->responsi->getMaxResponsi("responsi_kelompok",array("ta_id"=>  $this->session->userdata("ta_id"))),
            );
            $dataToSave = array(
                "responsi_id"=>$get["responsi"],
                "responsi_kelompok"=>($get["responsi_max"]["responsi_kelompok"]+1),
                    );
            $update = $this->responsi->updateResponsi($dataToSave);
            
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

    // imamsrifkan : proses update data praktikan responsi
    public function proses_edit_data_responsi()
    {
        $nim = $this->input->post("nim",TRUE);
        $id_responsi = $this->input->post("id_responsi",TRUE);
        
    }

    // imamsrifkan : proses hapus data praktikan responsi berdasarkan jadwal
    public function proses_hapus_data_responsi()
    {
        $id = $this->input->post("id",TRUE);
        $delete = $this->daftar_responsi->deleteDataResponsiByJadwal($id);
        if($delete > 0)
        {
            $dataToSave = array(
                "responsi_id"=>$id,
                "responsi_status"=>"tidak",
                "responsi_kelompok"=>0,
                );
            $update = $this->responsi->updateResponsi($dataToSave);
            echo true;
        }
        else
        {
            echo false;
        }
    }

    // imamsrifkan : proses data praktikan responsi
    public function getDataPraktikan()
    {
        $dataToSave = array(
            "praktikan_nim"=>$this->input->post("nim",TRUE),
            "praktikan_responsi_id"=>$this->input->post("id",TRUE),
            );
        if(!empty($dataToSave["praktikan_nim"]))
        {
            if(!preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/',$dataToSave["praktikan_nim"]))
            {
                    $checkNim["stats"] = "not-number"; 
            }
            else
            {
                $get = $this->kcb->getDataByNim($dataToSave["praktikan_nim"]);
                if($get > 0)
                {
                    $checkNim = $this->daftar_responsi->getDataResponsiByNim($dataToSave["praktikan_nim"]);
                    if(!$checkNim)
                    {
                        $update = $this->daftar_responsi->updateDataResponsi($dataToSave);
                        $getData = $this->daftar_responsi->getDataResponsiByNim($dataToSave["praktikan_nim"]);
                        $checkNim = $getData;
                        $checkNim["stats"] = "success";
                    }
                    else
                    {
                        $checkNim["stats"] = "avail";
                    } 
                }
            }
        }
        else
        {
            $checkNim["stats"] = "kosong";
        }
        $get = $checkNim;
        echo json_encode($get);
    }

    // imamsrifkan : proses menambahkan data praktikan responsi
    public function addPraktikan()
    {
        $dataToSave = array(
            "responsi_id"=>$this->input->post("id",TRUE),
            "praktikan_nim"=>$this->input->post("nim",TRUE),
            );
        if(!empty($dataToSave["praktikan_nim"]))
        {
            if(!preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/',$dataToSave["praktikan_nim"]))
            {
                    $checkNim["stats"] = "not-number"; 
            }
            else
            {
                $get = $this->kcb->getDataByNim($dataToSave["praktikan_nim"]);
                if($get > 0)
                {
                    $checkNim = $this->daftar_responsi->getDataResponsiByNim($dataToSave["praktikan_nim"]);
                    if(!$checkNim)
                    {
                        $checkNim["stats"] = "success";
                        $insert = $this->daftar_responsi->insertDataResponsi($dataToSave);
                    }
                    else
                    {
                        $checkNim["stats"] = "avail";
                    }
                }
                else
                {
                    $checkNim["stats"] = "error";
                }
            }
        }
        else
        {
            $checkNim["stats"] = "kosong";
        }
        $get = $checkNim;
        echo json_encode($get);

    }

    // imamsrifkan : proses hapus data praktikan responsi berdasarkan id
    public function deleteDataResponsi(){
        $id = $this->input->post("id",TRUE);
        $delete = $this->daftar_responsi->deleteDataResponsi($id);
        if($delete > 0)
        {
            $result["stats"] = TRUE;
        }
        else
        {
            $result["stats"] = FALSE;
        }
        echo json_encode($result);
    }

    // imamsrifkan : proses hapus semua kelas praktikum kcb
    public function kelas_hapus()
    {
        $id = $this->input->post("hapus",true);
        if($id == 1)
        {
            $delete = $this->praktikum->deleteAllKelasKcb($this->session->userdata("ta_id"));
            if($delete > 0)
            {
                echo true;
            }
            else
            {
                echo false;
            }
        }
    }

    // imamsrifkan : proses hapus semua jadwal responsi praktikum kcb
    public function responsi_hapus()
    {
        $id = $this->input->post("hapus",true);
        if($id == 1)
        {
            $delete = $this->responsi->deleteAllResponsi($this->session->userdata("ta_id"));
            if($delete > 0)
            {
                echo true;
            }
            else
            {
                echo false;
            }
        }
    }

}