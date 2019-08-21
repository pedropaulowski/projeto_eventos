<?php
session_start();
require 'eventos.class.php';
require 'inscricoes.class.php';
require 'usuarios.class.php';
$usuarios = new Usuarios(); 

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
	header("Location:login.php");
}
$id_criador = $_SESSION['id'];
if(isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['data']) && isset($_POST['hora']) && isset($_POST['endereco']) && !empty($_POST['titulo']) && !empty($_POST['descricao']) && !empty($_POST['data']) && !empty($_POST['hora']) && !empty($_POST['endereco'])){
	$id_criador = $_SESSION['id'];
	$titulo = addslashes($_POST['titulo']);
	$descricao = addslashes($_POST['descricao']);
	$data = addslashes($_POST['data']);
	$hora = addslashes($_POST['hora']);
	$endereco = addslashes($_POST['endereco']);
    $categoria = addslashes($_POST['categoria']);
	$eventos = new Eventos();
	$eventos->setEvento($id_criador, $titulo, $descricao, $data, $hora, $endereco, $categoria);

	header("Location:index.php");
}
$id = $id_criador;
?>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Gaebal - Criar evento</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="title" content="Gaebal - Criar Evento"/>
	<meta name="keywords" content="Eventos, Sympla, Gaebal, Paulowski, Compra, Venda"/>
	<meta name="descripton" content="Publique eventos e se inscreva gratuitamente. Segurança total e geramos os ingressos e QRCode para você, entre e conheça!"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="theme-color" content="#007bff"/>
	<meta property="og:title" content="Gaebal Eventos"/>
	<meta property="og:type" content="article"/>
	<meta property="og:url" content="https://paulowski.gq/criar-evento.php"/>
	<meta property="og:image" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<meta property="og:image:secure_url" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<meta property="og:description" content="Publique eventos gratuitamente e se inscreva. Segurança total e geramos os ingressos e QRCode para você, entre e conheça!"/>
	<meta property="fb:app_id" content="589392398495320"/>
	<meta name="twitter:image" content="https://paulowski.gq/gaebal/lamp_black.png"/>
	<link rel="shortcut icon" type="image/svg" href="https://paulowski.gq/gaebal/lamp_black.png"/>
	<link rel="canonical" href="https://paulowski.gq/criar-evento.php"/>
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
		<div class="col-xs-6"><h2>Criar evento</h2></div>
	</div>
	<div class="row justify-content-center">	
		<div class="col-xs-8">
			<form method="POST">
				<div class="form-group">		
					<label for="inputAddress">Título</label>
					<input type="text"  class="form-control" placeholder="Nome do evento" name="titulo"/>				
					<label for="inputAddress">Descrição</label>
					<input type="text"  class="form-control"  placeholder="Descreva o evento" name="descricao"/>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col">
							<label for="inputAddress">Data</label>
							<input type="date"  class="form-control" name="data"/>
						</div>
						<div class="col">
							<label for="inputAddress">Hora</label>
							<input type="time"  class="form-control" name="hora"/>
						</div>
						<div class="col">
							<label>Categoria</label>
							<select class="form-control" name="categoria">
								<option value="1">Festa</option>
								<option value="2">Palestra</option>
								<option value="3">Encontro de pessoas</option>
								<option value="4">Evento Esportivo</option>
								<option value="5">Evento de E-sports</option>
								<option value="6">Evento Universitário</option>
							</select>			
						</div>
					</div>
				</div>
				<div>
				<label >Endereço</label>
				<input type="text"  class="form-control" name="endereco"/>
				</div>
				<br/>
				<div class="float-right">
				<button type="submit" class="btn btn-success">Criar evento</button>
				</div>
			</div>
							
			</form>
		</div>
	</div>
</div>
</body>
</html>
