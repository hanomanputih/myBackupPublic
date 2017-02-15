<?php

class Model_init extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user','user');
	}

	public function init_footer()
	{
		$data_send['footer'] = array(
				'member' => $this->user->get_users_by_active_generation(),
				);

		$this->load->view('template/index',$data_send, true);
	}


}

/* End of file model_init.php */
/* Location: ./applications/models/model_init.php */