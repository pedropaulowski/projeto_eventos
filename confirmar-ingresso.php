<?php
session_start();
require 'eventos.class.php';
require 'usuarios.class.php';
require 'inscricoes.class.php';

$inscricoes = new Inscricoes();
$eventos = new Eventos(); 
$usuarios = new Usuarios();

?>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Confirmação do ingresso</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="bootstrap.min.css"/>
	<script type="text/javascript" src="popper.min.js"></script>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
</head>
<body class="bg-light">
<div class="container-fluid">
		<div class="row bg-primary justify-content-between">
			<div class="col-xs-3">
				<h1 class="text-light">Gaebal Eventos</h1>
			</div>
		</div>
		<div class="row justify-content-center bg-light">
			<div class="col-xs-6"><h2>Verificação do Ingresso</h2></div>
		</div>
<?php if(isset($_GET['ingresso']) && !empty($_GET['ingresso'])) {
	$ingresso = addslashes($_GET['ingresso']);

	if($inscricoes->verificarIngresso($ingresso) == true) {		
		echo "<div class='row justify-content-center>";
		echo "<div class='col-xs-4'>";
		echo "<div class='card' style='width: 18rem;'>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>".$eventos->getEventoByIngresso($ingresso)."</a></h5>";
		echo "<p class='card-text'>Ingresso adquirido por: ".$usuarios->getUsuarioByIngresso($ingresso)."</p>";
		echo "<p class='card-text'>Número do ingresso: ".$ingresso."</p>";
		echo "</div>";
		echo"</div>";
		echo "</div>";
		echo "</div>";
	} else {
		echo "<h2>Ingresso não existe ou já foi usado!<h2/>";
	}
} else {
	echo "<h2>Ingresso não existe!<h2/>";
}
?>
</div>
</body>
</html>