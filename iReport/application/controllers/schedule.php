<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('is_login'))
        {
            $this->load->library('library_mine');

            $this->load->model('model_options','options');
            $this->load->model('model_schedule','schedule');
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
        $data_send['time'] = $this->options->get_options_by_key('time_practicum');
        $data_send['all_schedule'] = $this->schedule->get_all_schedule_by_active_generation();
        $data_view['content'] = $this->load->view('content/schedule/home',$data_send, true);
        $this->load->view('template/index', $data_view);
    }

    public function me($action = '')
    {
        $data_send['time'] = $this->options->get_options_by_key('time_practicum');

        if($action == 'edit')
        {
            $data_send['schedule'] = $this->schedule->get_schedule_by_ID($this->session->userdata('user_ID'));
            $data_view['content'] = $this->load->view('content/schedule/me-edit',$data_send, true);
        }
        else if($action == 'update')
        {
            $schedule = $this->input->post('schd', true);

            if(!$schedule)
            {
                $schedule = '';
            }

            $update = $this->schedule->update_schedule($this->session->userdata('user_ID'), json_encode($schedule));
            redirect(site_url('schedule/me'));
            exit;
        }
        else if($action == 'export')
        {
            $mine = new library_mine();
            $mine->web_to_excel($this->_data_to_proccess($this->session->userdata('user_ID')));
        }
        else if($action == 'printout')
        {
            $mine = new library_mine();
            $mine->web_to_print($this->_data_to_proccess($this->session->userdata('user_ID')));
        }
        else
        {
            $data_send['schedule'] = $this->schedule->get_schedule_by_ID($this->session->userdata('user_ID'));
            $data_view['content'] = $this->load->view('content/schedule/me',$data_send, true);
        }

        $this->load->view('template/index', $data_view);
    }

    public function member($username = '', $action = '')
    {
        if(!empty($username))
        {
            $data_send['time'] = $this->options->get_options_by_key('time_practicum');
            
            // imamsrifkan: get data username
            $get_user = $this->user->get_users_by_attr(array('user_nicename' => $username),'row');

            if($get_user)
            {
                $data_send['member'] = $username;
                $data_send['first_name'] = $get_user['first_name'];
                $data_send['member_schedule'] = $this->schedule->get_schedule_by_ID($get_user['user_ID']);

                if($action == 'edit')
                {
                    $get_user = $this->user->get_users_by_attr(array('user_nicename' => $username),'row');
                    $data_send['schedule'] = $this->schedule->get_schedule_by_ID($get_user['user_ID']);
                    $data_view['content'] = $this->load->view('content/schedule/member-edit',$data_send, true);
                }
                else if($action == 'update')
                {
                    $schedule = $this->input->post('schd', true);

                    if(!$schedule)
                    {
                        $schedule = '';
                    }

                    $update = $this->schedule->update_schedule($get_user['user_ID'], json_encode($schedule));
                    redirect(site_url('schedule/member/'.$username));
                    exit;
                }
                else if($action == 'export')
                {
                    $mine = new library_mine();
                    $mine->web_to_excel($this->_data_to_proccess($get_user['user_ID']));
                }
                else if($action == 'printout')
                {
                    $mine = new library_mine();
                    $mine->web_to_print($this->_data_to_proccess($get_user['user_ID']));
                }
                else
                {
                    $data_view['content'] = $this->load->view('content/schedule/member-schedule',$data_send, true);
                }
            }


            $this->load->view('template/index', $data_view);
        }
        else
        {
            $this->index();
        }
    }

    public function export()
    {
        $mine = new library_mine();
        $mine->web_to_excel($this->_data_to_proccess());
    }

    public function printout()
    {
        $mine = new library_mine();
        $mine->web_to_print($this->_data_to_proccess());
    }

    private function _data_to_proccess($user_ID = '')
    {
        $rebuild = array();

        $data_send['time'] = $this->options->get_options_by_key('time_practicum');
        $days = array('monday','tuesday','wednesday','thursday','friday','saturday');
        
        if(!empty($user_ID))
        {
            $data_send['schedule'] = $this->schedule->get_schedule_by_ID($user_ID);
            $type = 'row';
        }
        else
        {
            $data_send['schedule'] = $this->schedule->get_all_schedule_by_active_generation();
            $type = 'list';
        }

        if(@$data_send['time'])
        {
            $decode = json_decode($data_send['time']['option_value'], true);
            foreach($decode as $num => $time)
            {
                if($data_send['schedule'])
                {
                    switch($type)
                    {
                        case 'row':
                            $data_schedule = json_decode($data_send['schedule']['schedule_value'], true);

                            $temp['#'] = $time;

                            if(@$days)
                            {
                                foreach($days as $key => $day)
                                {
                                    $check_data = @in_array($key.'-'.$num, $data_schedule);
                                    switch($check_data)
                                    {
                                        case 1:
                                            $member = trim($data_send['schedule']['first_name'].' '.$data_send['schedule']['last_name']);
                                            break;
                                        default:
                                            $member = '-';
                                            break;
                                    }
                                    $temp[$day] = $member;
                                }
                            }
                            $rebuild['list'][] = $temp;
                        break;
                        
                        case 'list':
                            foreach($data_send['schedule'] as $record)
                            {
                                $data_schedule = json_decode($record['schedule_value'], true);

                                $temp['#'] = $time;

                                if(@$days)
                                {
                                    foreach($days as $key => $day)
                                    {
                                        $check_data = @in_array($key.'-'.$num, $data_schedule);
                                        switch($check_data)
                                        {
                                            case 1:
                                                $member = trim($record['first_name'].' '.$record['last_name']);
                                                break;
                                            default:
                                                $member = '-';
                                                break;
                                        }
                                        $temp[$day] = $member;
                                    }
                                }
                                $rebuild['list'][] = $temp;
                            }
                        break;
                    }
                }
            }
        }

        $rebuild['columns'] = array(
            array('field_name' => '#', 'display_as' => '#'),
            array('field_name' => 'monday', 'display_as' => 'Monday'),
            array('field_name' => 'tuesday', 'display_as' => 'Tuesday'),
            array('field_name' => 'wednesday', 'display_as' => 'Wednesday'),
            array('field_name' => 'thursday', 'display_as' => 'Thursday'),
            array('field_name' => 'friday', 'display_as' => 'Friday'),
            array('field_name' => 'saturday', 'display_as' => 'Saturday'),
            );

        return $rebuild;
        // echo json_encode($rebuild['list']);
    }
}