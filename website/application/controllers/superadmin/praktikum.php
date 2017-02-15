<?php if(! defined('BASEPATH')) exit('No direct script accept allowed');

class Praktikum extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata("user_status") == 1)
        {
            $this->load->model("m_kelas_praktikum","kelas_praktikum");
            $this->load->model("m_user_daftar","user_daftar");
        }
        else
        {
            redirect(base_url()."superadmin/login","refresh");
            exit;
        }
    }
    
    public function index()
    {
        $dataToSend["kelas_praktikum"] = $this->kelas_praktikum->getAllKelas();
        $dataToView["content"] = $this->load->view("content/sadmin/kelas_praktikum/list_kelas",$dataToSend,TRUE);
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi lihat kelas praktikum ai
    public function ai($menu="")
    {
        if($menu == "")
        {
            redirect(base_url()."superadmin/praktikum/ai/kelas","refresh");
            exit;
        }
        else if($menu == "kelas")
        {
            $dataToSend["kelas_praktikum"] = $this->kelas_praktikum->getAllKelas();
            $dataToSend["jumlah_praktikan"] = $this->user_daftar;
            $dataToView["content"] = $this->load->view("content/sadmin/praktikum_ai/list_kelas",$dataToSend,TRUE);
        }
        else if($menu == "praktikan")
        {
            $dataToSend["praktikan"] = $this->user_daftar->getAllUserDaftar();
            $dataToView["content"] = $this->load->view("content/sadmin/praktikum_ai/list_praktikan",$dataToSend,TRUE);
        }
        
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi tambah kelas praktikum
    public function tambah()
    {
        $dataToView["content"] = $this->load->view("content/sadmin/kelas_praktikum/add_kelas","",TRUE);
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi update kelas praktikum
    public function edit($id="")
    {
        if(empty($id))
        {
            redirect(base_url()."superadmin/praktikum","refresh");
            exit;
        }
        else
        {
            $dataToSend["kelas_praktikum"] = $this->kelas_praktikum->getKelasById($id);
            $dataToView["content"] = $this->load->view("content/sadmin/kelas_praktikum/edit_kelas",$dataToSend,TRUE);
            $this->load->view("template/template_sadmin",$dataToView);
        }
    }
    
//    imamsrifkan : fungsi untuk menghapus data kelas praktikum
    public function hapus($id="")
    {
        if(!empty($id))
        {
            $delete = $this->kelas_praktikum->deleteKelas($id);
        }
        redirect(base_url()."superadmin/praktikum","refresh");
        exit;
    }
    
    public function praktikan($action="")
    {
        $dataToSend["kelas_praktikum"] = $this->kelas_praktikum->getAllKelas();
        $dataToSend["daftar_kelas"] = $this->kelas_praktikum->getDaftarKelas();
        $dataToView["content"] = $this->load->view("content/sadmin/kelas_praktikum/add_praktikan",$dataToSend,TRUE);
        $this->load->view("template/template_sadmin",$dataToView);
    }
    
//    imamsrifkan : fungsi proses tambah kelas praktikum
    public function proses_tambah()
    {
        
    }
    
//    imamsrifkan : fungsi proses update data kelas praktikum
    public function proses_edit()
    {
        
    }
    
//    imamsrifkan : fungsi proses penambahan data user praktikum
    public function proses_praktikan()
    {
        $dataToSave = array(
            "daftar_nim"=>$this->input->post("nim_praktikan",TRUE),
            "daftar_nama"=>$this->input->post("nama_praktikan",TRUE),
            "daftar_angkatan"=>  "20".substr($this->input->post("nim_praktikan"), 0, 2),
            "kelas_id"=>$this->input->post("id_kelas",TRUE),
        );
        if(empty($dataToSave["daftar_nim"]) OR empty($dataToSave["daftar_nama"]))
        {
            echo "kosong";
        }
        else
        {
//            imamsrifkan : periksa ketersediaan nim praktikan
            $checkNim = $this->user_daftar->getUserDaftarByNim($dataToSave["daftar_nim"]);
//            imamsrifkan : periksa ketersediaan kuota kelas
            $checkPraktikan = $this->user_daftar->getCountUserDaftarById($dataToSave["kelas_id"]);
//            imamsrifkan : mengambil data kelas berdasarkan id kelas
            $kelas_praktikum = $this->kelas_praktikum->getKelasById($dataToSave["kelas_id"]);
            
            if($checkNim)
            {
                echo "duplikat";
            }
            else if($checkPraktikan)
            {
                if($checkPraktikan["jumlah"] < $kelas_praktikum["kelas_kuota"])
                {
                    $update = $this->user_daftar->insertUserDaftar($dataToSave);
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
                    echo "penuh";
                }
            }
        }
    }
}