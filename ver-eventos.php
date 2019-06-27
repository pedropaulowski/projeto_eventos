<?php
session_start();
require 'eventos.class.php';
require 'usuarios.class.php';
require 'inscricoes.class.php';

if(empty($_SESSION['id'])) {
	header("Location:login.php");
}

$eventos = new Eventos();
$inscricoes = new Inscricoes();

$id = $_SESSION['id'];
$usuarios = new Usuarios();
$usuarios->getNomeLogado($id);
?>
<a><?php echo $usuarios->getNomeLogado($id);?></a><br/>
<a href="sair.php">Sair</a>
<a href="index.php">Voltar</a>
<table border="1" width="100%">
	<tr>
		<th>Titulo</th>
		<th>Data (Ano-Mês-Dia)</th>
		<th>Horário</th>
		<th>Inscritos</th>
		<th>Ações</th>		
	</tr>
	<?php
	$lista = $eventos->getAllAbertos();
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
	<?php endforeach;?>
</table>