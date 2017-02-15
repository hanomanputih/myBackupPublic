<?php

class Data extends CI_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('general');
        $this->load->library('form_validation');
    }

    public function index() {
        // ivanAdhi : get data
        $this->general->set_table('data');
        $datatosend['data'] = $this->general->get_result_array();
        $datatosend['title'] = "Data Mahasiswa";
        $datatoview['content'] = $this->load->view('mahasiswa/view-data', $datatosend, true);
        $this->load->view('template', $datatoview);
    }

    public function input() {
        $datatosend['msg'] = '';
        // $datatosend['title'] = "Input Data";
        $datatoview['content'] = $this->load->view('mahasiswa/form-input', $datatosend, true);
        $this->load->view('template', $datatoview);
    }

    public function proses() {
        $data = array(
            'mahasiswa_nim' => $this->input->post("nim", true),
            'mahasiswa_nama' => $this->input->post("nama", true),
            'mahasiswa_jurusan' => $this->input->post("jurusan", true)
        );
        // echo json_encode($data);

        $this->form_validation->set_rules('nim', 'Nim', 'required|trim|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

        if ($this->form_validation->run() == false) {
            $datatosend['msg'] = validation_errors();
            $datatoview['content'] = $this->load->view('mahasiswa/form-input', $datatosend, true);
            $this->load->view('template', $datatoview);
        } else {

            $this->general->set_table('data');
            $simpan = $this->general->insert($data);

//			 $datatoview['content'] = $this->load->view('template',true);
//			 $this->load->view('template',$datatoview);
            // if($simpan > 0){
            // 	$title="Data Berhasil Disimpan";
            // } else{
            // 	echo "gagal disimpan";
            // }
        }
    }

    public function edit($id) {
        $this->general->set_table('data');
        $this->general->where(array('mahasiswa_id' => $id));
        $get = $this->general->get_row_array();
        if ($get) {
            $datatosend['data'] = $get;
            $datatoview ['content'] = $this->load->view('mahasiswa/edit-data', $datatosend, true);
            $this->load->view('template', $datatoview);
        } else {
            echo "Data Tidak Ditemukan!";
        }
    }

    public function update() {
        $data = array(
            'mahasiswa_id' => $this->input->post("id", true),
            'mahasiswa_nim' => $this->input->post("nim", true),
            'mahasiswa_nama' => $this->input->post("nama", true),
            'mahasiswa_jurusan' => $this->input->post("jurusan", true)
        );
        // echo json_encode($data);

        $this->form_validation->set_rules('nim', 'Nim', 'required|trim|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->general->set_table('data');
        $this->general->where(array('mahasiswa_id' => $data['mahasiswa_id']));
        if ($this->form_validation->run() == false) {
            $datatosend['msg'] = validation_errors();
            $datatosend['data'] = $this->general->get_row_array();
            $datatoview['content'] = $this->load->view('mahasiswa/edit-data', $datatosend, true);
            $this->load->view('template', $datatoview);
        } else {
            $datatosend['msg'] = "Data berhasil Disimpan";
            $update = $this->general->update($data);
            $datatosend['data'] = $this->general->get_row_array();
            $datatoview['content'] = $this->load->view('mahasiswa/edit-data', $datatosend, true);
            $this->load->view('template', $datatoview);
        }
    }

    public function hapus($id) {
        $this->general->set_table('data');
        $this->general->where(array('mahasiswa_id' => $id));
        $delete = $this->general->delete();
        $datatosend = "Data berhasil Dihapus";
        if ($delete) {
            $this->load->view('template',$datatosend);
//redirect('/data');
            } else {
            echo "Data Tidak Terhapus";
        }
    }

}

?>