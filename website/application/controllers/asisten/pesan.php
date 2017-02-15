<?php

class Pesan extends CI_Controller{

    private $template = "template/template_admin";
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("user_status") == 2)
		{
                    $this->load->model('m_pesan', 'pesan');
                    $this->load->model('m_tahun_ajaran', 'ta');
                    $this->load->library("pagination");
		}
		else
		{
			redirect(base_url()."asisten/login","refresh");
			exit;
		}
	}
        
        public function index()
        {
//            $config = array(
//                "base_url"=> base_url()."asisten/pesan/page/",
//                "total_rows"=> 200,
////                "per_page"=>3,
////                $this->pesan->countPesanByAttr(array("ta_id"=>  $this->session->userdata("ta_id"))),
//            );
            $datatoview["ta"] = $this->ta->getAllTahunAjaran();
            $datatosend["pesan"] = $this->pesan->getPesanByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
            $datatoview["content"] = $this->load->view("content/asisten/pesan/list_pesan",$datatosend,true);
            $this->load->view($this->template,$datatoview);
        }
        
        public function detail($id="")
        {
            $datatoview["ta"] = $this->ta->getAllTahunAjaran();
            $get = $this->pesan->getPesanById($id);
            if($get)
            {
                $datatoupdate = array(
                    "saran_id"=>$id,
                    "saran_status"=>"1",
                );
                $update = $this->pesan->updatePesan($datatoupdate);
                $datatosend["pesan"] = $get;
                $datatoview["content"] = $this->load->view("content/asisten/pesan/detail_pesan",$datatosend,true);
            }
            else
            {
                redirect(base_url()."asisten/pesan");
                exit;
            }
            $this->load->view($this->template,$datatoview);
        }
        
        public function hapus()
        {
            $id = $this->input->post("id", true);
            $delete = $this->pesan->deletePesan($id);
            
            $datatosend["status"] = $delete;
            echo json_encode($datatosend);
            exit;
        }
}