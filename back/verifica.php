<?php

$codUser = $_SESSION['codUser'];

if (!isset($_SESSION['codUser']) == true) {
    unset($_SESSION['codUser']);
    header("Location: login.php");
    exit();
}
?>