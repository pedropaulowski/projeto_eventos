<?php
session_start();
require 'usuarios.class.php';
require 'curtidas.class.php';

$usuarios = new Usuarios();
$curtidas = new Curtidas();

if(empty($_SESSION['id'])) {
	header("Location:login.php");
}
$id = $_SESSION['id'];
$usuarios->getNomeLogado($id);
?>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Página Inicial</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="bootstrap.min.css"/>
	<script type="text/javascript" src="popper.min.js"></script>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</head>
<body class="bg-light">
<div class="container-fluid">
		<div class="row bg-primary justify-content-around align-items-center">
			<div class="col-xs-3">
				<h1 class="text-light">Gaebal Eventos</h1>
			</div>
			<div class="col-xs-9">
				<button class="btn btn-dark"><a href="index.php" class="text-light">Página inicial</a></button>
				<button class="btn btn-dark"><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>" class="text-light"><?php echo $usuarios->getNomeLogado($id);?></a></button>
				<button class="btn btn-danger"><a href="sair.php" class="text-light">Sair</a></button>
			</div>
		</div>
		<div class="row justify-content-center bg-light">
			<div class="col-xs-6"><h2>O que deseja?</h2></div>
		</div>
		<div class="row justify-content-center">
			<div class="col-xs-4">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title"><a href="eventos-criados.php?id_criador=<?php echo $id; ?>">Eventos Criados</a></h5>
						<p class="card-text">Aqui estão os eventos que você criou.</p>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title"><a href="criar-evento.php">Criar Evento</a></h5>
						<p class="card-text">Aqui você poderá criar um evento como quiser.</p>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title"><a href="ver-eventos.php?categoria=0">Ver Eventos</a></h5>
						<p class="card-text">Aqui você visualiza todos eventos e pode se inscrever neles.</p>
					</div>
				</div>
			</div>
		</div>
</div>
</body>
</html>