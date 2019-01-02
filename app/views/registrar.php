<!DOCTYPE html>
<html>
<head>
	<title>Registrar</title>
</head>
<body>

	<!-- MENSAJE  -->
	<?php require(__DIR__."/layout/mensaje.php") ?>

	<h2>Formulario de Registro:</h2>

	<h4>Datos</h4>

	<form action="registrar_handler" method="POST">
		<fieldset>
			<input 
				name="usuario" 
				type="text" 
				placeholder="Nombre de Usuario"  
				required> 
			<br>
			<input 
				name="nombre" 
				type="text" 
				placeholder="Nombre"  
				required> 
			<br>
			<input 
				name="apellido" 
				type="text" 
				placeholder="Apellido"  
				required> 
			<br>
			<input 
				name="email" 
				type="text" 
				placeholder="Email"  
				required> 
			<br>
			<input 
				name="password" 
				type="password"
				placeholder="Contraseña"  
				required> 
			<br>
			<input type="submit">
		</fieldset>
	</form>

</body>
</html>
