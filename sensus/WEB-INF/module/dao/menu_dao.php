<?php 
class menu_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("menu");
	}
	
	final public static function getInstance(){
        if(null !== menu_dao::$_instance){
            return menu_dao::$_instance;
        }

        menu_dao::$_instance = new menu_dao();
        return menu_dao::$_instance;
    } 
}