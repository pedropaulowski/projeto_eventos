<?php
session_start();
require 'usuarios.class.php';
require 'curtidas.class.php';

if(empty($_SESSION['id'])) {
	header("location:login.php");
}

$usuarios = new Usuarios();
$curtidas = new Curtidas();

$id_usuario = $_SESSION['id'];


if(isset($_GET['id']) && !empty($_GET['id'])) {
	$nome_usuario = $usuarios->getNomeLogado($id_usuario);
	$curtidas->curtir($id_usuario, $nome_usuario);

	header("Location:index.php");

} else {
	header("Location:index.php");
}

?>