<?php
session_start();
require 'usuarios.class.php';
require 'inscricoes.class.php';
require 'eventos.class.php';

$usuarios = new Usuarios();
$eventos = new Eventos();
$inscricoes = new Inscricoes();

if(empty($_SESSION['id'])) {
	header("Location:login.php");
}

if(isset($_GET['id']) && !empty($_GET['id']) && $_SESSION['id'] == $_GET['id']) {
	$id = addslashes($_GET['id']);
	$id_usuario = addslashes($_GET['id']);
	$usuarios->getNomeLogado($id);
	$eventos->getEventosByIdUsuario($id_usuario);
} else {
	header("Location:index.php");
}
?>
<center>
<a>Nome: <b><?php echo $usuarios->getNomeLogado($id); ?></b></a><br/>

<a>Email: <b><?php echo $usuarios->getEmailById($id); ?></b></a>
<h4>Eventos Inscritos</h4>

	<table border="1" width="60%">
		<tr>
			<th>Evento</th>
			<th>Ingresso</th>	
		</tr>
		<?php
		if($eventos->getEventosByIdUsuario($id_usuario) != false){
		$lista = $eventos->getEventosByIdUsuario($id_usuario);
		foreach ($lista as $evento):
		?>
		<tr>
			<td><?php echo $evento['nome_evento']; ?></td>
			<td><a href="ingresso.php?ingresso=<?php echo $evento['ingresso']; ?>">Ver ingresso</a></td>	
		</tr>
		<?php endforeach;}?>
	</table>
	<a href="sair.php">Sair</a>
	<a href="voltar-index.php">Pagina Inicial</a>

</center>