<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	
	<!-- MENSAJE  -->
	<?php require(__DIR__."/layout/mensaje.php") ?>

	<h2>Porfavor inicie su sesión o <a href="registrar">registrese</a></h2>

	<h4>Login</h4>

	<form action="login_handler" method="POST">
		<input type="text" placeholder="Nombre de Usuario" name="usuario" required> <br>
		<input type="password" placeholder="Contraseña" name="password" required> <br>
		<input type="submit">
	</form>

</body>
</html>
