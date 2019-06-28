<?php
class Eventos {
	private $pdo;

	public function __construct() {
		$this->pdo = new PDO("mysql:dbname=projeto_sympla;host=localhost", "root", "");
	}

	public function setEvento($id_criador, $nome_criador, $titulo, $descricao, $data, $hora, $endereco, $status) {
		$sql = "INSERT INTO eventos (id_criador, titulo, descricao, data, hora, endereco) VALUES (:id_criador, :titulo, :descricao, :data, :hora, :endereco)";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_criador", $id_criador);
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":descricao", $descricao);
		$sql->bindValue(":data", $data);
		$sql->bindValue(":hora", $hora);
		$sql->bindValue(":endereco", $endereco);
		$sql->execute();

	}

	public function getAllAbertos() {
		$sql = $this->pdo->query("SELECT * FROM eventos WHERE status = 0");
		if($sql->rowCount() > 0) {
			return $sql->fetchAll();
		} else {
			return array();
		}
	}

	public function getEvento($id) {
		$sql = "SELECT * FROM eventos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return true;
		} else {
			return false;
		}
	}

	public function existeEvento($id) {
		$sql = "SELECT * FROM eventos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getTituloById($id) {
		$sql = "SELECT * FROM eventos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();

			return $sql['titulo'];
		} else {
			return false;
		}
	}

	public function getCriadorByIdCriador($id_criador) {
		$sql = "SELECT * FROM usuarios WHERE id = :id_criador";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_criador", $id_criador);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();

			return $sql['nome'];
		} else {
			return false;
		}
	}

	public function getDescricaoById($id) {
		$sql = "SELECT * FROM eventos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['descricao'];
		} else {
			return false;
		}
	}

	public function getDataById($id) {
		$sql = "SELECT * FROM eventos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['data'];
		} else {
			return false;
		}
	}

	public function getHoraById($id) {
		$sql = "SELECT * FROM eventos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['hora'];
		} else {
			return false;
		}
	}

	public function getEnderecoById($id) {
		$sql = "SELECT * FROM eventos WHERE id = :id";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['endereco'];
		} else {
			return false;
		}
	}

	public function getEventosByIdCriador($id_criador) {
		$sql = "SELECT * FROM eventos WHERE id_criador = :id_criador";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_criador", $id_criador);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return $sql->fetchAll();
		} else {
			return false;
		}
	}

	public function getEventosByIdUsuario($id_usuario) {
		$sql = "SELECT * FROM inscricoes WHERE id_usuario = :id_usuario";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":id_usuario", $id_usuario);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return $sql->fetchAll();
		} else {
			return "Não se inscriveu em nenhum, <a href='ver-eventos.php'>veja os eventos!</a>";
		}
	}
	public function getEventoByIngresso($ingresso) {
		$sql = "SELECT * FROM inscricoes WHERE ingresso = :ingresso";
		$sql = $this->pdo->prepare($sql);
		$sql->bindValue(":ingresso", $ingresso);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['nome_evento'];
		} else {
			return false;
		}
	}
}
?>