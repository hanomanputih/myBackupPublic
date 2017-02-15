<?php
include_once "WEB-INF/controller/base_controller.php";

class error_aksi extends base_controller { 
	public function __construct($command){
		parent::__construct(null,$command);
	}
	
    function _default() {
		include 'WEB-INF/view/error_view.php';
    }
    
	public function page_not_found() {
		show_template_index($this->Command);
	}
	
	public function iframe_not_found() {
		include 'WEB-INF/view/error_view.php';
    }
	
    public function getList() {
    	$return['table'] = 'You don\'t have authority to see the table';
		$return['pagination'] = '';
		echo json_encode($return);
    }
    
	public function getAutocomplete() {
		$result = array('result'=>array(array('label'=>'','value'=>'No data')));
		echo json_encode($result);
	}
	
	public function getSelect(){
		echo '<option value="00">No data</option>';
	}
	
	public function add() {
		$result[messageBox] = message_box::error_box('You don\'t have authority to add new items');
		$result[error] = true;
		echo json_encode($result);		
	}
	
	public function del() {
		$result[messageBox] = message_box::error_box('You don\'t have authority to delete items');
		$result[error] = true;
		echo json_encode($result);				
	}
	
	public function edt(){
		$result[messageBox] = message_box::error_box('You don\'t have authority to edit item');
		$result[error] = true;
		echo json_encode($result);		
	}
	
	public function detail(){
	}
	
	public function getById() {
		echo json_encode(array());
	}
} 
?>