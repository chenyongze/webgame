<?php

class base{

	private static $instance;


	public static function get_instance()
	{
		if (self::$instance == null) {
			self::$instance = new self;
		}
		return self::$instance;
	}
}


?>