<?php

class Berita extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata("user_status") == 2)
        {
            $this->load->model("m_tahun_ajaran","ta");
            $this->load->library("form_validation");
            $this->load->model("m_berita","berita");
        }
        else
        {
            redirect(base_url()."asisten/login");
            exit;
        }   
    }
    
//    imamsrifkan : fungsi untuk melihat berita
    public function index()
    {           
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        $dataToSend["berita"] = $this->berita->getBeritaByAtribut(array("ta_id"=>$this->session->userdata("ta_id")));
        $dataToView["content"] = $this->load->view("content/asisten/berita/list_berita",$dataToSend,TRUE);
        $this->load->view("template/template_admin",$dataToView);
    }
    
//    imamsrifkan : fungsi untuk menambah berita
    public function tambah()
    {
        if($this->session->userdata("ta_status") == "active")
        {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend = array(
            "pesan"=>"",
            "class"=>"",
        );
        if($this->input->post("tambah"))
        {
            $this->form_validation->set_rules("judul","judul","required");
            $this->form_validation->set_rules("isi","isi","required");
            if($this->form_validation->run() == TRUE)
            {
               $config = array(
                "upload_path"=>"./_data/fileberita/",
                "allowed_types"=>"jpg|jpeg|png|pdf|doc|docx|xl|xls|xlsx",
                "max_size"=>2000,
                );
                $this->load->library("upload",$config);
//                imamsrifkan : waktu
                $timestamp = now();
                    $timezone = 'UP7';
                    $daylight_saving = FALSE;
                    $time =  date("Y-m-d H:i:s",(gmt_to_local($timestamp, $timezone, $daylight_saving)));
                
                 $dataToSave = array(
                    "berita_judul"=>$this->input->post("judul",TRUE),
                    "berita_title"=>  url_title($this->input->post("judul",TRUE)),
                    "berita_praktikum"=>$this->input->post("praktikum",TRUE),
                    "berita_kategori"=>$this->input->post("kategori",TRUE),
                    "berita_isi"=>$this->input->post("isi",TRUE),
                    "user_username"=>$this->session->userdata("user_id"),
                    "berita_tanggal"=> $time,
                    "berita_lihat"=>0,
                    );
                
                if($this->upload->do_upload())
                {
                    $file = $this->upload->data();
                    $dataToSave["berita_file"] = $file["file_name"];
                    $dataToSave["berita_tipe_file"] = $file["file_ext"];
                    $judul_file = $this->input->post("judul-file",TRUE);
                    if(!empty($judul_file))
                    {
                        $dataToSave["berita_judul_file"] = $judul_file;
                    }
                    else
                    {
                        $dataToSave["berita_judul_file"] = $this->input->post("judul",TRUE);
                    }
                    
                }
                else
                {
                    $dataToSave["berita_file"] = "";
                    $dataToSave["berita_tipe_file"] = "";
                    $dataToSave["berita_judul_file"] = $this->input->post("judul",TRUE);
                }
                
               
                
                $insert = $this->berita->insertBerita($dataToSave);
                if($insert > 0)
                {
                    $dataToSend = array(
                    "pesan"=>"<span>Berita berhasil di simpan</span>",
                    "class"=>"class='alert_success'",
                    );
                }
                else
                {
                    $dataToSend = array(
                    "pesan"=>"<span>Berita gagal di simpan</span>",
                    "class"=>"class='alert_error'",
                    );
                }
                
            }
            else
            {
                $dataToSend = array(
                    "pesan"=>validation_errors("<span>","</span>"),
                    "class"=>"class='alert_error'",
                    );
            }
        }
        else if($this->input->post("batal"))
        {
            redirect(base_url()."asisten/berita","refresh");
            exit;
        }
        $dataToView["content"] = $this->load->view("content/asisten/berita/add_berita",$dataToSend,TRUE);
        $this->load->view("template/template_admin",$dataToView);
        }
        else
        {
            redirect(base_url()."asisten/berita");
            exit;
        }
    }
    
