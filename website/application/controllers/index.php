<?php

class Index extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_berita","berita");
        $this->load->model("m_agenda","agenda");
        $this->load->model('m_general', 'general');
        $this->load->model("m_repositori","repo");
        
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
        $dataToSend["title"] = "KSC Laboratory";
        
        $dataToSend["side_repo"] = $this->repo->getRepoLimitByAttr(5,array('website_repositori.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["side_berita"] = $this->berita->getBeritaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["berita"] = $this->berita->getBeritaAndAgendaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_beranda","",TRUE);
        $dataToView["content"] = $this->load->view("content/user/beranda/view_beranda",$dataToSend,TRUE);
        $this->load->view("template/template_user",$dataToView);
    }
}