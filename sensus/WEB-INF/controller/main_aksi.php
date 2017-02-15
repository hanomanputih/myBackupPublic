<?php
include_once "WEB-INF/controller/base_controller.php";

class main_aksi extends base_controller { 
	public function __construct($command){
		parent::__construct(null,$command);
	}
	
	public function _default() {
		// call function _default from full_calendar's controller
		$this->Command->setControllerName('event');
		show_template_index($this->Command);
	}
	
	public function message_box() {
		include 'WEB-INF/module/conf/message-box.html';
	}
} 
?>