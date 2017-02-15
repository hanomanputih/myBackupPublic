<?php
class Auth {
	public static function inisiate() {
		require_once 'WEB-INF/module/conf/session_manager.php';
		//$sesman = new session_manager();
		session_start();
	}
	
	public static function start($user_logged) {
		$_SESSION['session'] = $user_logged->get_last_session();
		$_SESSION['username'] = $user_logged->get_username();
	    $_SESSION['nama_user'] = $user_logged->get_nama_lengkap();
		$_SESSION['loggedAt'] = time();
	}
	
	public static function authenticate() {
		if (isset($_SESSION['session'])) {
			if ($_SESSION['session'] != (md5($_SERVER['HTTP_USER_AGENT'] . '=' . $_SERVER['REMOTE_ADDR']))) {
				Auth::redirectLogin('?reLogin');
			}
	
			if($_SESSION['loggedAt'] < (strtotime("-90 mins"))) {
				Auth::destroy();
				Auth::redirectLogin('?timeout&redirect_url=' . getActualUrl());
			} else {
				$_SESSION['loggedAt']= time();
			}
		} else {
			Auth::redirectLogin('?login');
		}
	}
	
	public static function authenticateIsAlreadyLogged() {
		if (isset($_SESSION['session'])) {
			if ($_SESSION['session'] == md5($_SERVER['HTTP_USER_AGENT'] . '=' . $_SERVER['REMOTE_ADDR'])) {
				header("location: " . getScriptUrl() . "index.html");
				exit;
			}
		}
	}
	
	public static function destroy() {
		session_unset();
		session_destroy();
	}
	
	public static function reLogin($opt='') {
		return getScriptUrl() . "login.html" . $opt;
	}
	
	public static function redirectLogin($opt='') {
		header("location: ". getScriptUrl() . "login.html" . $opt);
		exit();
	}
	
	public static function getCurrentUser() {
		include_once 'WEB-INF/module/model/user.php';
		$user = new user();
		$user->set_username(string_tools::addSlashes((isset($_SESSION['session'])) ? $_SESSION['username'] : 'guest'));
		$user->set_nama_lengkap(string_tools::addSlashes((isset($_SESSION['nama_user'])) ? $_SESSION['nama_user'] : 'guest'));
		return $user;
	}
}
?>