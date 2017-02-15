<?php

class Pesan extends CI_Controller{

    private $template = "template/template_sadmin";
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata("user_status") == 1)
		{
                    $this->load->model('m_pesan', 'pesan');
                    $this->load->model('m_tahun_ajaran', 'ta');
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
            $datatoview["ta"] = $this->ta->getAllTahunAjaran();
            $datatosend["pesan"] = $this->pesan->getPesanByAttr(array("ta_id"=>  $this->session->userdata("ta_id")));
            $datatoview["content"] = $this->load->view("content/sadmin/pesan/list_pesan",$datatosend,true);
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
                $datatoview["content"] = $this->load->view("content/sadmin/pesan/detail_pesan",$datatosend,true);
            }
            else
            {
                redirect(base_url()."superadmin/pesan");
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