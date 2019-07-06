<?php
session_start();
require 'usuarios.class.php';
require 'inscricoes.class.php';
require 'eventos.class.php';

$usuarios = new Usuarios();
$eventos = new Eventos();
$inscricoes = new Inscricoes();

if(empty($_SESSION['id'])) {
	header("Location:login.php");
}

if(isset($_GET['id']) && !empty($_GET['id']) && $_SESSION['id'] == $_GET['id']) {
	$id = addslashes($_GET['id']);
	$id_usuario = addslashes($_GET['id']);
	$usuarios->getNomeLogado($id);
	$eventos->getEventosByIdUsuario($id_usuario);
} else {
	header("Location:index.php");
}
?>

<html>
<head>
<head>
	<meta charset="utf-8"/>
	<title>Criar evento</title>
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
		<div class="col-xs-6"><h2>Enventos Inscritos</h2></div>
	</div>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<table class="table table-hover table-light" >
				<tr>
					<th>Evento</th>
					<th>Ingresso</th>	
				</tr>
				<?php
				if($eventos->getEventosByIdUsuario($id_usuario) != false){
				$lista = $eventos->getEventosByIdUsuario($id_usuario);
				foreach ($lista as $evento):
				?>
				<tr>
					<td><?php echo $evento['nome_evento']; ?></td>
					<td><a href="ingresso.php?ingresso=<?php echo $evento['ingresso']; ?>" target="_blank">Ver ingresso</a></td>	
				</tr>
				<?php endforeach;}?>
			</table>
		</div>
	</div>
</div>
</body>
</html>
