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
			echo "Senha incorreta!";
		} else {
			header("Location:index.php");
		}
		
	} else {
		header("Location:cadastro.php");
	}
}

?>
<form method="POST">
	E-mail:<br/>
	<input type="email" name="email"/><br/><br/>
	Senha:<br/>
	<input type="password" name="senha"/><br/><br/>
	<input type="submit" value="Login"/>
	<a href="cadastro.php">Cadastrar-se</a>
</form>