<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

class Generation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_login') AND $this->session->userdata('position') < 3)
		{
			$this->load->model('model_options','options');
			$this->load->model('model_user','user');
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
		$data_send['generations'] = $this->options->get_options_by_key('generation');
		$data_send['active_generation'] = $this->options->get_options_by_key('active_generation');
		$data_send['active_users'] = $this->user->get_users_by_active_generation();
		$data_view['content'] = $this->load->view('content/generation/home',$data_send, true);
		$this->load->view('template/index',$data_view);
	}

	public function edit($generation)
	{
		if(!empty($generation))
		{
			$op_generation = $this->options->get_options_by_key('generation');
			$op_generation = json_decode($op_generation['option_value'], true);
			if(in_array($generation, $op_generation))
			{
				$data_send['members'] = $this->user->get_all_users();
				$data_send['generations'] = $this->options->get_options_by_key('generation');
				$data_view['content'] = $this->load->view('content/generation/form-edit',$data_send, true);
				$this->load->view('template/index',$data_view);
			}
			else
			{
				$this->index();
			}
		}
		else
		{
			$this->index();
		}
	}

	public function update()
	{
		$generation = $this->input->post('generation', true);
		$member = $this->input->post('member', true);
		
		$generation_op = $this->options->get_options_by_key('generation');
		$generation_op = json_decode($generation_op['option_value'], true);

		$generation_idx = array_search($generation, $generation_op);
		if(in_array($generation, $generation_op))
		{
			if($member)
			{
				foreach($member as $value)
				{
					$this->user->update_user_meta($value, array('meta_key' => 'generation', 'meta_value' => $generation_idx));	
				}
			}
		}
		redirect(site_url('generation'));
		exit;
	}
}