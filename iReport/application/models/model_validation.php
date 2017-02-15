<?php

class Model_validation extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function set_validation($args)
	{
		if(is_array($args))
		{
			foreach ($args as $value)
			{
				$this->form_validation->set_rules($value['field'], $value['label'], $value['rules']);
			}
		}
		else
		{
			return false;
		}
	}

	public function is_validation()
	{
		return $this->form_validation->run();
	}
}