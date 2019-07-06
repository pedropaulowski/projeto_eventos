<?php
session_start();
require 'usuarios.class.php';
require 'eventos.class.php';
require 'inscricoes.class.php';

if(empty($_SESSION['id'])) {
	header("Location:login.php");
}
$usuarios = new Usuarios();
$eventos = new Eventos();
$inscricoes = new Inscricoes;
$id = $_SESSION['id'];
?>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Meus Eventos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="bootstrap.min.css"/>
	<script type="text/javascript" src="popper.min.js"></script>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</head>
<body class="bg-light">
<div class="container-fluid">
	<div class="row bg-primary justify-content-between">
		<div class="col-xs-3">
			<h1 class="text-light">Gaebal Eventos</h1>
		</div>
		<div class="col-xs-9">
			<a href="index.php" class="text-light">Página inicial</a>
			<a href="perfil.php?id=<?php echo $_SESSION['id']; ?>" class="text-light"><?php echo $usuarios->getNomeLogado($id);?></a>
			<button class="btn btn-danger"><a href="sair.php" class="text-light">Sair</a></button>
		</div>
	</div>
	<div class="row justify-content-center bg-light">
		<div class="col-xs-6"><h2>Meus eventos</h2></div>
	</div>
	<div class="row justify-content-center">
		<div class="col-xs-10">
			<table class="table table-hover table-light">
				<thead>
					<tr>
						<th scope="col">Titulo</th>
						<th scope="col">Data (Ano-Mês-Dia)</th>
						<th scope="col">Horário</th>
						<th scope="col">Inscritos</th>
						<th scope="col">Ações</th>		
					</tr>
				</thead>
				<tbody>
					<?php
					if(isset($_GET['id_criador']) && !empty($_GET['id_criador'])) {
					$id_criador = addslashes($_GET['id_criador']);
					$lista = $eventos->getEventosByIdCriador($id_criador);

					if($eventos->getEventosByIdCriador($id_criador) == false){
						header("Location:index.php");
					} else {
					foreach ($lista as $evento):
					?>
					<tr>
						<td><?php echo $evento['titulo']; ?></td>
						<td><?php echo $evento['data']; ?></td>
						<td><?php echo $evento['hora']; ?></td>
						<td><?php $id_evento = $evento['id'];
						echo $inscricoes->showCountInscricoes($id_evento); ?></td>
						<td><button class ="btn btn-danger"><a href="inscrever.php?id_evento=<?php echo $evento['id'].'&'."id_criador=".$evento['id_criador']; ?>" class="text-light">Inscrever-se</a></button><button class="btn btn-success"><a href="ver-evento.php?id_evento=<?php echo $evento['id'].'&'."id_criador=".$evento['id_criador']; ?>" class="text-light">+INFO</a></button></td>						
					</tr>
					<?php endforeach;
					}
					}
					?>
				</tbody>
			</table>
			
		</div>
		
	</div>
</div>
</body>
</html>
