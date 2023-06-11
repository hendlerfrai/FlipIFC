<?php
require 'verifica.php';

if (isset($_SESSION['codUser'])) {
    $codUser = $_SESSION['codUser'];
} else {
    header("Location: login.php");
    exit();
}
?>