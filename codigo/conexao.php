<?php

$conn = mysqli_connect('localhost', 'root', '', 'flipifc') ; 

if(mysqli_connect_errno()) {
    echo "Erro na conexão com o banco de dados";
    exit();
}

?>
