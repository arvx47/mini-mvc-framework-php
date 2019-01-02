<?php 

namespace App\Models;

use App\Core\Model;

class Usuario extends Model {
		
	public function __construct() {
		parent::__construct("usuarios");
	}

	public function getByUsuario($usuario) {
		$statement = $this->dbInstance->prepare("SELECT * FROM {$this->tableName} WHERE usuario = :usuario");
		$statement->bindParam(':usuario', $usuario);
		$statement->execute();
		return $statement->fetch(\PDO::FETCH_ASSOC);
	}

	public function insert($data) {

		$query = <<<EOD
			INSERT INTO {$this->tableName} 
				(nombre, apellido, usuario, password) 
			VALUES 
				(:nombre, :apellido, :usuario, :password)
EOD;

		$password = password_hash($data['password'], PASSWORD_BCRYPT);
	
		$statement = $this->dbInstance->prepare($query);
		$statement->bindParam(':nombre', $data["nombre"]);
		$statement->bindParam(':apellido', $data["apellido"]);
		$statement->bindParam(':usuario', $data["usuario"]);
		$statement->bindParam(':password', $password);
		return $statement->execute();
	}

	public function update($data) {

		$query = <<<EOD
		UPDATE {$this->tableName} 
		SET 
			nombre = :nombre,
		 	apellido = :apellido, 
		 	usuario = :usuario,
		 	password = COALESCE(:password, password)
		WHERE 
			id = :id
EOD;
		$password = $data["password"] ? password_hash($data['password'], PASSWORD_BCRYPT) : NULL;
		$statement = $this->dbInstance->prepare($query);
		$statement->bindParam(':id', $data["id"]);
		$statement->bindParam(':usuario', $data["usuario"]);
		$statement->bindParam(':nombre', $data["nombre"]);
		$statement->bindParam(':apellido', $data["apellido"]);
		$statement->bindParam(':password', $password);
		return $statement->execute();
	}
}