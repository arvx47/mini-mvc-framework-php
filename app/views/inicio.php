<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
</head>
<body>
	
	<!-- MENSAJE  -->
	<?php require(__DIR__."/layout/mensaje.php") ?>

	<h3>Bienvenido "<?= $_SESSION["nombre"] . " " . $_SESSION["apellido"]?> " </h3>

	<table border>
		<caption>Lista de Usuarios</caption>
		<thead>
			<tr>
				<th>id</th>
				<th>usuario</th>
				<th>nombre</th>
				<th>apellido</th>
				<th>acción</th>
			</tr>
		</thead>
		<tbody>

		<?php foreach ($data["listaUsuarios"] as $key => $usuario): ?>
		<tr>
			<td> <?= $usuario["id"] ?> </td>
			<td> <?= $usuario["usuario"] ?> </td>
			<td> <?= $usuario["nombre"] ?> </td>
			<td> <?= $usuario["apellido"] ?> </td>
			<td> 
				<a href="editar?id=<?= $usuario['id'] ?>">Editar</a> 
			 	<a href="eliminar_handler?id=<?= $usuario['id'] ?>">Elimnar</a> 
			</td>
		</tr>
		<?php endforeach; ?>
			
		</tbody>
	</table>
	<a href="editar">+Nuevo usuario</a>
	<br>

	<br>
	<a href="logout">Cerrar sesión?</a>

</body>
</html>
