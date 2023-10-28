<?php

$conn = mysqli_connect('', 'root', '', 'railway');
if(mysqli_connect_errno()) {
    echo "Erro na conexão com o banco de dados";
    exit();
}

?> 
