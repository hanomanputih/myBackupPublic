<?php 
class todo_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("todo");
	}
	
	final public static function getInstance(){
        if(null !== todo_dao::$_instance){
            return todo_dao::$_instance;
        }
        
        todo_dao::$_instance = new todo_dao();
        return todo_dao::$_instance;
    } 
}