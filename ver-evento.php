<?php
session_start();
require 'eventos.class.php';
require 'usuarios.class.php';
require 'inscricoes.class.php';

$eventos = new Eventos();
$inscricoes = new Inscricoes();

if(isset($_GET['id_evento']) && !empty($_GET['id_evento']) && isset($_GET['id_criador']) && !empty($_GET['id_criador'])){
	$id = addslashes($_GET['id_evento']);
	$id_criador = addslashes($_GET['id_criador']);
	$id_evento = addslashes($_GET['id_evento']);
	$inscricoes->showCountInscricoes($id_evento);

	if($eventos->getEvento($id) == true){
		$eventos->getTituloById($id);
		$eventos->getCriadorByIdCriador($id_criador);
		$eventos->getDescricaoById($id);
		$eventos->getDataById($id);
		$eventos->getHoraById($id);
		$eventos->getEnderecoById($id);
		$inscricoes->showCountInscricoes($id_evento);

	} else{
		header("Location:ver-eventos.php");
	}
} else {
	header("Location:ver-eventos.php");
}
$id = $_SESSION['id'];
$usuarios = new Usuarios();
$usuarios->getNomeLogado($id);
?>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo $eventos->getTituloById($id_evento);?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="title" content="<?php echo $eventos->getTituloById($id_evento);?>"/>
	<meta name="keywords" content="Eventos, Sympla, Gaebal, Paulowski"/>
	<meta name="descripton" content="<?php echo $eventos->getDescricaoById($id_evento); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="theme-color" content="#007bff"/>
	<meta property="og:title" content="<?php echo $eventos->getTituloById($id_evento);?>"/>
	<meta property="og:type" content="article"/>
	<meta property="og:url" content="https://paulowski.gq/ver-evento.php?id_evento=<?php echo $id_evento;?>&id_criador=<?php echo $id_criador;?>"/>
	<meta property="og:image" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<meta property="og:image:secure_url" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<meta property="og:description" content="<?php echo $eventos->getDescricaoById($id_evento); ?>"/>
	<meta property="fb:app_id" content="589392398495320"/>
	<meta name="twitter:image" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<link rel="shortcut icon" type="image/png" href="https://paulowski.gq/gaebal/lamp_black.png"/>
	<link rel="canonical" href="https://paulowski.gq/ver-evento.php?id_evento=<?php echo $id_evento;?>&id_criador=<?php echo $id_criador;?>"/>
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
			<?php if(isset($_SESSION['id'])): ?>
			<button class="btn btn-dark"><a href="index.php" class="text-light">Página inicial</a></button>
			<button class="btn btn-dark"><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>" class="text-light"><?php echo $usuarios->getNomeLogado($id);?></a></button>
			<button class="btn btn-danger"><a href="sair.php" class="text-light">Sair</a></button>
		    <?php else: ?>
		    <button class="btn btn-light"><a href="login.php" class="text-dark">Log In</a></button>
		   	<button class="btn btn-danger"><a href="cadastro.php" class="text-light">Cadastre-se</a></button>
		    <?php endif;?>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-xs-12">
			<div class="card" style="width: 18rem;">
				<div class="card-body text-center">
					<h3 class="card-title"><?php echo $eventos->getTituloById($id_evento);?></h3>
					<p class="card-text"><?php echo $eventos->getDescricaoById($id_evento); ?></p>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Inscritos: <?php echo $inscricoes->showCountInscricoes($id_evento); ?></li>
					<li class="list-group-item">Organizador: <?php echo $eventos->getCriadorByIdCriador($id_criador); ?></li>
					<li class="list-group-item">Data: <?php echo $eventos->getDataById($id_evento); ?></li>
					<li class="list-group-item">Hora: <?php echo $eventos->getHoraById($id_evento); ?></li>
					<li class="list-group-item">Endereço: <?php echo $eventos->getEnderecoById($id_evento); ?></li>
				</ul>
				<div class="card-body">
					<button class="btn btn-danger"><a href="inscrever.php?id_evento=<?php echo $_GET['id_evento'].'&id_criador='.$_GET['id_criador']; ?>" class="text-light">Inscreva-se agora!</a></button>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>