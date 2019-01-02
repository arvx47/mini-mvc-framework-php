<?php

$router->get('/', function ($app) {
	$app->push('inicio');{}
});

$router->get('inicio', function ($app) {
	// Redireccionar si no esta logueado
	!isset($_SESSION['user_id']) && $app->push('login');

	$data = [];
	if (isset($_SESSION['mensaje'])) {
		$data['mensaje'] = $_SESSION['mensaje'];
		unset($_SESSION['mensaje']);
	}

	$data['listaUsuarios'] = (new App\Models\Usuario())->getAll();
	$app->view('inicio.php', $data);
});


$router->get('login', function ($app) {
	// Redireccionar si ya esta logueado
	isset($_SESSION['user_id']) && $app->push('inicio');

	$data = [];
	if (isset($_SESSION['mensaje'])) {
		$data['mensaje'] = $_SESSION['mensaje'];
		unset($_SESSION['mensaje']);
	}

	$app->view('login.php', $data);
});

$router->post('login_handler',function ($app) {
	// Redireccionar si no existen los parametros correctos
	if (empty($_POST['usuario']) && empty($_POST['password'])) {
		$_SESSION['mensaje'] = 'Datos de login incorrectos.';
		$app->push('login');
	}

	$usuario = (new App\Models\Usuario())->getByUsuario($_POST['usuario']);

	if (isset($usuario) && password_verify($_POST['password'], $usuario['password'])){
		$_SESSION['user_id'] = $usuario['id'];
		$_SESSION['nombre'] = $usuario['nombre'];
		$_SESSION['apellido'] = $usuario['apellido'];
		$app->push('inicio');
	}

	$_SESSION['mensaje'] = 'Datos de login incorrectos.';
	$app->push('login');
});

$router->get('editar', function ($app) {
	// Redireccionar si no esta logueado
	!isset($_SESSION['user_id']) && $app->push('login');

	$data = [];
	if (isset($_SESSION['mensaje'])) {
		$data['mensaje'] = $_SESSION['mensaje'];
		unset($_SESSION['mensaje']);
	}
	// LOGICA
	$data['id'] = $_GET['id'] ?? NULL;
	if ($data['id']) $data['usuario'] = (new App\Models\Usuario())->get($data['id']);

	$app->view('editar.php', $data);
});

$router->post('editar_handler', function ($app) {
	// Redireccionar si no esta logueado
	!isset($_SESSION['user_id']) && $app->push('login');
	
	$modelUsuario = new App\Models\Usuario();

	$password = 
		(isset($_POST['password']) && 
		strlen(trim($_POST['password'])) == 0) ? NULL : $_POST['password']; 

	$usuario = [
		'id' => $_POST['id'] ?? NULL, 
		'nombre'=> $_POST['nombre'],
		'usuario' => $_POST['usuario'],
		'apellido' => $_POST['apellido'],
		'password' => $password
	];

	$inserto = $modelUsuario->{isset($usuario['id']) ? 'update': 'insert'}($usuario);
	$_SESSION['mensaje'] = $inserto ?  'Registro guardado correctamente.' : 'Fallo al guardar registro.';
	$app->push('inicio');
});

$router->get('eliminar_handler', function ($app) {
	// Redireccionar si no esta logueado
	!isset($_SESSION['user_id']) && $app->push('login');
	
	if (!isset($_GET['id'])) $app->push('inicio');
	$modelUsuario = new App\Models\Usuario();
	$count = $modelUsuario->delete($_GET['id']);
	$_SESSION['mensaje'] = ($count > 0 ? 
		'Registro eliminado correctamente.' : 
		'Fallo al eliminar registro.');
	$app->push('inicio');
});

$router->get('logout', function ($app) { 
	session_start();
	session_unset();
	session_destroy();
	$app->push('inicio');
});

$router->get('registrar', function ($app) {
	// Redireccionar si ya esta logueado
	isset($_SESSION['user_id']) && $app->push('inicio');

	$data = [];
	if (isset($_SESSION['mensaje'])) {
		$data['mensaje'] = $_SESSION['mensaje'];
		unset($_SESSION['mensaje']);
	}

	$app->view('registrar.php', $data);
});

$router->post('registrar_handler', function ($app) {

	$usuario = [
		'id' => $_POST['id'] ?? NULL, 
		'nombre'=> $_POST['nombre'],
		'usuario' => $_POST['usuario'],
		'apellido' => $_POST['apellido'],
		'password' => $_POST['password'] ?? NULL];

	$result = (new App\Models\Usuario())->insert($usuario);

	if ($result) {
		$_SESSION['mensaje'] = 'Usuario agregado correctamente.'; 
		$app->push('login');
	} else {
		$_SESSION['mensaje'] = 'Error al agregar usuario.'; 
		$app->push('registrar');
	}
});

$router->get('peliculas', function () {
	echo json_encode([
		['id' => 1, 'nombre' => 'pepe'],
		['id' => 2, 'nombre' => 'pepe'],
		['id' => 3, 'nombre' => 'pepe']
	]);
});
