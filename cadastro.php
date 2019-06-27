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
<form method="POST">
	Nome:<br/>
	<input type="text" name="nome"/><br/><br/>
	E-mail:<br/>
	<input type="email" name="email"/><br/><br/>
	Senha:<br/>
	<input type="password" name="senha"/><br/><br/>
	<input type="submit" name="Cadastrar-se"/>
	Já tem conta?<a href="login.php">Log In</a>!	
</form>
