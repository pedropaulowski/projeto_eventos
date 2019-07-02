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

if(isset($_GET['id_evento']) && !empty($_GET['id_evento']) && isset($_GET['id_criador']) && !empty($_GET['id_criador'])){
	$id = addslashes($_GET['id_evento']);
	$id_criador = addslashes($_GET['id_criador']);
	$id_evento = addslashes($_GET['id_evento']);
	$inscricoes->showCountInscricoes($id_evento);

	if($eventos->getEvento($id) == true){
		$eventos->getTituloById($id);
		$eventos->getCriadorByIdCriador($id_criador);
		$eventos->getDescricaoById($id);
		$eventos->getDataById($id);
		$eventos->getHoraById($id);
		$eventos->getEnderecoById($id);
		$inscricoes->showCountInscricoes($id_evento);

	} else{
		header("Location:ver-eventos.php");
	}
} else {
	header("Location:ver-eventos.php");
}

$id = $_SESSION['id'];
$usuarios = new Usuarios();
$usuarios->getNomeLogado($id);

?>
<a><?php echo $usuarios->getNomeLogado($id);?></a><br/>
<a>Título: <?php echo $eventos->getTituloById($id_evento);?></a><br/>
<a>Inscritos: <?php echo $inscricoes->showCountInscricoes($id_evento); ?></a><br/>
<a>Organizador: <?php echo $eventos->getCriadorByIdCriador($id_criador); ?></a><br/>
<a>Descrição do Evento: <?php echo $eventos->getDescricaoById($id_evento); ?></a><br/>
<a>Data: <?php echo $eventos->getDataById($id_evento); ?></a><br/>
<a>Hora: <?php echo $eventos->getHoraById($id_evento); ?></a><br/>
<a>Endereço: <?php echo $eventos->getEnderecoById($id_evento); ?></a><br/>

Gostou?<a href="inscrever.php?id_evento=<?php echo $_GET['id_evento'].'&id_criador='.$_GET['id_criador']; ?>">Inscreva-se agora!</a><br/>
<a href="sair.php">Sair</a>
<a href="voltar-index.php">Voltar</a>


