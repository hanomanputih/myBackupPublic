<?php

class Berita extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_berita","berita");
        $this->load->model("m_repositori","repo");
        $this->load->model("m_agenda","agenda");
        $this->load->library("pagination");
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
        $dataToSend["berita_kategori"] = "Berita";
        $dataToSend["title"] = "KSC Laboratory: Berita";

        $config = array(
            "base_url"=>base_url()."berita/page",
            "total_rows"=>$this->berita->countBeritaByAttr(array('ta_id'=>  $this->session->userdata("ta_id"))),
            "per_page"=>5,
            "prev_link"=>false,
            "next_link"=>false,
            );
        $this->pagination->initialize($config);
        $dataToSend["side_repo"] = $this->repo->getRepoLimitByAttr(5,array('website_repositori.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
        $dataToSend["side_berita"] = $this->berita->getBeritaLimitByAttr(5,array('website_berita.ta_id'=>  $this->session->userdata("ta_id")));
        
        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_beranda","",TRUE);
        $dataToSend["berita"] = $this->berita->getBeritaByPageByAttr(array('website_berita.ta_id'=>  $this->session->userdata("ta_id")),$config["per_page"],$this->uri->segment(3));
        $dataToView["content"] = $this->load->view("content/user/berita/list_berita",$dataToSend,TRUE);
        $this->load->view("template/template_user",$dataToView);
    }

    // imamsrifkan : fungsi untuk menampilkan berita berdasarkan page
    public function page()
    {
        $dataToSend["berita_kategori"] = "Berita";
        $dataToSend["title"] = "KSC Laboratory: Berita";

        $config = array(
            "base_url"=>base_url()."berita/page",
            "total_rows"=>$this->berita->countAllBerita(),
            "per_page"=>5,
            "num_links"=>10,
            "prev_link"=>false,
            "next_link"=>false,
            "cur_tag_open"=>" [<span style='font-weight:normal'>",
            "cur_tag_close"=>"</span>]",
            );

        $this->pagination->initialize($config);
        $dataToSend["side_repo"] = $this->repo->getRepoLimit(5);
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimit(5);
        $dataToSend["side_berita"] = $this->berita->getBeritaLimit(5);
        
        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_beranda","",TRUE);
        $dataToSend["berita"] = $this->berita->getAllBeritaByPage($config["per_page"],$this->uri->segment(3));
        $dataToView["content"] = $this->load->view("content/user/berita/list_berita",$dataToSend,TRUE);
        $this->load->view("template/template_user",$dataToView);
    }
    
//    imamsrifkan : fungsi untuk melihat detail berita
    public function detail($title="")
    {
//            imamsrifkan : update data berita untuk jumlah akses berita
            $view = $this->berita->getBeritaByTitle($title);

            $dataToSend["title"] = "KSC Laboratory: ".$view["berita_judul"];

            $dataToUpdate = array(
              "berita_id"=>$view["berita_id"],
              "berita_lihat"=>$view["berita_lihat"]+1,
            );
            $this->berita->updateBeritaView($dataToUpdate);
            
            $dataToSend["side_repo"] = $this->repo->getRepoLimit(5);
            $dataToSend["side_agenda"] = $this->agenda->getAgendaLimit(5);
            $dataToSend["side_berita"] = $this->berita->getBeritaLimit(5);
        
            $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_beranda","",TRUE);
            $dataToSend["berita"] = $this->berita->getBeritaByTitle($title);
            $dataToView["content"] = $this->load->view("content/user/berita/detail_berita",$dataToSend,TRUE);;
            $this->load->view("template/template_user",$dataToView);
    }

    // imamsrifkan : fungsi untuk menampilkan berita berdasarkan keyword yang dicari
    public function cari($key="")
    {
        $dataToSend["title"] = "KSC Laboratory: ".$key;
        $dataToSend["berita_kategori"] = "Pencarian";
        $dataToSend["side_repo"] = $this->repo->getRepoLimit(5);
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimit(5);
        $dataToSend["side_berita"] = $this->berita->getBeritaLimit(5);

        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_beranda","",TRUE);
        $dataToSend["berita"] = $this->berita->getBeritaByKey($key);
        $dataToView["content"] = $this->load->view("content/user/berita/list_berita",$dataToSend,TRUE);
        $this->load->view("template/template_user",$dataToView);
    }
    
//    imamsrifkan : fungsi untuk melihat berita berdasarkan praktikum
    public function praktikum($kategori="")
    {
        $dataToSend["title"] = "KSC Laboratory: Pengumuman";
        
        $dataToSend["side_repo"] = $this->repo->getRepoLimit(5);
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimit(5);
        $dataToSend["side_berita"] = $this->berita->getBeritaLimit(5);
        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_beranda","",TRUE);
        if(!empty($kategori))
        {
            $dataToSend["berita"] = $this->berita->getBeritaByPraktikum($kategori);
        }
        else
        {
            $dataToSend["berita"] = $this->berita->getBeritaByKategori("pengumuman");
        }
        $dataToSend["berita_kategori"] = "pengumuman";
        $dataToView["content"] = $this->load->view("content/user/berita/list_berita",$dataToSend,TRUE);
        $this->load->view("template/template_user",$dataToView);
    }
    
//    imamsrifkan : fungsi untuk melihat berita berdasarkan kategori
    public function agenda($kategori="")
    {
        $dataToSend["title"] = "KSC Laboratory: Agenda";
        
        $dataToSend["side_repo"] = $this->repo->getRepoLimit(5);
        $dataToSend["side_agenda"] = $this->agenda->getAgendaLimit(5);
        $dataToSend["side_berita"] = $this->berita->getBeritaLimit(5);
        $dataToSend["sub_menu"] = $this->load->view("content/user/sub_menu/menu_beranda","",TRUE);
        if(!empty($kategori))
        {
            $dataToSend["berita"] = $this->berita->getBeritaByAgenda($kategori);
        }
        else
        {
            $dataToSend["berita"] = $this->berita->getBeritaByKategori("agenda");
        }
        $dataToSend["berita_kategori"] = "agenda";
        $dataToView["content"] = $this->load->view("content/user/berita/list_berita",$dataToSend,TRUE);
        $this->load->view("template/template_user",$dataToView);
    }
}