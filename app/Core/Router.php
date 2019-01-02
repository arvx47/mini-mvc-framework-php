<?php
namespace App\Core;

class Router {

	private $routes = [], $app;

	public function __construct($app) {
		$this->app = $app;
	}

	private function addRoute(string $method, string $url, $handler) {
		$this->routes[$url][$method] = $handler;
	}

	public function get(string $url, $handler) {
		$this->addRoute("get", $url, $handler);
	}
	
	public function post(string $url, $handler) {
		$this->addRoute("post", $url, $handler);
	}

	public function resolve() {
		$documentRoot = realpath($_SERVER['DOCUMENT_ROOT']);
		$getCwd = realpath(getcwd());
		$base = str_replace('\\', '/', str_replace($documentRoot, '', $getCwd) . '/');
	  	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	  	$realUri = ($ru = substr($uri, strlen($base))) == '' ? '/' : $ru;
		$method = strtolower($_SERVER["REQUEST_METHOD"]);
	  	if (isset($this->routes[$realUri][$method])) {
	  		$handler = $this->routes[$realUri][$method];
			$handler($this->app);
	  	}
		$this->app->view('404.php');
	}

}