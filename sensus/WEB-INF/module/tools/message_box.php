<?php 
class message_box{
	public static function valid_box($message) {
		return "<div class=\"valid_box\">" . $message . "</div>";
	}
	
	public static function warning_box($message) {
		return "<div class=\"warning_box\">" . $message . "</div>";
	}
	
	public static function error_box($message) {
		return "<div class=\"error_box\">" . $message . "</div>";
	}
}