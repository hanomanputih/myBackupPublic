<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

class Presence extends CI_Controller {

    public function __construct()
    {
        parent:: __construct();
        if($this->session->userdata('is_login'))
        {
            $this->load->library('library_mine');

            $this->load->model('model_presence','presence');
            $this->load->model('model_options','options');
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
        if($this->session->userdata('position') != 0)
        {
            $data_send['module'] = $this->options->get_options_by_key('module');
            $data_send['member'] = $this->user->get_users_by_active_generation();
            $data_send['presence'] = $this->presence->get_presence_by_attr(array('user_ID' => $this->session->userdata('user_ID')));

            $data_view['content'] = $this->load->view('content/presence/home',$data_send, true);
            $this->load->view('template/index',$data_view);
        }
        else
        {
            redirect(site_url());
            exit;
        }
    }

    public function member($username = '', $action = '')
    {
        if($username)
        {
            $data_send['member'] = $this->user->get_users_by_attr(array('user_nicename' => $username),'row');
            if($data_send['member'])
            {
                $data_send['presence'] = $this->presence->get_presence_by_attr(array('user_ID' => $data_send['member']['user_ID']));
            }
            else
            {
                redirect(site_url('presence'));
                exit;       
            }

            if($action == 'export')
            {
                $mine = new library_mine();
                $mine->web_to_excel($this->_data_to_proccess($username));
            }
            else if($action == 'printout')
            {
                $mine = new library_mine();
                $mine->web_to_print($this->_data_to_proccess($username));
            }
        }
        else
        {
            redirect(site_url('presence'));
            exit;
        }
        $data_send['member_active'] = $this->user->get_users_by_active_generation();
        $data_send['module'] = $this->options->get_options_by_key('module');
        $data_view['content'] = $this->load->view('content/presence/member-presence',$data_send, true);
        $this->load->view('template/index',$data_view);
    }

    public function create()
    {
        $data_send['module'] = $this->options->get_options_by_key('module');
        $data_send['member'] = $this->user->get_users_by_active_generation();
        $data_send['presence'] = $this->presence->get_presence_by_attr(array('user_ID' => $this->session->userdata('user_ID')));
        $data_view['content'] = $this->load->view('content/presence/home',$data_send, true);
        $this->load->view('template/index',$data_view);
    }

    public function delete()
    {
        $ID = $this->input->post('ID', true);
        if($ID)
        {
            $this->presence->delete_presence($ID);
        }
        redirect(site_url('presence'));
        exit;
    }

    public function delete_all()
    {
        $user_ID = $this->input->post('ID', true);
        if($user_ID)
        {
            $this->presence->delete_all_presence($user_ID);
        }
        redirect(site_url('presence'));
        exit;
    }

    // imamsrifkan: insert data using ajax
    public function ajax_insert_presence()
    {
        $post_array = array(
            'user_ID' => $this->input->post('ID',true),
            'presence_date' => $this->input->post('date', true),
            'presence_start_time' => $this->input->post('start_time', true),
            'presence_end_time' => $this->input->post('end_time', true),
            'presence_my_signature' => $this->input->post('my_presence', true),
            'presence_kalab_signature' => $this->input->post('kalab_signature', true),
            'presence_module' => $this->input->post('module', true),
            'presence_students_presence' => $this->input->post('students_presence', true)
            );
        // presence: check data on table
        $get_data = $this->presence->get_presence_by_attr($post_array, 'row');
        if(!$get_data)
        {
            $insert = $this->presence->insert_presence($post_array);

            if($insert)
            {
                $data_send['stats'] = true;
                $data_send['cls'] = 'color-green';
                $data_send['msg'] = "<strong>Success!</strong> Data saved.";
            }
            else
            {
                $data_send['stats'] = false;
                $data_send['cls'] = 'color-red';
                $data_send['msg'] = "<strong>Error!</strong> Data can't be saved.";
            }
        }
        else
        {
            $data_send['stats'] = false;
            $data_send['cls'] = 'color-red';
            $data_send['msg'] = "<strong>Error!</strong> Duplicate data.";
        }
        echo json_encode($data_send);
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

        $data_send['module'] = $this->options->get_options_by_key('module');
        $data_send['member'] = $this->user->get_users_by_active_generation();
        if(!empty($user_ID))
        {
            $get_user = $this->user->get_users_by_attr(array('user_nicename' => $user_ID),'row');
            $data_send['presence'] = $this->presence->get_presence_by_attr(array('user_ID' => $get_user['user_ID']));
        }
        else
        {
            $data_send['presence'] = $this->presence->get_presence_by_attr(array('user_ID' => $this->session->userdata('user_ID')));    
        }

        if($data_send['presence'])
        {
            $no = 1;
            foreach($data_send['presence'] as $result)
            {
                if($data_send['module'])
                {
                    $decode = json_decode($data_send['module']['option_value'], true);
                }

                if($data_send['member'])
                {
                    $data_member = array();
                    foreach($data_send['member'] as $record)
                    {
                        $data_member[$record['user_ID']] = $record['first_name'];
                    }
                    $my_presence = $data_member[$result['presence_my_signature']]."'s presence";
                }
                

                switch($result['presence_kalab_signature'])
                {
                    case 'on':
                        $kalab_signature = 'checked';
                        break;
                    default:
                        $kalab_signature = '-';
                        break;
                }

                $rebuild['list'][] = array(
                    'number' => $no,
                    'presence_date' => Date('d-M-Y', human_to_unix($result['presence_date'])),
                    'presence_time' => substr($result['presence_start_time'], 0, 5).'-'.substr($result['presence_end_time'], 0, 5),
                    'presence_my_signature' => $my_presence,
                    'presence_module' => $decode[$result['presence_module']],
                    'presence_students_presence' => $result['presence_students_presence'],
                    'presence_kalab_signature' => $kalab_signature,
                    );

                $no++;
            }
        }

        $rebuild['columns'] = array(
            array('field_name' => 'number', 'display_as' => 'No'),
            array('field_name' => 'presence_date', 'display_as' => 'Date'),
            array('field_name' => 'presence_time', 'display_as' => 'Time'),
            array('field_name' => 'presence_my_signature', 'display_as' => 'Presence'),
            array('field_name' => 'presence_module', 'display_as' => 'Module'),
            array('field_name' => 'presence_students_presence', 'display_as' => "Student's Presence"),
            array('field_name' => 'presence_kalab_signature', 'display_as' => 'Kalab Presence'),
            );

        return $rebuild;
    }

}