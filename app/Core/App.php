<?php
namespace App\Core;

// CONTAINER
class App {
	
	private $config, $router, $viewsPath;

	public function __construct($config) { 
		$this->config = $config;
		$this->viewsPath = __DIR__ . '/../views/';
		Database::setConfig($config['database']);
		$this->router = new Router($this);
	}

	public function run(Callable $callback) {
		session_start();
		$callback($this->router);
		$this->router->resolve();
	}

	public function push($uri) {
		header("Location: $uri");
		exit();
	} 

	public function view($filePath, $data = NULL) {
		require($this->viewsPath . $filePath);
	}
}