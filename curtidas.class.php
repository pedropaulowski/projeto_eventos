<?php
class Curtidas {
	private $pdo;

	public function __construct() {
		$this->pdo = new PDO("mysql:dbname=projeto_sympla;host=localhost", "root", "");
	}

	public function curtir($id_usuario, $nome_usuario) {
		if($this->curtidaExiste($id_usuario) == false) {
			$sql = "INSERT INTO curtidas (id_usuario, nome_usuario) VALUES (:id_usuario, :nome_usuario)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":id_usuario", $id_usuario);
			$sql->bindValue(":nome_usuario", $nome_usuario);
			$sql->execute();

			return true;
		} else {
			return false;
		}

	}

	public function curtidaExiste($id_usuario) {
		$sql = "SELECT * FROM curtidas WHERE id_usuario = :id_usuario";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_usuario", $id_usuario);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function showCountCurtidas() {
		$sql = $this->pdo->query("SELECT * FROM curtidas");
		
		if($sql->rowCount() > 0) {
			return $sql->rowCount();
		} else {
			return false;
		}
	}
}

?>
