<?php

class Praktikum extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_kelas","kelas");
        $this->load->model("m_asisten","asisten");
        $this->load->model("m_tugas","tugas");
        $this->load->model("m_agenda","agenda");
        $this->load->model("m_berita","berita");
        $this->load->model("m_repositori","repo");
        $this->load->model("m_modul","modul");
        $this->load->model("m_user_daftar","daftar");
        $this->load->model("m_data_user","user");
        
        $this->load->library("form_validation");
    }
    
    public function index()
    {
        $dataToSend["title"] = "KSC Laboratory: Praktikum";

        $dataToSend["side_repo"] = $this->repo->getRepoLimit(5);
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimit(5);
        $dataToSend["side_berita"] = $this->berita->getBeritaLimit(5);
        
        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_tugas","",TRUE);
        $dataToView["content"] = $this->load->view("content/user/praktikum/home_praktikum",$dataToSend,TRUE);
        $this->load->view("template/template_user",$dataToView);
    }
    
//    imamsrifkan : fungsi untuk upload tugas
    public function tugas()
    {
        $dataToSend["title"] = "KSC Laboratory: Upload Tugas";

        $dataToSend["side_repo"] = $this->repo->getRepoLimit(5);
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimit(5);
        $dataToSend["side_berita"] = $this->berita->getBeritaLimit(5);
        
        $dataToSend["pesan"] = "";
        $dataToSend["modul"] = $this->modul->getActiveModul();
        $dataToSend["kelas"] = $this->kelas->checkKelas();
        $dataToSend["asisten"] = $this->asisten->getAllAsisten();
        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_tugas","",TRUE);
        $dataToView["content"] = $this->load->view("content/user/upload/form_upload",$dataToSend,TRUE);
        $this->load->view("template/template_user",$dataToView);
    }
//    imamsrifkan : fungsi untuk proses upload tugas
    public function upload()
    {
        $dataToSend["title"] = "KSC Laboratory: Upload Tugas";

        $dataToSend["side_repo"] = $this->repo->getRepoLimit(5);
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimit(5);
        $dataToSend["side_berita"] = $this->berita->getBeritaLimit(5);
        
//        imamsrifkan : konfigurasi untuk data upload tugas
        $file_name = $this->input->post("nim")."_".url_title($this->input->post("nama")."_p".$this->input->post("modul"));
//        imamsrifkan : rule dari form validation
        $this->form_validation->set_rules("nim","nim","required|is_numeric|exact_length[8]");
        $this->form_validation->set_rules("nama","nama","required|min_length[3]");
        $this->form_validation->set_rules("asisten","asisten","required");
        $this->form_validation->set_rules("userfile","userfile","callback_isValidFile");
        
//                imamsrifkan : periksa data yang akan di simpan
    $dataToCheck = array(
        "kelas_id"=>  $this->input->post("kelas",TRUE),
        "modul_id"=>  $this->input->post("modul",TRUE),
        "tugas_nim"=>  $this->input->post("nim",TRUE),
    );
    $check = $this->tugas->getTugasByAtribut($dataToCheck);
    if($check)
    {
        $dataToSend["pesan"] = "<p style='color:rgb(255,0,0)'>Gagal upload tugas.<br/>Maaf Anda sudah pernah upload tugas.</p>";
    }
    else
    { 
        if($this->form_validation->run() == TRUE)
        {
//            imamsrifkan : konfigurasi file upload
            $config = array(
            "upload_path"=>"./_data/filetugas/",
            "allowed_types"=>"zip",
            "max_size"=>1000,
            "file_name"=>$file_name,
            );
            $this->load->library("upload",$config);

            if($this->upload->do_upload())
            {
                $file = $this->upload->data();
//                imamsrifkan : data yang akan di simpan
                $dataToSave = array(
                    "kelas_id"=> $this->input->post("kelas",TRUE),
                    "user_id"=>  $this->input->post("asisten",TRUE),
                    "modul_id"=>  $this->input->post("modul",TRUE),
                    "tugas_nim"=> $this->input->post("nim",TRUE),
                    "tugas_nama"=> $this->input->post("nama",TRUE),
                    "tugas_file"=> $file["file_name"],
                );

    //                imamsrifkan : menyimpan data tugas
                    $insert = $this->tugas->insertTugas($dataToSave);
                    if($insert > 0)
                    {
                        $dataToSend["pesan"] = "<p style='color:rgb(0,0,255)'>Berhasil upload tugas</p>";
                    }
                    else
                    {
                        $dataToSend["pesan"] = "<p style='color:rgb(255,0,0)'>Data Gagal tersimpan</p>";
                    }
                
            }
            else
            {
                $dataToSend["pesan"] = "<p style='color:rgb(255,0,0)'>Gagal upload tugas.<br/>".$this->upload->display_errors("<p style='color:rgb(255,0,0)'>","</p>")."</p>";
            }
        }
        else
        {
            $this->form_validation->set_error_delimiters("<p style='color:rgb(255,0,0)'>","</p>");
            $dataToSend["pesan"] = validation_errors();
        }
    }
        
        $dataToSend["modul"] = $this->modul->getActiveModul();
        $dataToSend["kelas"] = $this->kelas->checkKelas();
        $dataToSend["asisten"] = $this->asisten->getAllAsisten();
        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_tugas","",TRUE);
        $dataToView["content"] = $this->load->view("content/user/upload/form_upload",$dataToSend,TRUE);
        $this->load->view("template/template_user",$dataToView);
    }
    
