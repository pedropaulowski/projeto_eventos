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

if(isset($_GET['ingresso']) && !empty($_GET['ingresso'])) {
	$ingresso = addslashes($_GET['ingresso']);
	if($inscricoes->verificarIngresso($ingresso) == false) {
		header("Location:index.php");
	} else {
		$usuarios->getUsuarioByIngresso($ingresso);
	}
}
$ingresso = addslashes($_GET['ingresso']);
?>
<?php
	$aux = 'qr_img0.50j/php/qr_img.php?';
	$aux .= 'd=https://paulowski.gq/confirmar-ingresso.php?ingresso='.$ingresso.'&';
	$aux .= 'e=H&';
	$aux .= 's=4&';
	$aux .= 't=P';
?>
<center>
	<div style="max-width:460px;margin: auto; text-align: left;">
		<div style="float:left;">
			<a>Nome: <?php echo $usuarios->getUsuarioByIngresso($ingresso); ?></a><br/>
		<a>Evento: <b><?php echo $eventos->getEventoByIngresso($ingresso); ?></b></a><br/>
		<a href="<?php echo 'https://paulowski.gq/qr_img0.50j/php/qr_img.php?d=https://paulowski.gq/confirmar-ingresso.php?ingresso='.$ingresso.'&e=H&s=4&t=P'; ?>" download >Baixar QRCode (Ingresso)</a>
		<h6>Apresentar QRCode na entrada do evento</h6>
		</div>
		<div style="float: right;border: 1px solid black;">
			<img src="<?php echo $aux; ?>"/>
		</div>
	</div>
	<br/>
	<br/>


</center>
