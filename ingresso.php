<?php
session_start();
require 'usuarios.class.php';
require 'inscricoes.class.php';
require 'eventos.class.php';

$usuarios = new Usuarios();
$eventos = new Eventos();
$inscricoes = new Inscricoes();

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
	$aux .= 'd='.$ingresso.'&';
	$aux .= 'e=H&';
	$aux .= 's=5&';
	$aux .= 't=P';
?>
<center>
	<div style="max-width:460px;margin: auto; text-align: left;">
		<div style="float:left;">
			<a>Nome: <?php echo $usuarios->getUsuarioByIngresso($ingresso); ?></a><br/>
		<a>Evento: <b><?php echo $eventos->getEventoByIngresso($ingresso); ?></b></a><br/>
		</div>
		<div style="float: right;border: 1px solid black;">
			<img src="<?php echo $aux; ?>"/>
		</div>
	</div>
</center>