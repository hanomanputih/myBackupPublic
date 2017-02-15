<?php 
class anak_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("anak");
	}
	
	final public static function getInstance(){
        if(null !== anak_dao::$_instance){
            return anak_dao::$_instance;
        }

        anak_dao::$_instance = new anak_dao();
        return anak_dao::$_instance;
    } 
}