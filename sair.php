<?php
session_start();
require 'usuarios.class.php';

unset($_SESSION['id']);

if(empty($_SESSION['id']) && !isset($_SESSION['id'])) {
	header("Location:login.php");
}
?>