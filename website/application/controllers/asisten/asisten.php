<?php

class Asisten extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata("user_status") == 2)
        {
            $this->load->model("m_tahun_ajaran","ta");
            $this->load->model("m_asisten","asisten");
            $this->load->model("m_jabatan","jabatan");
            $this->load->library("form_validation");
        }
        else
        {
            redirect(base_url()."asisten/login","refresh");
            exit;
        }
    }
    
    public function index()
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        $dataToSend["asisten"] = $this->asisten->getAsistenByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToView["content"] = $this->load->view("content/asisten/asisten/list_asisten",$dataToSend,TRUE);
        $this->load->view("template/template_admin",$dataToView);
    }
    
//    imamsrifkan : fungsi untuk menambahkan data asisten
    public function tambah($action="")
    {
        if($this->session->userdata("ta_status") == "active")
        {
            // imamsrifkan : konfigurasi tahun ajaran tiap laporan
            $dataToView["ta"] = $this->ta->getAllTahunAjaran();

            $dataToSend = array(
                "pesan"=>"",
                "class"=>"",
            );

            if($action == "proses")
            {
                $this->form_validation->set_rules("nim","Nim","required|exact_length[8]|numeric|is_unique[website_user.user_username]");
                $this->form_validation->set_rules("nama","nama","required|min_length[3]");
                $this->form_validation->set_rules("angkatan","angkatan","required|exact_length[4]|is_number");
                $this->form_validation->set_rules("password","password","min_length[6]");
                $this->form_validation->set_rules("j-k","jenis kelamin","required");
                $this->form_validation->set_rules("jabatan","jabatan","required");

                if($this->form_validation->run() == TRUE)
                {
                    $dataToSave = array(
                        "user_username"=>$this->input->post("nim",TRUE),
                        "user_nama"=>$this->input->post("nama",TRUE),
                        "user_angkatan"=>$this->input->post("angkatan",TRUE),
                        "user_password"=>md5("ksc-laboratory"),
                        "user_jenis_kelamin"=>$this->input->post("j-k",TRUE),
                        "ta_id"=>  $this->session->userdata("ta_id"),
                        "jabatan_id"=>$this->input->post("jabatan",TRUE),
                        "user_status"=>2,
                    );
                    $insert  = $this->asisten->insertAsisten($dataToSave);
                    if($insert > 0)
                    {
                        $dataToSend = array(
                            "pesan"=>"Berhasil menambahkan data asisten.",
                            "class"=>"class = 'alert_success'",
                        );
                    }
                    else
                    {
                        $dataToSend = array(
                            "pesan"=>"Gagal menambahkan data asisten",
                            "class"=>"class = 'alert_error'",
                        );
                    }
                }
                else
                {
                    $dataToSend = array(
                        "pesan"=>  validation_errors("<span>","</span>"),
                        "class"=>  "class = 'alert_error'",
                    );
                }
            }
            $dataToSend["jabatan"] = $this->jabatan->getAllJabatan();
            $dataToView["content"] = $this->load->view("content/asisten/asisten/add_asisten",$dataToSend,TRUE);
            $this->load->view("template/template_admin",$dataToView);
        }
        else
        {
            redirect(base_url()."asisten/asisten");
            exit;
        }
    }
    
//    imamsrifkan : fungsi untuk edit asisten
    public function edit($id="",$action="")
    {
        if($this->session->userdata("ta_status") == "active")
        {
            // imamsrifkan : konfigurasi tahun ajaran tiap laporan
            $dataToView["ta"] = $this->ta->getAllTahunAjaran();

            $dataToSend = array(
                "pesan"=>"",
                "class"=>"",
            );
    //        imamsrifkan : menyimpan hasil perubahan data user
            if($action == "proses")
            {
                $this->form_validation->set_rules("nim","nim","required|exact_length[8]|is_number");
                $this->form_validation->set_rules("nama","nama","required|min_length[3]");
                $this->form_validation->set_rules("angkatan","angkatan","required|exact_length[4]|is_number");

                if($this->form_validation->run() == TRUE)
                {
                    $dataToSave = array(
                            "user_id"=>  $id,
                            "user_username"=>  $this->input->post("nim",TRUE),
                            "user_nama"=>  $this->input->post("nama",TRUE),
                            "user_jenis_kelamin"=>  $this->input->post("j-k",TRUE),
                            "user_angkatan"=>  $this->input->post("angkatan",TRUE),
                            "jabatan_id"=> $this->input->post("jabatan",TRUE),
                    );
        //            imamsrifkan : jika pasword juga diubah
                    if($this->input->post("password") != "")
                    {
                        $this->form_validation->set_rules("password","password","min_length[6]");
                        $dataToSave["user_password"] = md5($this->input->post("password",TRUE));
                    }
                    $update = $this->asisten->updateAsisten($dataToSave);
                    if($update > 0)
                    {
                        $dataToSend = array(
                            "pesan"=>"Berhasil mengubah data asisten.",
                            "class"=>"class = 'alert_success'",
                        );
                    }
                    else
                    {
                        $dataToSend = array(
                            "pesan"=> "Gagal mengubah data asisten",
                            "class"=>"class = 'alert_error'",
                        );
                    }
                }
                else
                {
                    $dataToSend = array(
                            "pesan"=> validation_errors("<span>","</span>"),
                            "class"=>"class = 'alert_error'",
                        );
                }
            }
            $dataToSend["asisten"] = $this->asisten->getAsistenById($id);
            if(!$dataToSend["asisten"])
            {
                redirect(base_url()."asisten/asisten");
                exit;
            }
            $dataToSend["jabatan"] = $this->jabatan;
            $dataToView["content"] = $this->load->view("content/asisten/asisten/edit_asisten",$dataToSend,TRUE);
            $this->load->view("template/template_admin",$dataToView);
        }
        else
        {
            redirect(base_url()."asisten/asisten");
            exit;
        }
    }
    
//    imamsrifkan : fungsi untuk menghapus data asisten
    public function hapus($id="")
    {
            $delete = $this->asisten->deleteAsisten($id);
            if($delete > 0)
            {
                redirect(base_url()."asisten/asisten","refresh");
            }
            else
            {
                redirect(base_url()."asisten/asisten","refresh");
            }
            exit;
    }
    
//    imamsrifkan : fungsi untuk menyimpan proses ubah data asisten
    public function edit_asisten()
    {
        $dataToSave = array(
            "user_id"=>$this->input->post("id_asisten",TRUE),
            "user_username"=>$this->input->post("nim_asisten",TRUE),
            "user_nama"=>$this->input->post("nama_asisten",TRUE),
            "user_jenis_kelamin"=>$this->input->post("jenis_kelamin",TRUE),
            "user_angkatan"=>$this->input->post("angkatan_asisten",TRUE),
            "jabatan_id"=>$this->input->post("jabatan_asisten",TRUE),
        );
        if(!empty($dataToSave["user_nama"]) AND !empty($dataToSave["user_angkatan"]))
        {
            $update = $this->asisten->updateAsisten($dataToSave);
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
            echo FALSE;
        }
    }
}