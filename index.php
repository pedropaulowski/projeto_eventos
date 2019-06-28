<?php
session_start();
require 'usuarios.class.php';
$usuarios = new Usuarios();

if(empty($_SESSION['id'])) {
	header("Location:login.php");
}
$id = $_SESSION['id'];

$usuarios->getNomeLogado($id);
?>
<a href="perfil.php?id=<?php echo $_SESSION['id']; ?>"><?php echo $usuarios->getNomeLogado($id);?></a><br/>
<a href="sair.php">Sair</a>
<a href="eventos-criados.php?id_criador=<?php echo $id; ?>">Eventos Criados</a>
<a href="criar-evento.php">Criar Evento</a>
<a href="ver-eventos.php">Ver Eventos</a>
