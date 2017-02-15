<?php if( !defined('BASEPATH')) exit('No direc script access allowed');

class Members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_login'))
		{
			$this->load->model('model_user','user');
			$this->load->model('model_options','options');
			$this->load->model('model_validation','validation');
			$this->load->model('model_init','init');

			$this->init->init_footer();

			$data_send = array('class' => '', 'msg' => '');
			$this->load->view('template/index',$data_send, true);
		}
		else
		{
			redirect(base_url());
			exit;
		}
	}

	public function index()
	{
		$data_send['members'] = $this->user->get_all_users();
		$data_send['position'] = $this->options->get_options_by_key('position');
		$data_view['content'] = $this->load->view('content/members/home',$data_send,true);
		$this->load->view('template/index',$data_view);
	}

	public function create()
	{
		$data_send['position'] = $this->options->get_options_by_key('position');
		$data_view['content'] = $this->load->view('content/members/form-new',$data_send, true);
		$this->load->view('template/index',$data_view);	
	}

	public function proccess()
	{
		$parameter = array(
			array('field' => 'username', 'label' => 'Username', 'rules' => 'required|trim|alpha_numeric|is_unique['.$this->user->get_user_table().'.user_nicename]'),
			array('field' => 'password', 'label' => 'Password', 'rules' => 'required|alpha_numeric|min_length[6]|max_length[32]|trim'),
			array('field' => 'confirm', 'label' => 'Confirm Password', 'rules' => 'required|matches[password]|trim'),
			array('field' => 'position', 'label' => 'Position', 'rules' => 'required')
			);

		$this->validation->set_validation($parameter);
		if($this->validation->is_validation())
		{
			date_default_timezone_set('Asia/Jakarta');
			$post_array = array(
				'member' => array(
					'user_nicename' => $this->input->post('username', true),
					'user_pass' => md5($this->input->post('password', true)),
					'user_registered' => date('Y-m-d H:i:s', time())
					),
				'meta_member' => array(
					'first_name' => $this->input->post('first-name', true),
					'last_name' => $this->input->post('last-name', true),
					'position' => $this->input->post('position', true)
					)
			);

			$insert = $this->user->insert_user($post_array);

			if($insert)
			{
				$data_send['class'] = 'alert alert-success';
				$data_send['msg'] = '<strong>Success!</strong> Member created.';
			}
			else
			{
				$data_send['class'] = 'alert alert-error';
				$data_send['msg'] = "<strong>Error!</strong> Member can't be created.";
			}

		}
		else
		{
			$data_send['class'] = 'alert alert-error';
			$data_send['msg'] = validation_errors();
		}

		$data_send['position'] = $this->options->get_options_by_key('position');
		$data_view['content'] = $this->load->view('content/members/form-new',$data_send, true);
		$this->load->view('template/index',$data_view);
	}

	public function edit($id = '')
	{
		if(!empty($id))
		{
			$data_send['member'] = $this->user->get_users_by_attr(array('user_ID' => $id), 'row');
			$data_send['position'] = $this->options->get_options_by_key('position');
			$data_view['content'] = $this->load->view('content/members/form-edit',$data_send, true);
			$this->load->view('template/index',$data_view);
		}
		else
		{
			$this->index();
		}
	}

	public function update()
	{
		$ID = $this->input->post('user-ID', true);

		$parameter = array(
			array('field' => 'username', 'label' => 'Username', 'rules' => 'required|trim|alpha_numeric'),
			);
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

			$update = $this->user->update_user($ID, $post_array);
			if($update)
			{
				$data_send['class'] = 'alert alert-success';
				$data_send['msg'] = "<strong>Success!</strong> Member updated!";
			}
			else
			{
				$data_send['class'] = 'alert alert-error';
				$data_send['msg'] = "<strong>Error!</strong> Member Can't be edited";
			}
		}
		else
		{
			$data_send['class'] = 'alert alert-error';
			$data_send['msg'] = validation_errors();
		}

		$data_send['member'] = $this->user->get_users_by_attr(array('user_ID' => $ID), 'row');
		$data_send['position'] = $this->options->get_options_by_key('position');
		$data_view['content'] = $this->load->view('content/members/form-edit',$data_send, true);
		$this->load->view('template/index',$data_view);
	}

	public function reset()
	{
		$ID = $this->input->post('ID', true);
		if($ID)
		{
			$get_data = $this->user->get_users_by_attr(array('user_ID' => $ID), 'row');
			if($get_data)
			{
				$default = $this->options->get_options_by_key('default_password');
				$default = $default['option_value'];
				$this->user->reset_user_password($ID, $default);
			}
		}
		redirect(site_url('members'));
		exit;
	}

	public function delete()
	{
		$ID = $this->input->post('ID', true);
		if($ID)
		{
			$get_data = $this->user->get_users_by_attr(array('user_ID' => $ID), 'row');
			if($get_data)
			{
				$this->user->delete_user($ID);
			}
		}
		redirect(site_url('members'));
		exit;
	}

}