<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_login","login");
        $this->load->model('m_user', 'user');
    }
    
    public function index()
    {
        if($this->session->userdata("user_status") == 2)
        {
            redirect(base_url()."asisten/menu","refresh");
            exit;
        }
        else
        {
            $dataToSend["title"] = "Login Asisten";
            $dataToView['content'] = $this->load->view("content/asisten/login",$dataToSend,TRUE);
            $this->load->view("template/template_login",$dataToView);
        }
    }
    
    public function ceklogin()
    {
        if($this->session->userdata("user_status") == 2)
        {
            redirect(base_url()."asisten/menu","refresh");
            exit;
        }
        else
        {
            $dataToCheck = array(
            'user_username'=>  $this->input->post("username",true),
            'user_password'=>  md5($this->input->post("password",true)),
            'user_status'=>2,
            ); 

            // imamsrifkan : jika username atau password masih kosong
            if(!empty($dataToCheck["user_username"]) AND !empty($dataToCheck["user_password"]))
            {
                $get = $this->login->login($dataToCheck);
                if($get)
                {
//                    imamsrifkan : update waktu login
//                    setting waktu
                   $time = date("Y-m-d H:i:s",gmt_to_local(time(), "UP7"));
                   $datatoupdate = array(
                       "user_id"=> $get["user_id"],
                       "user_username"=>$dataToCheck["user_username"],
                       "user_login"=> $time,
                       "user_session"=>"active",
                   );
                   $update = $this->user->updateUser($datatoupdate);
                   
                    $this->session->set_userdata("id_user",$get["user_id"]);
                    $this->session->set_userdata("user_id",$get['user_username']);
                    $this->session->set_userdata("user_status",$get['user_status']);
                    $this->session->set_userdata("user_jabatan",$get["jabatan_nama"]);
                    $ceklogin["status"] = true;
                    echo json_encode($ceklogin);
                    exit;
                }
                else
                {
                    $ceklogin["status"] = false;
                    echo json_encode($ceklogin);
                    exit;
                }
            }

        }
      exit;        
    }
    
    public function logout()
    {
        $datatoupdate = array(
            "user_id"=> $this->session->userdata("id_user"),
            "user_session"=>"inactive",
        );
        $update = $this->user->updateUser($datatoupdate);
        
        $this->session->unset_userdata("id_user");
        $this->session->unset_userdata("user_id");
        $this->session->unset_userdata("user_status");
        $this->session->sess_destroy();
        
        
        redirect(base_url()."asisten/login");
        exit;
    }
}