<?php

class Session {

	private static $_session = false;
	public static $auth = false;

	function __construct() {

	}

	public static function init() {
		if (self::$_session == false) {
			session_start();
			self::$_session = true;
		}
	}

	public static function set($key, $value) {
			$_SESSION[$key] = $value;
	}

	public static function get($key, $secondKey = false) {
		if ($secondKey == true) {
			if(isset($_SESSION[$key][$secondKey]))
			return $_SESSION[$key][$secondKey];
		} else {
			if (isset($_SESSION[$key]))
			return $_SESSION[$key];
		}
	}

	public static function display() {
		echo '<pre>';
		var_dump($_SESSION);
		echo '</pre>';
	}

	public static function destory() {
		if (self::$_session == true) {		
			session_unset();
			session_destroy();
		}
	}

}
/*
session:set('name', array (
	'name' => 'jesse',
	'number' => '911'
	));*/
?>
