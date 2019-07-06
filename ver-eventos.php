<?php
session_start();
require 'eventos.class.php';
require 'usuarios.class.php';
require 'inscricoes.class.php';

if(empty($_SESSION['id'])) {
	header("Location:login.php");
}

$eventos = new Eventos();
$inscricoes = new Inscricoes();

$id = $_SESSION['id'];
$usuarios = new Usuarios();
$usuarios->getNomeLogado($id);
?>

<html>
<head>
	<meta charset="utf-8"/>
	<title>Ver ventos</title>
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
		<div class="col-xs-6"><h2>Aqui estão todos eventos</h2></div>
	</div>
	<div class="row justify-content-center">
		<div class="col-xs-12">
			<div class="table-responsive-sm">
				<table class="table table-hover table-light">
					<tr>
						<th>Titulo</th>
						<th>Data (Ano-Mês-Dia)</th>
						<th>Horário</th>
						<th>Inscritos</th>
						<th>Ações</th>		
					</tr>
					<?php
					$lista = $eventos->getAllAbertos();
					foreach ($lista as $evento):
					?>
					<tr>
						<td><?php echo $evento['titulo']; ?></td>
						<td><?php echo $evento['data']; ?></td>
						<td><?php echo $evento['hora']; ?></td>
						<td><?php $id_evento = $evento['id'];
						echo $inscricoes->showCountInscricoes($id_evento); ?></td>
						<td><button class="btn btn-danger"><a href="inscrever.php?id_evento=<?php echo $evento['id'].'&'."id_criador=".$evento['id_criador']; ?>" class="text-light">Inscrever-se</a></button><button class="btn btn-success"><a href="ver-evento.php?id_evento=<?php echo $evento['id'].'&'."id_criador=".$evento['id_criador']; ?>" class="text-light">+ INFO</a></button></td>						
					</tr>
					<?php endforeach;?>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>
