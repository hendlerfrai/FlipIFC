<?php

$servername = "localhost"; //nome do servidor
$username = "root"; //nome d o usuario
//$password = "password"; //senha
$dbname = "meubanco";





$conn = mysqli_connect($servername, $username, '', $dbname);


if(mysqli_connect_errno()) {
    echo "Erro na conexão com o banco de dados";
    exit();
}
?>  