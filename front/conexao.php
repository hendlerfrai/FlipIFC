<?php

/* pra mexer no banco tem que colocar um dos códigos em comentario */


/* banco luiza */
$servername = "localhost"; //nome do servidor
$username = "root"; //nome d o usuario
//$password = "password"; //senha
$dbname = "meubanco";

$conn = mysqli_connect('localhost', 'root', '', 'meubanco') ;


if(mysqli_connect_errno()) {
    echo "Erro na conexão com o banco de dados";
    exit();
}

?>