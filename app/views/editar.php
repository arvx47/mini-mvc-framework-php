<!DOCTYPE html>
<html>
<head>
	<title>Editar / Crear</title>
</head>
<body>
	
	<!-- MENSAJE  -->
	<?php require(__DIR__."/layout/mensaje.php") ?>

	<h3>Crear / Editar Usuario</h3>
	
	<form method="post" action="editar_handler">
		<fieldset>

			<?php if (isset($data["usuario"])): ?>
			Id:
			<input name="id" 
				type="text" 
				value="<?= $data["usuario"]['id'] ?>"
				readonly><br>
			<?php endif; ?>

			Usuario: 
			<input 
				name="usuario" 
				type="text" 
				placeholder="Usuario" 
				required
				value="<?= $data["usuario"]['usuario'] ?? NULL ?>"><br>

			Nombre: 
			<input 
				name="nombre" 
				type="text" 
				placeholder="Nombre" 
				required 
				value="<?= $data["usuario"]['nombre'] ?? NULL ?>"><br>

			Apellido: 
			<input 
				name="apellido" 
				type="text" 
				placeholder="Apellido" 
				required
				value="<?= $data["usuario"]['apellido'] ?? NULL ?>"><br>
 
			Password: 
			<input 
				name="password"
				type="text"  
				placeholder="Password"><br>

			<input type="submit" name="Guardar" value="Guardar">
		</fieldset>
	</form>


	<br>
	<a href="inicio">Inicio</a> | 
	<a href="logout">Cerrar sesión?</a>

</body>
</html>