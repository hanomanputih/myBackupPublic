<?php 
class pendidikan_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("pendidikan");
	}
	
	final public static function getInstance(){
        if(null !== pendidikan_dao::$_instance){
            return pendidikan_dao::$_instance;
        }

        pendidikan_dao::$_instance = new pendidikan_dao();
        return pendidikan_dao::$_instance;
    } 
}