//    imamsrifkan : fungsi untuk menampilkan praktikum kcb
    public function kcb($menu="",$id="")
    {
        $dataToSend["title"] = "KSC Laboratory: Pendaftaran Praktikum";

        $dataToSend["side_repo"] = $this->repo->getRepoLimit(5);
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimit(5);
        $dataToSend["side_berita"] = $this->berita->getBeritaLimit(5);

        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_tugas","",TRUE);
        $dataToSend["daftar_kcb"] = $this->daftar->getAllUserDaftar();
        $dataToSend["list_kelas"] = $this->kelas->getAllKelasAI();
        $dataToSend["jumlah_praktikan"] = $this->daftar;
        $dataToView["content"] = $this->load->view("content/user/praktikum/kcb/list_pendaftar",$dataToSend,TRUE);
        if($menu == "daftar")
        {
            if(!empty($id))
            {
                $dataToSend["status"] = $this->kelas->getStatusKelasAi();
                $dataToSend["kelas_id"] = $id;
                $data = array("kelas_id"=>$id);
                $dataToSend["kelas"] = $this->kelas->getKelasAiById($id);
                $dataToSend["jumlah_praktikan"] = $this->daftar->getCountUserDaftarById($id);
                $dataToSend["praktikan"] = $this->daftar->getUserDaftarByAtribut($data);
                $dataToView["content"] = $this->load->view("content/user/praktikum/kcb/form_daftar",$dataToSend,TRUE);
            }
        }
        if($id == "proses")
        {
            $dataToSave = array(
                "daftar_nim"=>$this->input->post("nim",TRUE),
                "daftar_nama"=>$this->input->post("nama",TRUE),
                "daftar_angkatan"=>$this->input->post("angkatan",TRUE),
                "kelas_id"=>$this->input->post("id_kelas",TRUE),
            );
            if(!preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/',$dataToSave["daftar_nim"]))
            {
                echo "not-number";
            }
            if(!preg_match('/^[a-zA-Z\ \']+$/',$dataToSave["daftar_nama"]))
            {
                echo "not-alpha";
            }
            else
            {
                $panjang_nim =  $this->input->post("count",TRUE);
                if($panjang_nim == 8)
                {
                    if(!empty($dataToSave["daftar_nim"]) AND !empty($dataToSave["daftar_nama"]) AND !empty($dataToSave["daftar_angkatan"]))
                    {
                    // imamsrifkan : periksa jumlah pendaftar berdasarkan kelas
                    $checkCount = $this->daftar->getCountUserDaftarByKelas($dataToSave["kelas_id"]);
                    // imamsrifkan : periksa jumlah kuota setiap kelas
                    $getKuota = $this->kelas->getKelasAiById($dataToSave["kelas_id"]);
                    // imamsrifkan : periksa ketersediaan kuota untuk pendaftaran
                    if($checkCount["total"] != $getKuota["kelas_kuota"])
                    {
                        $checkNim = $this->user->getDataUserByNim($dataToSave["daftar_nim"]);
                        if($checkNim)
                        {
                            $check = $this->daftar->getUserDaftarByNim($dataToSave["daftar_nim"]);
                            if($check)
                            {
                                echo "duplikat";
                            }
                            else
                            {
                                // imamsrifkan : menyimpan data user pendaftar
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
                            echo "tidak";

                        }
                    }
                    else
                    {
                        echo "penuh";
                    }  
                }
                else
                {
                    echo "kosong";
                }

                }
                else
                {
                    echo "not-8";
                }
            }
            
            exit;
        }
        else if($menu == "responsi")
        {
            $dataToView["content"] = $this->load->view("content/user/praktikum/kcb/responsi/form_responsi","",TRUE);
        }
        $this->load->view("template/template_user",$dataToView);
        
    }
}