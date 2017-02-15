<?php 
class desa_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("desa");
	}
	
	final public static function getInstance(){
        if(null !== desa_dao::$_instance){
            return desa_dao::$_instance;
        }

        desa_dao::$_instance = new desa_dao();
        return desa_dao::$_instance;
    } 
}