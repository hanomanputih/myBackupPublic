<?php 
class menu_function_detail_dao extends base_dao
{
	protected static $_instance = null;
	
	function __construct() {
		parent::__construct("menu_function_detail");
	}
	
	final public static function getInstance(){
        if(null !== menu_function_detail_dao::$_instance){
            return menu_function_detail_dao::$_instance;
        }

        menu_function_detail_dao::$_instance = new menu_function_detail_dao();
        return menu_function_detail_dao::$_instance;
    } 
}