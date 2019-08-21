<?php
session_start();
require 'eventos.class.php';
require 'usuarios.class.php';
require 'inscricoes.class.php';

$eventos = new Eventos();
$inscricoes = new Inscricoes();
$usuarios = new Usuarios();



if(empty($_SESSION['id'])) {
	header("Location:login.php");
}
if(isset($_GET['id_evento']) && !empty($_GET['id_evento']) && isset($_GET['id_criador']) && !empty($_GET['id_criador'])) {
	$id = addslashes($_GET['id_evento']);
	$id_criador = addslashes($_GET['id_criador']);

	if($eventos->existeEvento($id) == true){
		$id_evento = addslashes($_GET['id_evento']);
		$id_usuario = addslashes($_SESSION['id']);
		$nome_usuario = $usuarios->getUsuariosById($id_usuario);
		$nome_evento = $eventos->getTituloById($id);
		$ingresso = md5(md5($id_evento.md5(rand(0, 10000))).$id_usuario.md5($nome_usuario));
		//$inscricoes->inscrever($id_evento, $id_usuario, $nome_usuario, $nome_evento, $ingresso);

		if($inscricoes->inscrever($id_evento, $id_usuario, $nome_usuario, $nome_evento, $ingresso) == true) {
			header("Location:ver-eventos.php?titulo=&categoria=0");
		} else {
			header("Location:ver-eventos.php?titulo=&categoria=0");
		}
	} else {
		header("Location:index.php");
	}
}
?>
