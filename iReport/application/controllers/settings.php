<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_login') AND $this->session->userdata('position') < 3)
		{
			$this->load->model('model_options','options');
			$this->load->model('model_init','init');

			$this->init->init_footer();
			
			$data_send = array('msg' => '', 'class' => '');
			$this->load->view('content/settings/home',$data_send,true);
		}
		else
		{
			redirect(base_url());
			exit;
		}
	}

	public function index()
	{
		$data_send['options']['position'] = $this->options->get_options_by_key('position');
		$data_send['options']['module'] = $this->options->get_options_by_key('module');
		$data_send['options']['generation'] = $this->options->get_options_by_key('generation');
		$data_send['options']['time_practicum'] = $this->options->get_options_by_key('time_practicum');
		$data_send['options']['active_generation'] = $this->options->get_options_by_key('active_generation');
		$data_send['options']['default_password'] = $this->options->get_options_by_key('default_password');
		$data_view['content'] = $this->load->view('content/settings/home',$data_send, true);
		$this->load->view('template/index',$data_view);
	}

	public function update()
	{
		$post_array = array(
			'position' => $this->input->post('position', true),
			'module' => $this->input->post('module', true),
			'generation' => $this->input->post('generation', true),
			'default_pass' => $this->input->post('reset-pass', true),
			'active_generation' => $this->input->post('active-generation', true) ,
			'time_practicum' => $this->input->post('time-practicum', true)
			);
		$temp_position = explode(',',$post_array['position']);
		$temp_module = explode(',', $post_array['module']);
		$temp_generation = explode(',', $post_array['generation']);
		$temp_practicum = explode(',', $post_array['time_practicum']);

		$position = array();
		$module = array();
		$generation = array();
		$practicum = array();
		foreach($temp_position as $num => $val)
		{
			if($val != "")
			{
				$position[$num] = $val;
			}
		}
		foreach($temp_module as $num => $val)
		{
			if($val != "")
			{
				$module[$num] = $val;
			}
		}
		foreach($temp_generation as $num => $val)
		{
			if($val != "")
			{
				$generation[$num] = $val;
			}
		}
		foreach($temp_practicum as $num => $val)
		{
			if($val != "")
			{
				$practicum[$num] = $val;
			}
		}

		$update_position = $this->options->update_options('position', json_encode($position));

		$update_module = $this->options->update_options('module', json_encode($module));

		$update_generation = $this->options->update_options('generation', json_encode($generation));

		$update_password = $this->options->update_options('default_password', $post_array['default_pass']);

		if($post_array['active_generation'] != false)
		{
			$update_generation_active = $this->options->update_options('active_generation', $post_array['active_generation']);
		}

		$update_practicum = $this->options->update_options('time_practicum', json_encode($practicum));

		if($update_position AND $update_module AND $update_password AND $update_generation)
		{
			$data_send['class'] = 'alert alert-success';
			$data_send['msg'] = '<strong>Success!</strong> Settings saved.';
		}
		else
		{
			$temp_msg = '<strong>Error!</strong> ';
			if( !$update_position)
			{
				$temp_msg .= "Data Position can't be saved. ";
			}
			if( !$update_module)
			{
				$temp_msg .= "Data Module can't be saved. ";
			}
			if( !$update_password)
			{
				$temp_msg .= "Data Default Password can't be saved.";
			}
			$data_send['class'] = 'alert alert-error';
			$data_send['msg'] = $temp_msg;
		}

		$data_send['options']['position'] = $this->options->get_options_by_key('position');
		$data_send['options']['module'] = $this->options->get_options_by_key('module');
		$data_send['options']['generation'] = $this->options->get_options_by_key('generation');
		$data_send['options']['time_practicum'] = $this->options->get_options_by_key('time_practicum');
		$data_send['options']['active_generation'] = $this->options->get_options_by_key('active_generation');
		$data_send['options']['default_password'] = $this->options->get_options_by_key('default_password');
		$data_view['content'] = $this->load->view('content/settings/home',$data_send, true);

		$this->load->view('template/index',$data_view);
	}
}