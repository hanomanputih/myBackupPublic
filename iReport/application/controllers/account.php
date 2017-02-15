<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_login'))
		{
			$this->load->model('model_user','user');
			$this->load->model('model_validation', 'validation');
			$this->load->model('model_init','init');

			$this->init->init_footer();
		}
		else
		{
			redirect(base_url());
			exit;
		}
	}

	public function index()
	{
		$this->member($this->session->userdata('username'));
	}

	public function member($username = '', $action = '')
	{
		if(isset($username))
		{
			$data_send = array('class' => '', 'msg' => '');
			if($action == 'edit')
			{
				$path = 'content/account/account-edit';
			}
			else if($action == 'update')
			{
				$ID = $this->input->post('user-ID', true);

				$parameter[] = array('field' => 'first-name', 'label' => 'First Name', 'rules' => 'required|trim');

				$pwd = $this->input->post('new-password', true);
				if($pwd)
				{
					$parameter[] = array('field' => 'new-password', 'label' => 'Password', 'rules' => 'required|trim|alpha_numeric|min_length[6]');
					$parameter[] = array('field' => 'confirm-password', 'label' => 'Confirm Password', 'rules' => 'required|trim|alpha_numeric|min_length[6]|matches[new-password]');
				}

				$this->validation->set_validation($parameter);
				if($this->validation->is_validation())
				{
					$post_array = array(
						'member' => array(
							'user_nicename' => $this->input->post('username', true),
							),
						'meta_member' => array(
							'first_name' => $this->input->post('first-name', true),
							'last_name' => $this->input->post('last-name', true),
							'position' => $this->input->post('position', true)
							)
						);

					if($pwd)
					{
						$post_array['member']['user_pass'] = md5($this->input->post('new-password', true));
					}

					$update = $this->user->update_user($ID, $post_array);
					redirect(site_url('account/'.$post_array['member']['user_nicename']));
					exit;
				}
				else
				{
					$data_send['class'] = 'alert alert-error';
					$data_send['msg'] = validation_errors();
					$path = 'content/account/account-edit';
				}
			}
			else
			{
				$path = 'content/account/home';
			}

			$data_send['position'] = $this->options->get_options_by_key('position');
			$data_send['member'] = $this->user->get_users_by_attr(array('user_nicename' => $username),'row');

			$data_view['content'] = $this->load->view($path, $data_send, true);
		}
		$this->load->view('template/index', $data_view);
	}
}