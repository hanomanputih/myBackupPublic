<?php 
class masjid_service_impl extends base_service_impl{
	protected static $_instance = null;
	
	function __construct() {
		$this->dao = masjid_dao::getInstance();
	}
	
	final public static function getInstance(){
        if(null !== masjid_service_impl::$_instance){
            return masjid_service_impl::$_instance;
        }

        masjid_service_impl::$_instance = new masjid_service_impl();
        return masjid_service_impl::$_instance;
    } 
}