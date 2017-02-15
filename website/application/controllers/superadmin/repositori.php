<?php

class Repositori extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata("user_status") == 1)
        {
            $this->load->model("m_tahun_ajaran","ta");
            $this->load->model("m_repositori","repo");
            $this->load->library("form_validation");
        }
        else
        {
            redirect(base_url()."superadmin/login","refresh");
            exit;
        }
    }
    
    public function index()
    {
        redirect(base_url()."superadmin/repositori/materi","refresh");
        exit;   
    }

    // imamsrifkan : fungsi untuk menambahkan data repo materi
    public function materi($menu="",$id="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        
        $dataToSend["repo"]  = $this->repo->getRepoByAttr(array("ta_id"=> $this->session->userdata("ta_id")));
        $dataToView["content"] = $this->load->view("content/sadmin/repositori/materi/list_materi",$dataToSend,TRUE);
        if($menu == "tambah")
        {
            if($this->session->userdata("ta_status") == "active")
            {
                $dataToSend = array(
                "pesan"=>"",
                "class"=>"",
                );
                $dataToView["content"] = $this->load->view("content/sadmin/repositori/materi/add_materi",$dataToSend,TRUE);
            }
            else
            {
                redirect(base_url()."superadmin/repositori");
                exit;
            }
        }
        else if($menu == "hapus")
        {
            if(!empty($id))
            {
                $this->repo->deleteRepo($id);
            }
            redirect(base_url()."superadmin/repositori/materi","refresh");
            exit;
        }
        $this->load->view("template/template_sadmin",$dataToView);
    }
    


//    imamsrifkan : fungsi untuk menambahkan data repositori
    public function tambah()
    {
        if($this->session->userdata("ta_status") == "active")
        {
            $dataToSend = array(
                "pesan"=>"",
                "class"=>"",
            );
            $dataToView["content"] = $this->load->view("content/sadmin/repositori/materi/add_materi",$dataToSend,TRUE);
            $this->load->view("template/template_sadmin",$dataToView);
        }
        else
        {
            redirect(base_url()."superadmin/repositori");
            exit;
        }
    }

    // imamsrifkan : fungsi untuk mengubah data repositori
    public function edit($id="")
    {
        if(!empty($id))
        {
            if($this->session->userdata("ta_status") == "active")
            {
                $dataToSend = array(
                    "pesan"=>"",
                    "class"=>"",
                    );
                $dataToSend["repo"] = $this->repo->getRepoById($id);
                $dataToView["content"] = $this->load->view("content/sadmin/repositori/materi/edit_materi",$dataToSend,TRUE);
                $this->load->view("template/template_sadmin",$dataToView);
            }
            else
            {
                redirect(base_url()."superadmin/repositori");
                exit;
            }
        }
        else
        {
            redirect(base_url()."superadmin/repositori","refresh");
            exit;
        }
    }

    // imamsrifkan : fungsin untuk menghapus data repositori
    public function hapus($id="")
    {
        if(!empty($id))
        {
            $this->repo->deleteRepo($id);
        }
        redirect(base_url()."superadmin/repositori","refresh");
        exit;
    }
    
