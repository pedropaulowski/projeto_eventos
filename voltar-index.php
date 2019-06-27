<?php
session_start();
require 'usuarios.class.php';
require 'eventos.class.php';
require 'inscricoes.class.php';

if(empty($_SESSION['id'])) {
	header("Location:login.php");
} else {
	header("Location:index.php");
}

header("Location:index.php");
?>