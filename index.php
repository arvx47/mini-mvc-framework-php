<?php 

require('./vendor/autoload.php');

$config = require(__DIR__ . '/config/config.php');

$app = new App\Core\App($config);

$app->run(function ($router) {
	require(__DIR__ . '/app/routes.php');
});