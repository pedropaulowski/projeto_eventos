<?php
class Inscricoes {
	private $pdo;

	public function __construct() {
		$this->pdo = new PDO("mysql:dbname=projeto_sympla;host=localhost", "root", "");
	}

	public function inscrever($id_evento, $id_usuario, $nome_usuario) {
		if($this->alreadySubscribed($id_evento, $id_usuario) == false) {
			$sql = "INSERT INTO inscricoes (id_evento, id_usuario, nome_usuario, ingresso) VALUES (:id_evento, :id_usuario, :nome_usuario, :ingresso)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":id_evento", $id_evento);
			$sql->bindValue(":id_usuario", $id_usuario);
			$sql->bindValue(":nome_usuario", $nome_usuario);
			$sql->bindValue(":ingresso", md5(md5($id_evento.md5(rand(0, 10000))).$id_usuario.md5($nome_usuario)));		
			$sql->execute();

			return true;
		} else {
			return false;
		}
	}

	public function showCountInscricoes($id_evento) {
		$sql = "SELECT * FROM inscricoes WHERE id_evento = :id_evento";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_evento", $id_evento);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return $sql->rowCount();
		} else {
			return "Ainda não há inscrições";
		}
	}

	public function alreadySubscribed($id_evento, $id_usuario) {
		$sql = "SELECT * FROM inscricoes WHERE id_evento = :id_evento AND id_usuario = :id_usuario";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_evento", $id_evento);
		$sql->bindValue(":id_usuario", $id_usuario);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}


}
?>