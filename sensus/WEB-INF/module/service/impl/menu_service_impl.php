<?php 
class menu_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = menu_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== menu_service_impl::$_instance){
            return menu_service_impl::$_instance;
        }

        menu_service_impl::$_instance = new menu_service_impl();
        return menu_service_impl::$_instance;
    } 
}