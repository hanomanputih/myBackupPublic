<?php

class Tugas extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata("user_status") == 2)
        {
            $this->load->model("m_tugas","tugas");
            $this->load->model("m_kelas","kelas");
            $this->load->model("m_modul","modul");
            $this->load->model("m_tahun_ajaran","ta");
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

        $dataToSend["tugas"] = $this->tugas->getTugasByAttr(array("website_kelas_tugas.ta_id"=>  $this->session->userdata("ta_id"),"website_tugas.user_id"=>  $this->session->userdata("id_user")));
        $dataToSend["kelas_tugas"] = $this->kelas->getKelasTugasByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
        $dataToSend["aktif"] = $this->kelas->getActiveKelasTugas(array("kelas_status"=>"aktif","ta_id"=>  $this->session->userdata("ta_id")));
        $dataToView["content"] = $this->load->view("content/asisten/tugas/list_tugas",$dataToSend,TRUE);
        $this->load->view("template/template_admin",$dataToView);
    }
    
//    imamsrifkan : fungsi mengambil data tugas berdasarkan kelas
    public function kelas($kelas="")
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToSend["sidebar"] = $this->load->view("content/asisten/tugas/right_side","",TRUE);
        $dataToSend["aktif"] = $this->kelas->getActiveKelasTugas(array("kelas_status"=>"aktif","ta_id"=>  $this->session->userdata("ta_id")));
        if(!empty($kelas))
        {
            $dataToSend["tugas"] = $this->tugas->getTugasByKelas($kelas,array("website_kelas_tugas.ta_id"=>  $this->session->userdata("ta_id"),"website_tugas.user_id"=>  $this->session->userdata("id_user")));
            $dataToSend["kelas_tugas"] = $this->kelas->getKelasTugasByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
            $dataToView["content"] = $this->load->view("content/asisten/tugas/list_tugas",$dataToSend,TRUE);
            $this->load->view("template/template_admin",$dataToView);
        }
        else
        {
            $this->index();
        }
    }
    
//    imamsrifkan : form untuk upload tugas
    public function upload()
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();

        $dataToView["content"] = $this->load->view("content/user/upload/form_upload","",TRUE);
        $this->load->view("template/template_user",$dataToView);
    }

    // imamsrifkan : fungsi hapus tugas
    public function hapus()
    {
        $data = array(
            "id"=>  $this->input->post("id",TRUE),
        );
        $delete = $this->tugas->deleteTugas($data["id"]);
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
    
    public function proses_upload()
    {
        // imamsrifkan : konfigurasi tahun ajaran tiap laporan
        $dataToView["ta"] = $this->ta->getAllTahunAjaran();
        
//        imamsrifkan : konfigurasi untuk file yang di upload
        $config = array(
            "upload_path"=>"./_data/filetugas/",
            "allowed_types"=>"zip|rar",
            "max_size"=>1000
        );
        
        $this->load->library("upload",$config);
        
        if(!$this->upload->do_upload())
        {
            $dataToSend["error"] = $this->upload->display_errors();
            $dataToView["content"] = $this->load->view("content/user/upload/error",$dataToSend,TRUE);
            $this->load->view("template/template_user",$dataToView);
        }
        else
        {
            $dataToSend["data"] = $this->upload->data();
            $dataToView["content"] = $this->load->view("content/user/upload/success",$dataToSend,TRUE);
            $this->load->view("template/template_user",$dataToView);
        }
    }
}