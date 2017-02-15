<?php 
class jenis_event_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("jenis_event");
	}
	
	final public static function getInstance(){
        if(null !== jenis_event_dao::$_instance){
            return jenis_event_dao::$_instance;
        }

        jenis_event_dao::$_instance = new jenis_event_dao();
        return jenis_event_dao::$_instance;
    } 
}