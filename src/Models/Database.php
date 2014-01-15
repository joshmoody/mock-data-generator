<?php

namespace joshmoody\Mock\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
	public static $driver = null;
	
	public static function init($config = null)
	{
		$defaults = [
			'driver' => 'sqlite',
			'host'		=> null,
			'database'	=> dirname(dirname(__DIR__)) . '/data/database.sqlite',
			'username'	=> null,
			'password'	=> null,
			'charset'	=> 'utf8',
			'collation'	=> 'utf8_unicode_ci',
			'prefix'	=> null
		];
		
		$capsule = new Capsule;
		
		if (is_array($config))	{
			$options = array_merge($defaults, $config);
		} else {
			$options = $defaults;
		}
		
		$capsule->addConnection($options);
		$capsule->setAsGlobal();
		$capsule->bootEloquent();
		
		self::$driver = $options['driver'];
	}
	
	public static function random()
	{
		if (self::$driver == 'sqlite') {
			return 'random()';
		} else {
			return 'rand()';
		}
	}
}