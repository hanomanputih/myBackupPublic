<?php 
class menu_function_detail_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = menu_function_detail_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== menu_function_detail_service_impl::$_instance){
            return menu_function_detail_service_impl::$_instance;
        }

        menu_function_detail_service_impl::$_instance = new menu_function_detail_service_impl();
        return menu_function_detail_service_impl::$_instance;
    } 
}