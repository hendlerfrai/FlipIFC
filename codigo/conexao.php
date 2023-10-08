<?php

$conn = mysqli_connect('containers-us-west-138.railway.app:6754', 'root', 'OdBCJDun2iBpeeZtWdoq', 'railway');
if(mysqli_connect_errno()) {
    echo "Erro na conexão com o banco de dados";
    exit();
}

?> 