<?php
session_start();
if(!$_SESSION['cod']) {
	header('Location: index.php');
	exit();
}
?>