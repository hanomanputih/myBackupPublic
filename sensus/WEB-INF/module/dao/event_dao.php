<?php 
class event_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("event");
	}
	
	final public static function getInstance(){
        if(null !== event_dao::$_instance){
            return event_dao::$_instance;
        }

        event_dao::$_instance = new event_dao();
        return event_dao::$_instance;
    } 
}