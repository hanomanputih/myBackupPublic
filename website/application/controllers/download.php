<?php

class Download extends CI_controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_repositori","repo");
        $this->load->model("m_agenda","agenda");
        $this->load->model("m_berita","berita");
        $this->load->model('m_general', 'general');
        
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
        $dataToSend["title"] = "KSC Laboratory: Download";

        $dataToSend["side_repo"] = $this->repo->getRepoLimitByAttr(5,array('website_repositori.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["side_berita"] = $this->berita->getBeritaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_beranda","",TRUE);
        
        $dataToSend["repo"] = $this->repo->getRepoByAttr(array('ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["latest"] = $this->repo->getLatestRepo();
        $dataToView["content"] = $this->load->view("content/user/download/list_download",$dataToSend,TRUE);
        $this->load->view("template/template_user",$dataToView);
    }
    
//    imamsrifkan : menambahkan data total di download
    public function lihat($id="")
    {
        if(!empty($id))
        {
            $get = $this->repo->getRepoById($id);
            if($get)
            {
                $dataToUpdate = array(
                    "repo_id"=>$id,
                    "repo_lihat"=>$get["repo_lihat"]+1,
                );
                $update = $this->repo->updateCountRepo($dataToUpdate);
            }
            
        }
        
    }
}