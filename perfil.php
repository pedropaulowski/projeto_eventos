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
$id = addslashes($_GET['id']);
?>

<html>
<head>
<head>
	<meta charset="utf-8"/>
	<title><?php echo $usuarios->getNomeLogado($id); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="title" content="Gaebal Eventos - <?php echo $usuarios->getNomeLogado($id); ?>"/>
	<meta name="keywords" content="Eventos, Sympla, Gaebal, Paulowski, Compra, Venda"/>
	<meta name="descripton" content="Publique eventos e se inscreva gratuitamente. Segurança total e geramos os ingressos e QRCode para você, entre e conheça!"/>
	<meta name="theme-color" content="#007bff"/>
	<meta property="og:title" content="Gaebal Eventos"/>
	<meta property="og:type" content="article"/>
	<meta property="og:url" content="https://paulowski.gq/perfil.php?id=<?php echo $id; ?>"/>
	<meta property="og:image" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<meta property="og:image:secure_url" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<meta property="og:description" content="Publique eventos gratuitamente e se inscreva. Segurança total e geramos os ingressos e QRCode para você, entre e conheça!"/>
	<meta property="fb:app_id" content="589392398495320"/>
	<meta name="twitter:image" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<link rel="shortcut icon" type="image/png" href="https://paulowski.gq/gaebal/lamp_black.png"/>
	<link rel="canonical" href="https://paulowski.gq/perfil.php?id=<?php echo $id; ?>"/>
	<link rel="stylesheet" href="bootstrap.min.css"/>
	<script type="text/javascript" src="popper.min.js"></script>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</head>
<body class="bg-light">
<div class="container-fluid">
	<div class="row bg-primary justify-content-around align-items-center">
		<div class="col-xs-3">
		    <h1 class="text-light"><img src="gaebal/lamp_white.png" width="55"/></h1>
		</div>
		<div class="col-xs-9">
			<button class="btn btn-dark"><a href="index.php" class="text-light">Página inicial</a></button>
			<button class="btn btn-dark"><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>" class="text-light"><?php echo $usuarios->getNomeLogado($id);?></a></button>
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
