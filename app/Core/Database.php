<?php 
namespace App\Core;

// SINGLETON
class Database {

	private static $instance, $config;

	static function setConfig($config) {
		self::$config = $config;
	}

	static function getInstance() {
		if (!isset($instance)) {
			$config = self::$config;
			try {
				self::$instance = new \PDO(
					"pgsql:host={$config['server']};" .
					"port={$config['port']};" .
					"dbname={$config['database']};", 
					$config['username'], 
					$config['password'],
					[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
			} catch (Exception $e) {
				echo "Error de conexion a la bd.";
				exit();
			}
		} 
		return self::$instance;
	}
}