//    imamsrifkan : fungsi untuk menghapus berita
    public function hapus($id)
    {
        if(!empty($id))
        {
            $delete = $this->berita->deleteBerita($id);
            
        }
            redirect(base_url()."asisten/berita","refresh");
            exit;
    }
    
//    imamsrifkan : fungsi untuk menampilkan form edit berita
    public function edit($id="",$action="")
    {
        if($this->session->userdata("ta_status") == "active")
        {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        if(!empty($id))
        {
                $dataToSend = array(
                "pesan"=>"",
                "class"=>"",
                );
                $dataToSend["berita"] = $this->berita->getBeritaById($id);
                if($action == "proses")
                {
                    if($this->input->post("batal"))
                    {
                        redirect(base_url()."asisten/berita","refresh");
                    }
                    $timestamp = now();
                    $timezone = 'UP7';
                    $daylight_saving = FALSE;
                    $time =  date("Y-m-d H:i:s",(gmt_to_local($timestamp, $timezone, $daylight_saving)));

                    $dataToSave = array(
                        "berita_id"=>$this->input->post("id-berita",TRUE),
                        "berita_judul"=>$this->input->post("judul",TRUE),
                        "berita_title"=>  url_title($this->input->post("judul",TRUE)),
                        "berita_praktikum"=>$this->input->post("praktikum",TRUE),
                        "berita_kategori"=>$this->input->post("kategori",TRUE),
                        "berita_isi"=>$this->input->post("isi",TRUE),
                        "user_username"=>$this->session->userdata("user_id"),
                        "berita_judul_file"=>$this->input->post("judul-file",TRUE),
                        "berita_tanggal"=> $time,
                        // "berita_lihat"=>0,
                        );

                    $this->form_validation->set_rules("judul","judul berita","required");
                    $this->form_validation->set_rules("isi","isi berita","required");
                    if($this->form_validation->run() == TRUE)
                    {
                        $config = array(
                        "upload_path"=>"./_data/fileberita/",
                        "allowed_types"=>"jpg|jpeg|png|pdf|doc|docx|xl|xls|xlsx|zip",
                        "max_size"=>2000,
                        );
                        $this->load->library("upload",$config);
                        if($this->upload->do_upload())
                        {
                            $file = $this->upload->data();
                            $dataToSave["berita_file"] = $file["file_name"];
                            $dataToSave["berita_tipe_file"] = $file["file_ext"];

                        }
                        else
                        {
                            $dataToSave["berita_file"] = "";
                            $dataToSave["berita_tipe_file"] = "";
                        }
                        $update = $this->berita->updateBerita($dataToSave);
                        if($update > 0)
                        {
                            $dataToSend = array(
                            "pesan"=> "Berhasil mengubah data",
                            "class"=>"class='alert_success'",
                            );
                        }
                        else
                        {
                            $dataToSend = array(
                            "pesan"=> "Gagal mengubah data",
                            "class"=>"class='alert_error'",
                            );
                        }
                    }
                    else
                    {
                        $dataToSend = array(
                            "pesan"=>  validation_errors("<span>","</span>"),
                            "class"=>"class='alert_error'",
                        );
                    }
                    $dataToSend["berita"] = $this->berita->getBeritaById($dataToSave["berita_id"]);
                }
        }
        else
        {
            redirect(base_url()."asisten/berita","refresh");
            exit;
        }
        $dataToView["content"] = $this->load->view("content/asisten/berita/edit_berita",$dataToSend,TRUE);
        $this->load->view("template/template_admin",$dataToView);
        }
        else
        {
            redirect(base_url()."asisten/berita");
            exit;
        }
        
    }

    public function detail($title="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend["berita"] = $this->berita->getBeritaByTitle($title);
        $dataToView["content"] = $this->load->view("content/asisten/berita/detail_berita",$dataToSend,TRUE);
        $this->load->view("template/template_admin",$dataToView);
    }    
//    imamsrifkan : fungsi untuk proses ubah berita
    public function proses()
    {
        
    }
    
    public function lihat()
    {
        
    }
}