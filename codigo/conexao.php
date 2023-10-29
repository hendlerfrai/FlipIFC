
<?php

$conn = mysqli_connect('monorail.proxy.rlwy.net:28359', 'root', '6dd31gEeBdHE1adBEAg2gC34aFB51E6A', 'railway');
if(mysqli_connect_errno()) {
    echo "Erro na conexão com o banco de dados";
    exit();
}

?>
