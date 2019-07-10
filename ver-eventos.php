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

<html>
<head>
	<meta charset="utf-8"/>
	<title>Ver ventos</title>
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
		<div class="col-xs-6">
			<button class="btn btn-dark"><a href="index.php" class="text-light">Página inicial</a></button>
			<button class="btn btn-dark"><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>" class="text-light"><?php echo $usuarios->getNomeLogado($id);?></a></button>
			<button class="btn btn-danger"><a href="sair.php" class="text-light">Sair</a></button>
		</div>
	</div>
	<div class="row justify-content-center bg-light">
		<div class="col-xs-6"><h2>Ver Eventos</h2></div>
	</div>
	<div class="container-fluid">
		<div class="row justify-content-around">
			<div class="col-xs-1">
				<form method="GET">
					<div class="form-group">
						<label>Procure pelo nome</label>
						<input type="text" name="titulo" class="form-control" <?php if(isset($_GET['titulo'])) echo 'value="'.$_GET['titulo'].'"'?>/>
						<label>Selectione a categoria</label>
						<select class="form-control" name="categoria">
							<option value="0" <?php if($_GET['categoria'] == "0" || empty($_GET['categoria'])) echo "selected";?>>Todos</option>
							<option value="1" <?php if($_GET['categoria'] == "1") echo "selected";?>>Festa</option>
							<option value="2" <?php if($_GET['categoria'] == "2") echo "selected";?>>Palestra</option>
							<option value="3" <?php if($_GET['categoria'] == "3") echo "selected";?>>Encontro de pessoas</option>
							<option value="4" <?php if($_GET['categoria'] == "4") echo "selected";?>>Evento Esportivo</option>
							<option value="5" <?php if($_GET['categoria'] == "5") echo "selected";?>>Evento de E-sports</option>
							<option value="6" <?php if($_GET['categoria'] == "6") echo "selected";?>>Evento Universitário</option>
						</select>

						<div class="mt-3 float-right">
						<button type="submit" class="btn btn-dark">Filtrar</button>
						</div>
					</div>
				</form>		
			</div>
			<div class="col-xs-11 mt-3 mr-3">
				<div class="row justify-content-center">
					<?php
					
    					if(isset($_GET['titulo']) && !empty($_GET['titulo']) && isset($_GET['categoria'])){
    						$titulo = addslashes($_GET['titulo']);
    						$categoria = addslashes($_GET['categoria']);
    						if($categoria == "0"){
    							$lista = $eventos->searchOnlyByTitulo($titulo);
    						} else {
    							$lista = $eventos->searchByTituloAndCategoria($titulo, $categoria);
    						}
    					} else {
    						$categoria = addslashes($_GET['categoria']);
    						if($categoria == "0"){
    							$lista = $eventos->getAllAbertos();
    						} else {
    							$lista = $eventos->getAllAbertosWithCategoria($categoria);
    						}
    					}

					foreach ($lista as $evento):
					?>
					<div class="col-xs-4">
						<div class="card" style="width: 18rem;">
							<div class="card-body text-center">
								<h3 class="card-title"><?php echo $evento['titulo'];?></h3>
								<p class="card-text"><?php echo $evento['descricao']; ?></p>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item">
								Inscritos: <?php $id_evento = $evento['id'];
								echo $inscricoes->showCountInscricoes($id_evento); ?></li>
								<li class="list-group-item">Organizador: <?php $id_criador = $evento['id_criador'];echo $eventos->getCriadorByIdCriador($id_criador); ?></li>
								<li class="list-group-item">Endereço: <?php echo $evento['endereco']; ?></li>
								<li class="list-group-item">Categoria: <?php echo $evento['categoria']; ?></li>
							</ul>
							<div class="card-body text-center">
								<button class="btn btn-danger"><a href="inscrever.php?id_evento=<?php echo $evento['id'].'&id_criador='.$evento['id_criador']; ?>" class="text-light">Inscrever</a></button>
								<button class="btn btn-success"><a href="ver-evento.php?id_evento=<?php echo $evento['id'].'&'."id_criador=".$evento['id_criador']; ?>" class="text-light">+INFO</a></button>
							</div>
						</div>
					</div>
					<?php endforeach;?>
				</div>
			</div>

		</div>
	</div>

</div>
</body>
</html>
