<?php

/* pra mexer no banco tem que colocar um dos códigos em comentario */


/* banco luiza */
$servername = "localhost"; //nome do servidor
$username = "root"; //nome d o usuario
//$password = "password"; //senha
$dbname = "meubanco";

<<<<<<< HEAD
$conn = mysqli_connect('localhost', 'root', '', 'meubanco') ;

=======

/* banco raissa */
$conn = mysqli_connect('localhost', 'root', '', 'flipifc') ;
>>>>>>> 0b1f174ce1ca5f4d1d4bca8d5b322d08d00b800f

if(mysqli_connect_errno()) {
    echo "Erro na conexão com o banco de dados";
    exit();
}

?>