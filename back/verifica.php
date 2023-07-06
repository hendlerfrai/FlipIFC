<?php
session_start();

include('conexao.php');

$codUser = $_SESSION['codUser'];

$sql = "SELECT * FROM cadastro WHERE codAcesso ='$codUser'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

} else {
    unset($_SESSION['codUser']);
    echo '<script type="text/javascript">';
    echo 'alert("Usuário não encontrado. Tente novamente");';
    echo 'window.location.href = "login.php";';
    echo '</script>';
}

?>
