<?php
session_start();
require 'usuarios.class.php';
require 'curtidas.class.php';

$usuarios = new Usuarios();
$curtidas = new Curtidas();

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
<a href="ver-eventos.php">Ver Eventos</a><br/><br/>
Gostou do sistema?  <a href="curtir-app.php?id=<?php echo $id; ?>">Curtir</a><?php echo "  ".$curtidas->showCountCurtidas()." pessoas curtiram!";?> 
