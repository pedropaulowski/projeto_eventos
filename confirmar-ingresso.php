<?php
session_start();
require 'eventos.class.php';
require 'usuarios.class.php';
require 'inscricoes.class.php';

$inscricoes = new Inscricoes();
$eventos = new Eventos(); 
$usuarios = new Usuarios();
if(isset($_GET['ingresso']) && !empty($_GET['ingresso'])) {
	$ingresso = addslashes($_GET['ingresso']);

	if($inscricoes->verificarIngresso($ingresso) == true) {		
		echo "Ingresso para ".$usuarios->getUsuarioByIngresso($ingresso)." em ".$eventos->getEventoByIngresso($ingresso);
	} else {
		echo "<h3>Ingresso não existe ou já foi usado!<h3/>";
	}
} else {
	echo "<h3>Ingresso não existe!<h3/>";
}

?>