<?php 
class pengurus_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("pengurus");
	}
	
	final public static function getInstance(){
        if(null !== pengurus_dao::$_instance){
            return pengurus_dao::$_instance;
        }

        pengurus_dao::$_instance = new pengurus_dao();
        return pengurus_dao::$_instance;
    } 
}