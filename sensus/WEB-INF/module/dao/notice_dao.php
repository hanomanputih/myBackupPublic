<?php 
class notice_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("notice");
	}
	
	final public static function getInstance(){
        if(null !== notice_dao::$_instance){
            return notice_dao::$_instance;
        }

        notice_dao::$_instance = new notice_dao();
        return notice_dao::$_instance;
    } 
}