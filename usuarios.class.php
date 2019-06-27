<?php
class Usuarios {
	private $pdo;

	public function __construct() {
		$this->pdo = new PDO("mysql:dbname=projeto_sympla;host=localhost", "root", "");
	}

	public function setUsuario($nome, $email, $senha) {
		if($this->existeEmail($email) == false) {
			$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", md5($senha));
			$sql->execute();

			return true;
		} else {
			return false;
		}
	}

	public function logIn($email, $senha) {
		$sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":senha", md5($senha));
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$id = $sql['id'];
			$_SESSION['id'] = $id;

			return true;
		} else {
			return false;
		}
	}

	public function existeEmail($email) {
		$sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true; 
		} else {
			return false;
		}
	}

	public function getAllUsuarios() {
		$sql = $this->pdo->query("SELECT * FROM usuarios");

		if($sql->rowCount() > 0) {
			return $sql->fetchAll();
		} else {
			return array();
		}
	}

	public function getNomeLogado($id) {
		$sql = "SELECT * FROM usuarios WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();

			return $sql['nome'];
		} else {
			return false;
		}
	}

	public function getUsuariosById($id_usuario) {
		$sql = "SELECT * FROM usuarios WHERE id = :id_usuario";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_usuario", $id_usuario);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['nome'];
		} else {
			return array();
		}
	}


}
?>