//    imamsrifkan : fungsi untuk proses menambahkan data repositori
    public function upload()
    {
        if($this->session->userdata("ta_status") == "active")
        {
            if($this->input->post("submit-batal"))
            {
                redirect(base_url()."superadmin/repositori/".$this->input->post("kategori-repo"),"refresh");
                exit;
            }
    //        imamsrifkan : setting tanggal dan waktu lokal
            $timestamp = now();
            $timezone = 'UP7';
            $daylight_saving = FALSE;
            $date =  unix_to_human(gmt_to_local($timestamp, $timezone, $daylight_saving));
            $zone = explode(" ", $date);
            $jam = $zone[1];
            $tanggal =$zone[0];

            $file_name = url_title($this->input->post("nama-repo"));
            $dataToSave = array(
                "repo_nama"=>$this->input->post("nama-repo",TRUE),
                "repo_tanggal"=>$tanggal." ".$jam,
                "repo_kategori"=>$this->input->post("kategori-repo",true),
                "repo_lihat"=>0,
                "ta_id"=>  $this->session->userdata("ta_id"),
            );

            $this->form_validation->set_rules("nama-repo","Nama Repositori","required");

            $config = array(
                "upload_path"=>"./_data/filerepo/",
                "allowed_types"=>"jpg|jpeg|png|zip|pdf|doc|docx|xl|xls|xlsx",
                "max_size"=>2000,
                "file_name"=>$file_name,
            );
    //        imamsrifkan : konfigurasi file upload
            $this->load->library("upload",$config);
            if($this->form_validation->run() == TRUE)
            {
                if($this->upload->do_upload())
                {
                    $file = $this->upload->data();
                    $dataToSave["repo_file"] = $file["file_name"];
                    $dataToSave["repo_tipe_file"] = $file["file_ext"];

                    $insert = $this->repo->insertRepo($dataToSave);
                    if($insert > 0)
                    {
                        $dataToSend = array(
                            "pesan"=>"Berhasil menambahkan data",
                            "class"=>"class='alert_success'",
                        );
                    }
                    else
                    {
                        $dataToSend = array(
                            "pesan"=>"Gagal menambahkan data",
                            "class"=>"class='alert_error'",
                        );
                    }
                }
                else
                {
                    $dataToSend = array(
                        "pesan"=>$this->upload->display_errors("<span>","</span>"),
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
            $dataToView["content"] = $this->load->view("content/sadmin/repositori/".$dataToSave["repo_kategori"]."/add_materi",$dataToSend,TRUE);
            $this->load->view("template/template_sadmin",$dataToView);
        }
        else
        {
            redirect(base_url()."superadmin/repositori");
            exit;
        }
    }

    // imamsrifkan : fungsi untuk proses mengubah data repositori
    public function proses_edit()
    {
        if($this->session->userdata("ta_id") == "active")
        {
            if($this->input->post("submit-batal"))
            {
                redirect(base_url()."superadmin/repositori","refresh");
                exit;
            }
    //        imamsrifkan : setting tanggal dan waktu lokal
            $timestamp = now();
            $timezone = 'UP7';
            $daylight_saving = FALSE;
            $date =  unix_to_human(gmt_to_local($timestamp, $timezone, $daylight_saving));
            $zone = explode(" ", $date);
            $jam = $zone[1];
            $tanggal =$zone[0];

            $file_name = url_title($this->input->post("nama-repo"));
            $dataToSave = array(
                "repo_id"=>$this->input->post("id-repo",TRUE),
                "repo_nama"=>$this->input->post("nama-repo",TRUE),
                "repo_tanggal"=>$tanggal." ".$jam,
            );
            $this->form_validation->set_rules("nama-repo","Nama Repositori","required");
            $config = array(
                "upload_path"=>"./_data/filerepo/",
                "allowed_types"=>"jpg|jpeg|png|zip|pdf|doc|docx|xl|xls|xlsx",
                "max_size"=>2000,
                "file_name"=>$file_name,
            );
    //        imamsrifkan : konfigurasi file upload
            $this->load->library("upload",$config);

            if($this->form_validation->run() == TRUE)
            {
                if($this->upload->do_upload())
                {
                    $file = $this->upload->data();
                    $dataToSave["repo_file"] = $file["file_name"];
                    $dataToSave["repo_tipe_file"] = $file["file_ext"];

                    $update = $this->repo->updateRepo($dataToSave);
                    if($update > 0)
                    {
                        $dataToSend = array(
                            "pesan"=>"Berhasil menambahkan data",
                            "class"=>"class='alert_success'",
                        );
                    }
                    else
                    {
                        $dataToSend = array(
                            "pesan"=>"Gagal menambahkan data",
                            "class"=>"class='alert_error'",
                        );
                    }
                }
                else
                {
                    $dataToSend = array(
                        "pesan"=>$this->upload->display_errors("<span>","</span>"),
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
            $dataToSend["repo"] = $this->repo->getRepoById($dataToSave["repo_id"]);
            $dataToView["content"] = $this->load->view("content/sadmin/repositori/edit_materi",$dataToSend,TRUE);
            $this->load->view("template/template_sadmin",$dataToView);
        }
        else
        {
            redirect(base_url()."superadmin/repositori");
            exit;
        }
    }
}