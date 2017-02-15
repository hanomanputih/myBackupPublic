<?php 
class todo_service_impl extends base_service_impl{
	
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = todo_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== todo_service_impl::$_instance){
            return todo_service_impl::$_instance;
        }

        todo_service_impl::$_instance = new todo_service_impl();
        return todo_service_impl::$_instance;
    } 
}