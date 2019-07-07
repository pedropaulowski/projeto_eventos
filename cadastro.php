<?php
session_start();
require 'usuarios.class.php';

if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
	header("Location:index.php");
}

if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
	$nome = addslashes($_POST['nome']);
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);

	$usuarios = new Usuarios();

	if($usuarios->setUsuario($nome, $email, $senha) == true) {
		$usuarios->logIn($email, $senha);
		header("Location:index.php");
	} else {
		echo "Usuário já existe";
	}
}
?>

<html>
<head>
	<meta charset="utf-8"/>
	<title>Gaebal Eventos - Cadastro</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="title" content="Gaebal Eventos - Cadastro"/>
	<meta name="keywords" content="Eventos, Sympla, Gaebal, Paulowski"/>
	<meta name="descripton" content="Publique eventos gratuitamente e se inscreva. Segurança total e geramos os ingressos e QRCode para você, entre e conheça!"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="theme-color" content="#007bff"/>
	<meta property="og:title" content="Gaebal Eventos"/>
	<meta property="og:type" content="article"/>
	<meta property="og:url" content="https://paulowski.gq/cadastro.php"/>
	<meta property="og:image" content="https://paulowski.gq/imgs/paulowskige.png"/>
	<meta property="og:image:secure_url" content="https://paulowski.gq/imgs/paulowskige.png"/>
	<meta property="og:description" content="Publique eventos gratuitamente e se inscreva. Segurança total e geramos os ingressos e QRCode para você, entre e conheça!"/>
	<meta property="fb:app_id" content="589392398495320"/>
	<meta name="twitter:image" content="https://paulowski.gq/imgs/paulowskige.png"/>
	<link rel="shortcut icon" type="image/png" href="https://paulowski.gq/imgs/paulowskige.png"/>
	<link rel="canonical" href="https://paulowski.gq/cadastro.php"/>
	<link rel="stylesheet" href="bootstrap.min.css"/>
	<script type="text/javascript" src="popper.min.js"></script>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</head>
<body class="bg-light">
	<div class="container-fluid ">
		<div class="container">
			<h1>Bem-vindo ao Gaebal Eventos</h1>
			<h6 class="text-secondary">Aqui você pode registrar eventos, participar de eventos e avaliá-los após o termino.<br/> Não tem conta ainda? Cadastre-se abaixo.</h6>
			<div class="row justify-content-end">
				<div class="col-lg-4">
					<h3>Cadastre!</h3>
					<form method="POST">
						Nome:<br/>
						<input type="text" name="nome"/><br/><br/>
						E-mail:<br/>
						<input type="email" name="email"/><br/><br/>
						Senha:<br/>
						<input type="password" name="senha"/><br/><br/>
						<button type="submit" class="btn btn-primary">Cadastrar-se</button><br/>
						Já tem conta?<a href="login.php" class="text-primary">Log In</a>!	
					</form>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-xs-12">
					<div class="card justify-content-center">
						<h5 class="card-header bg-secondary text-light">+ Informações</h5>
						<p class="card-text">[É uma versão de teste] Site feito especialmente para quem deseja publicar eventos gratuitamente. Nosso sistema é extremamente seguro. Quando uma pessoa se cadastra o número do ingresso é sempre diferente de ingressos anteriores, então, este é um número criptografado com informações do evento e do inscrito, tornando impossível alguém roubar o número de ingresso de outra pessoa. Não só isso, disponibilizamos para o usuário o download do QRCode correspondente ao seu ingresso. Ao chegar na porta do evento e verificar o QRCode, ele irá apontar quem foi a pessoa que o adquiriu, criando um sistema de difícil violação. Desenvolvimento 100% de Pedro Paulo, segue duas redes sociais: <a href="https://www.instagram.com/paulowski_official/" target="_blank" class="text-dark">Instagram </a>e<a href="https://www.linkedin.com/in/paulowski/" target="_blank"> LinkedIn</a>.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>