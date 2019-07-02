<?php
session_start();
require 'eventos.class.php';
require 'inscricoes.class.php';
require 'usuarios.class.php';

if(!isset($_SESSION['id']) && empty($_SESSION['id'])) {
	header("Location:login.php");
}

if(isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['data']) && isset($_POST['hora']) && isset($_POST['endereco']) && !empty($_POST['titulo']) && !empty($_POST['descricao']) && !empty($_POST['data']) && !empty($_POST['hora']) && !empty($_POST['endereco'])){
	$id_criador = $_SESSION['id'];
	$titulo = addslashes($_POST['titulo']);
	$descricao = addslashes($_POST['descricao']);
	$data = addslashes($_POST['data']);
	$hora = addslashes($_POST['hora']);
	$endereco = addslashes($_POST['endereco']);

	$eventos = new Eventos();
	$eventos->setEvento($id_criador, $nome_criador, $titulo, $descricao, $data, $hora, $endereco, $status);

	header("Location:index.php");
}
?>
<form method="POST"/>
	Título:<br/>
	<input type="text" name="titulo"/><br/><br/>
	Descrição:<br/>
	<input type="text" name="descricao"/><br/><br/>
	Data:<br/>
	<input type="date" name="data"/><br/><br/>
	Hora:<br/>
	<input type="time" name="hora"/><br/><br/>
	Endereço:<br/>
	<input type="text" name="endereco"/><br/><br/>
	<input type="submit" value="Criar Evento"/>
</form>