<?php

class Menu extends CI_Controller
{
    private $template = "template/template_admin";
	public function __construct()
	{
            parent::__construct();
            if($this->session->userdata("user_status") == 2)
            {
                $this->load->model("m_tahun_ajaran","ta");
                $this->load->model('m_user', 'user');
                $this->load->model('m_pesan','pesan');
            }
            else
            {
                redirect(base_url()."asisten/login","refresh");
                exit;
            }
	}
        

    public function index()
    {
    	// imamsrifkan : hapus session dari tahun ajaran
    	$this->session->unset_userdata("ta_status");

        $dataToView["ta_active"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"active"));
        $dataToView["ta_inactive"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"inactive"));
        
        $datatosend["akun"] = $this->user->getUserById($this->session->userdata("id_user"));
        $datatosend["user"] = $this->user->getUserByAttr(array("user_session"=>"active"));
        $datatosend["last_login"] = $this->user->getUserLimit(5);
        $datatosend["pesan"] = $this->pesan->getPesanByAttr(array("saran_status"=>"0"));
        $dataToView["content"] = $this->load->view("content/asisten/dashboard/dashboard_menu",$datatosend,TRUE);
        $this->load->view($this->template,$dataToView);
    }

    public function akun($action="",$id="")
    {   
        // imamsrifkan : hapus session dari tahun ajaran
        $this->session->userdata("ta_status");
        $datatosend["akun"] = $this->user->getUserById($this->session->userdata('id_user'));
        $datatoview["ta_active"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"active"));
        $datatoview["ta_inactive"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"inactive"));
        $datatoview["content"] = $this->load->view("content/asisten/pengaturan/akun/detail_akun",$datatosend,true);
        if($action == "edit")
        {
            $datatosend["akun"] = $this->user->getuserById($this->session->userdata("id_user"));
            $datatoview["content"] = $this->load->view("content/asisten/pengaturan/akun/edit_akun",$datatosend,true);
        }
        else if($action == "validasi")
        {
           
            $username = $this->input->post("username", true);
            $password = $this->input->post("password", true);
            $password_new = $this->input->post("password_new", true);
            if(!empty($password))
            {
                 $datatoget = array(
                "user_id"=>  $this->input->post("id", true),
                "user_password"=>md5($this->input->post("password", true)),
                );
                $get = $this->user->getUserByAttr($datatoget);
                if($get)
                {
                    if(( ! preg_match("/^([a-z0-9])+$/i", $username)))
                    {
                        $datatoshow["variable"] = "Username";
                        $datatoshow["message"] = "alpha";
                    }
                    if(empty($password_new))
                    {
                        $datatoshow["message"] = "empty";
                    }
                    else if((strlen($password_new) < 6) OR (strlen($password_new) > 32))
                    {
                        $datatoshow["message"] = "strength";
                    }
                    else if(( ! preg_match("/^([a-z0-9])+$/i", $password_new)))
                    {
                        $datatoshow["variable"] = "Password Baru";
                        $datatoshow["message"] = "alpha";
                    }
                    else
                    {
                        $datatosave = array(
                        "user_id"=>  $this->input->post("id", true),
                        "user_username"=>  $this->input->post("username", true),
                        "user_password "=>md5($this->input->post("password_new", true)),
                        );
                        $update = $this->user->updateUser($datatosave);
                        if($update > 0)
                        {
                            $datatoshow["message"] = true;
                        }
                        else
                        {
                            $datatoshow["message"] = false;
                        }
                    }
                    
                }
                else
                {
                    $datatoshow["message"] = "invalid";
                }
            }
            else
            {
                $datatoshow["message"] = "empty";
            }
            
            echo json_encode($datatoshow);
            exit;
        }
        $this->load->view($this->template,$datatoview);
    }
    
    public function aktifasi()
    {
        $datatosend["ta"] = $this->ta->getAllTahunAjaran();
        $datatosend["ta_active"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"active"));
        $datatosend["ta_inactive"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"inactive"));
        $datatoview["content"] = $this->load->view("content/asisten/aktifasi/tahun_ajaran/list_tahun_ajaran",$datatosend,true);
        $this->load->view($this->template,$datatoview);
    }

    public function ta($menu="",$id="")
    {
        // imamsrifkan : hapus session dari tahun ajaran
        $this->session->unset_userdata("ta_status");

        $datatosend["tahun_ajaran"] = $this->ta->getAllTahunAjaran();
        $datatoview["ta_active"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"active"));
        $datatoview["ta_inactive"] = $this->ta->getTahunAjaranByAtribut(array("ta_status"=>"inactive"));
        $datatoview["content"] = $this->load->view("content/asisten/pengaturan/tahun_ajaran/list_tahun_ajaran",$datatosend,true);
        if($menu == "tambah")
        {
            $datatoview["content"] = $this->load->view("content/asisten/pengaturan/tahun_ajaran/add_tahun_ajaran",$datatosend,true);
        }
        else if($menu == "edit")
        {
            $datatosend["tahun_ajaran"] = $this->ta->getTahunAjaranById($id);
            $datatoview["content"] = $this->load->view("content/asisten/pengaturan/tahun_ajaran/edit_tahun_ajaran",$datatosend,TRUE);
        }
        else if($menu == "hapus")
        {
            if(!empty($id))
            {
                $delete = $this->ta->deleteTahunAjaran($id);
                redirect(base_url()."asisten/menu/ta");
                exit;
            }
        }
        $this->load->view($this->template,$datatoview);
    }

    public function simpanta()
    {
        $dataToSave = array(
            "ta_nama"=>  $this->input->post("nama_ta",TRUE),
            "ta_status"=>"active",
        );
        if(!empty($dataToSave["ta_nama"]))
        {
            $check = $this->ta->getTahunAjaranByAtribut($dataToSave);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $update = $this->ta->updateAllTahunAjaran(array("ta_status"=>"inactive"));
                $insert = $this->ta->insertTahunAjaran($dataToSave);
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
            echo "kosong";
        }
    }

    public function editta()
    {
        $dataToSave = array(
            "ta_id"=>  $this->input->post("id_ta",TRUE),
            "ta_nama"=>  $this->input->post("nama_ta",TRUE),
        );
        if(!empty($dataToSave["ta_nama"]))
        {
            $check = $this->ta->getTahunAjaranExceptByAtribut($dataToSave);
            if($check)
            {
                echo "duplikat";
            }
            else
            {
                $update = $this->ta->updateTahunAjaran($dataToSave);
                if($update > 0)
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
            echo "kosong";
        }
    }
}