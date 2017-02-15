<?php
include_once 'WEB-INF/controller/base_controller.php';

class login_aksi extends base_controller { 
	private $username;
	private $password;
	
	public function __construct($command){
		parent::__construct("user", $command);
		if (isset($_POST['password']))
			$this->username = string_tools::addSlashes(stripslashes($_POST['password'])); 
        if (isset($_POST['username']))
			$this->password = string_tools::addSlashes(stripslashes($_POST['username']));
	} 
    
	public function _default(){
		$this->login();	
	}
	
	public function login() {
		show_template_login();
	}
	
    public function do_login(){
    	//handler if username or password was null
    	$this->model->set_select_full_suffix("username='" . $this->username . "' AND password='" . $this->password . "'");
    	if ($this->svc->select_count($this->model) == 1) {
    		$rows = $this->svc->select($this->model);
    		$this->model->set_id_user($rows[0][0]);
    		$this->model->set_username($rows[0][1]);
			$this->model->set_nama_lengkap($rows[0][2]);
    		$this->model->set_password($rows[0][3]);
			$this->model->set_last_session(md5($_SERVER['HTTP_USER_AGENT'] . '=' . $_SERVER['REMOTE_ADDR']));
			$this->model->set_role($rows[0][4]);
			$this->svc->update($this->model);

			// create session
			Auth::start($this->model);
    		//echo "url : " . $_POST['redirect_url'];
				
			if ($_POST['redirect_url'] != null)
				header ("location: ". $_POST['redirect_url']);
			else
            	header ("location: ". getScriptUrl() . "index.html");            
    	}
    	else {
    		header ("location: ". getScriptUrl() . "login.html?fail");
    	}
    } 
    
    public function session(){
		echo Auth::authenticate();
    }
    
    public function logout() {
		Auth::destroy();
		Auth::redirectLogin();
    }
}
?>