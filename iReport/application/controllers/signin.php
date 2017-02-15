<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

class signin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user','user');
		$this->load->model('model_init','init');

		$this->init->init_footer();
	}

	public function index()
	{
		if( !$this->session->userdata('is_login'))
		{
			$this->load->view('template/template-login');
		}
		else
		{
			redirect(site_url('home'));
			exit;
		}
	}

	public function ajax_get_login()
	{
		$post_array = array(
			'user_nicename' => $this->input->post('username', true),
			'user_pass' => md5($this->input->post('password', true))
		);

		$get_data = $this->user->get_users_by_attr($post_array, 'row');
		if($get_data)
		{
			// session: create session
			$config = array(
				'user_ID' => $get_data['user_ID'],
				'username' => $get_data['user_nicename'], 
				'first_name' => $get_data['first_name'],
				'last_name' => $get_data['last_name'],
				'position' => $get_data['position'],
				'is_login' => true,
				);

			$this->session->set_userdata($config);

			$callback['status'] = true;
			$callback['message'] = "Successfully login!";
			$callback['redirect'] = site_url('home');
		}
		else
		{
			$callback['status'] = false;
			$callback['message'] = "Username and password doesn't match.";
		}
		echo json_encode($callback);
	}

	public function destroy()
	{
		$this->session->sess_destroy();
		redirect(base_url());
		exit;
	}
}
