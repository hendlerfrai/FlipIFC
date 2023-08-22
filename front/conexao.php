<?php
/*
$servername = "localhost"; //nome do servidor
$username = "root"; //nome d o usuario
//$password = "password"; //senha
$dbname = "meubanco";
*/

/* banco raissa */
$conn = mysqli_connect('localhost' /*nome do servidor*/, 'root' /*nome d o usuario*/, '' /* senha */, 'flipifc' /*nome do banco */) ;

if(mysqli_connect_errno()) {
    echo "Erro na conexão com o banco de dados";
    exit();
}

?>
