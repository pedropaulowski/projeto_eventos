<?php
session_start();
require 'usuarios.class.php';

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
	header("Location:index.php");
}

if(isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);

	$usuarios = new Usuarios();
	$usuarios->existeEmail($email);

	if($usuarios->existeEmail($email) == true) {
		$usuarios->logIn($email, $senha);

		if($usuarios->logIn($email, $senha) == false){
			echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
  <strong>OH NÃO!</strong> Senha incorreta!.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
		} else {
			header("Location:index.php");

		}
		
	} else {
		header("Location:cadastro.php");
	}
}

?>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="bootstrap.min.css"/>
	<script type="text/javascript" src="popper.min.js"></script>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</head>
<body class="bg-light">
	<div class="container-fluid ">
		<div class="container">
			<h1>Bem-vindo ao Gaebal Eventos</h1>
			<h6 class="text-secondary">Aqui você pode registrar eventos, participar de eventos e avaliá-los após o termino.<br/> Não tem conta ainda?<a href="cadastro.php"> Cadastre-se</a>!</h6>
			<div class="row justify-content-center">
				<div class="col-xs-4">
					<h3>Entre agora!</h3>
					<form method="POST">
						E-mail:<br/>
						<input type="email" name="email"/><br/><br/>
						Senha:<br/>
						<input type="password" name="senha"/><br/><br/>
						<button type="submit" class="btn btn-primary">Login</button>
					</form>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-xs-12">
					<div class="card justify-content-center">
						<h5 class="card-header bg-secondary text-light">+ Informações</h5>
						<p class="card-text">Site feito especialmente para quem deseja publicar eventos gratuitamente. Nosso sistema é extremamente seguro. Quando uma pessoa se cadastra o número do ingresso é sempre diferente de ingressos anteriores, então, este é um número criptografado com informações do evento e do inscrito, tornando impossível alguém acertar o número de ingresso de outra pessoa. Não só isso, disponibilizamos para o usuário o download do QRCode correspondente ao seu ingresso. Ao chegar na porta do evento e verificar o QRCode, ele irá apontar quem foi a pessoa que o adquiriu, criando um sistema de difícil violação.</p>
						<a href="cadastro.php" class="btn btn-primary" style="width: 14rem;margin:auto;">Cadastre-se agora!</a> 
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>