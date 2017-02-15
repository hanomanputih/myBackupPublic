<?php 
class kedatangan_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("kedatangan");
	}
	
	final public static function getInstance(){
        if(null !== kedatangan_dao::$_instance){
            return kedatangan_dao::$_instance;
        }

        kedatangan_dao::$_instance = new kedatangan_dao();
        return kedatangan_dao::$_instance;
    } 
}