<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('is_login'))
		{
			$this->load->model('model_presence','presence');
			$this->load->model('model_schedule','schedule');
			$this->load->model('model_options','options');
			$this->load->model('model_init','init');

			$this->init->init_footer();
		}
	}

	public function index()
	{
		// imamsrifkan: get count data presence in my presence from other member
		$data_send['member'] = $this->user->get_users_by_active_generation();
		if($data_send['member'])
		{
			foreach($data_send['member'] as $record)
			{
				$data_send['count'][$record['user_nicename']] = $this->presence->count_presence(array('user_ID' => $this->session->userdata('user_ID'), 'presence_my_signature' => $record['user_ID']));
			}
		}
		$data_send['count_my_presence'] = $this->presence->count_presence(array('user_ID' => $this->session->userdata('user_ID')));

		// imamsrifkan: get count data schedule
		$data_send['time'] = $this->options->get_options_by_key('time_practicum');
		$data_send['schedule'] = $this->schedule->get_schedule_by_ID($this->session->userdata('user_ID'));
		if($data_send['schedule'])
		{
			$decode = json_decode($data_send['schedule']['schedule_value']);
			$days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
			foreach($days as $key => $day)
			{
				if($decode)
				{
					$count = 0;
					$all = 0;
					foreach($decode as $record)
					{
						$split = explode('-', $record);
						if($split[0] == $key)
						{
							$count++;
						}
						$all++;
					}
					// imamsrifkan: count all schedule
					$data_send['count_all_schedule'] = $all;
					$data_send['count_schedule'][$key] = $count; 
				}
				else
				{
					$data_send['count_all_schedule'] = 0;
					$data_send['count_schedule'][$key] = 0; 	
				}
			}
		}

		// imamsrifkan: count module
		$data_send['count_module'] = $this->options->get_options_by_key('module');
		if($data_send['count_module'])
		{
			$decode_module = json_decode($data_send['count_module']['option_value'], true);
			$data_send['count_module'] = count($decode_module);
		}

		$data_view['content'] = $this->load->view('content/data/home', $data_send, true);
		$this->load->view('template/index', $data_view);
	}

	public function member($username = '')
	{
		if($username)
		{
			// imamsrifkan: get count data presence in current user presence from other member
			$data_send['member'] = $this->user->get_users_by_active_generation();
			$data_send['user'] = $this->user->get_users_by_attr(array('user_nicename' => $username), 'row');
			if($data_send['member'])
			{
				foreach($data_send['member'] as $record)
				{
					$data_send['count'][$record['user_nicename']] = $this->presence->count_presence(array('user_ID' => $data_send['user']['user_ID'], 'presence_my_signature' => $record['user_ID']));
				}
			}
			$data_send['count_my_presence'] = $this->presence->count_presence(array('user_ID' => $data_send['user']['user_ID']));

			// imamsrifkan: get count data schedule
			$data_send['time'] = $this->options->get_options_by_key('time_practicum');
			$data_send['schedule'] = $this->schedule->get_schedule_by_ID($data_send['user']['user_ID']);
			if($data_send['schedule'])
			{
				$decode = json_decode($data_send['schedule']['schedule_value']);
				$days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
				foreach($days as $key => $day)
				{
					if($decode)
					{
						$count = 0;
						$all = 0;
						foreach($decode as $record)
						{
							$split = explode('-', $record);
							if($split[0] == $key)
							{
								$count++;
							}
							$all++;
						}
						// imamsrifkan: count all schedule
						$data_send['count_all_schedule'] = $all;
						$data_send['count_schedule'][$key] = $count; 
					}
					else
					{
						$data_send['count_all_schedule'] = 0;
						$data_send['count_schedule'][$key] = 0; 	
					}
				}
			}

			// imamsrifkan: count module
			$data_send['count_module'] = $this->options->get_options_by_key('module');
			if($data_send['count_module'])
			{
				$decode_module = json_decode($data_send['count_module']['option_value'], true);
				$data_send['count_module'] = count($decode_module);
			}

			$data_view['content'] = $this->load->view('content/data/member-report', $data_send, true);
			$this->load->view('template/index', $data_view);
		}
		else
		{
			redirect(site_url('report'));
			exit;
		}
	}
}

/* End of file Report.php */
/* Location: ./application/controllers/report.php */