<?php
// imamsrifkan: model for table schedule

class Model_schedule extends CI_Model {

    private $table_name = 'rep_schedule';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_table', 'table');
        $this->load->model('model_options','options');
        $this->load->model('model_user','user');
    }

    public function get_schedule_by_ID($ID)
    {
        $result = array();

        $this->table->set_table($this->table_name);
        $this->table->tb_where(array('user_ID' => $ID));

        // imamsrifkan: get current user's schedule
        $get_schedule = $this->table->get_row();

        // imamsrifkan: get current data user
        $get_user = $this->user->get_users_by_attr(array('user_ID' => $ID), 'row');
        if($get_user)
        {
            $schedule = array('schedule_value' => $get_schedule['schedule_value']);
            $value = (array)$schedule;
            $result = (array)(array_merge($value, $get_user));
        }
        return $result;
    }

    public function get_all_schedule_by_active_generation()
    {
        $result = array();
        $ac = $this->options->get_options_by_key('active_generation');
        $ac = $ac['option_value'];
        
        // imamsrifkan: get data user meta
        $get_user_meta = $this->user->get_user_meta_by_attr(array('meta_key' => 'generation', 'meta_value' => $ac), 'list');
        if($get_user_meta)
        {
            foreach($get_user_meta as $key => $val)
            {
                // imamsrifkan : get data user
                $get_user = $this->user->get_users_by_attr(array('user_ID' => $val['user_ID']),'row');
                // imamsrifkan: get user schedule
                $this->table->set_table($this->table_name);
                $this->table->tb_where(array('user_ID' => $val['user_ID']));

                $get_schedule = $this->table->get_row();

                if($get_schedule)
                {
                    $schedule = array('schedule_value' => $get_schedule['schedule_value']);
                    $value = (array)$schedule;
                    $result[] = (array)(array_merge($value ,$get_user));
                }
            }
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function update_schedule($ID, $value)
    {
        $post_array = array('user_ID' => $ID);

        $this->table->set_table($this->table_name);
        $this->table->tb_where($post_array);
        $get_data = $this->table->get_row();
        if($get_data)
        {
            return $this->table->tb_update($get_data['schedule_ID'], array('schedule_value' => $value));
        }
        else
        {
            $post_array = array(
                'user_ID' => $ID,
                'schedule_value' => $value
                );
            return $this->table->tb_insert($post_array);
        }
    }
}