<?php
session_start();
require 'usuarios.class.php';
require 'eventos.class.php';
require 'inscricoes.class.php';

if(empty($_SESSION['id'])) {
	header("Location:login.php");
}

$eventos = new Eventos();
$inscricoes = new Inscricoes;
?>
<a href="sair.php">Sair</a>
<a href="voltar-index.php">Voltar</a>
<table border="1" width="100%">
	<tr>
		<th>Titulo</th>
		<th>Data (Ano-Mês-Dia)</th>
		<th>Horário</th>
		<th>Inscritos</th>
		<th>Ações</th>		
	</tr>
	<?php
	if(isset($_GET['id_criador']) && !empty($_GET['id_criador'])) {
	$id_criador = addslashes($_GET['id_criador']);
	$lista = $eventos->getEventosByIdCriador($id_criador);

	if($eventos->getEventosByIdCriador($id_criador) == false){
		header("Location:index.php");
	} else {
	foreach ($lista as $evento):
	?>
	<tr>
		<td><?php echo $evento['titulo']; ?></td>
		<td><?php echo $evento['data']; ?></td>
		<td><?php echo $evento['hora']; ?></td>
		<td><?php $id_evento = $evento['id'];
		echo $inscricoes->showCountInscricoes($id_evento); ?></td>
		<td><a style ="color:red;" href="inscrever.php?id_evento=<?php echo $evento['id'].'&'."id_criador=".$evento['id_criador']; ?>">Inscrever-se  </a><a style ="color:green;" href="ver-evento.php?id_evento=<?php echo $evento['id'].'&'."id_criador=".$evento['id_criador']; ?>">  + INFO</a></td>						
	</tr>
	<?php endforeach;
	}
	}
	?>
</table>