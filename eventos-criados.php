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
	<meta name="title" content="Gaebal Eventos - Meus Eventos"/>
	<meta name="keywords" content="Eventos, Sympla, Gaebal, Paulowski, Compra, Venda"/>
	<meta name="descripton" content="Publique eventos e se inscreva gratuitamente. Segurança total e geramos os ingressos e QRCode para você, entre e conheça!"/>
	<meta name="theme-color" content="#007bff"/>
	<meta property="og:title" content="Gaebal Eventos"/>
	<meta property="og:type" content="article"/>
	<meta property="og:url" content="https://paulowski.gq/eventos-criados.php"/>
	<meta property="og:image" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<meta property="og:image:secure_url" content="https://paulowski.gq/gaebal/lamp_blakc.png"/>
	<meta property="og:description" content="Publique eventos gratuitamente e se inscreva. Segurança total e geramos os ingressos e QRCode para você, entre e conheça!"/>
	<meta property="fb:app_id" content="589392398495320"/>
	<meta name="twitter:image" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<link rel="shortcut icon" type="image/png" href="https://paulowski.gq/gaebal/lamp_black.png"/>
	<link rel="canonical" href="https://paulowski.gq/eventos-criados.php"/>
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
		<div class="col-xs-6"><h2>Meus eventos</h2></div>
	</div>
	<div class="container">
		<div class="row justify-content-center">
			<?php
			if(isset($_GET['id_criador']) && !empty($_GET['id_criador'])) {
			$id_criador = addslashes($_GET['id_criador']);
			$lista = $eventos->getEventosByIdCriador($id_criador);

			if($eventos->getEventosByIdCriador($id_criador) == false){
				header("Location:index.php");
			} else {
			foreach ($lista as $evento):
			?>
			<div class="col-xs-4">
				<div class="card" style="width: 18rem;">
					<div class="card-body text-center">
						<h3 class="card-title"><?php echo $evento['titulo'];?></h3>
						<p class="card-text"><?php echo $evento['descricao']; ?></p>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
						Inscritos: <?php $id_evento = $evento['id'];
						echo $inscricoes->showCountInscricoes($id_evento); ?></li>
						<li class="list-group-item">Organizador: <?php echo $eventos->getCriadorByIdCriador($id_criador); ?></li>
						<li class="list-group-item">Endereço: <?php echo $evento['endereco']; ?></li>
					</ul>
					<div class="card-body text-center">
						<button class="btn btn-danger"><a href="inscrever.php?id_evento=<?php echo $evento['id'].'&id_criador='.$evento['id_criador']; ?>" class="text-light">Inscrever</a></button>
						<button class="btn btn-success"><a href="ver-evento.php?id_evento=<?php echo $evento['id'].'&'."id_criador=".$evento['id_criador']; ?>" class="text-light">+INFO</a></button>
					</div>
				</div>
			</div>
			<?php endforeach;
			}
			}
			?>
		</div>
	</div>
</div>
</body>
</html>
