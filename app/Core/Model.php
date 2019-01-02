<?php
namespace App\Core;

class Model {

	protected $table, $dbInstance;

	public function __construct($table) {
		$this->table = $table;
		$this->dbInstance = Database::getInstance();
	}

	public function getAll() {
		$statement = $this
			->dbInstance
			->query("select * from {$this->table}");
		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function get($id) {
		$statement = $this
			->dbInstance
			->prepare("SELECT * FROM {$this->table} WHERE id = :id");
		$statement->bindParam(':id', $id);
		$statement->execute();
		return $statement->fetch(\PDO::FETCH_ASSOC);
	}

	public function delete($id) {
		return $this
			->dbInstance
			->exec("delete from {$this->table} where id = {$id}");
	}

}