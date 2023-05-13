<?php
include('conexao.php');

$cod = $_POST['cod'];

$sql = "SELECT * FROM cadastro WHERE codAcesso ='$cod'";
$result = $conn->query($sql);
if ($result ->num_rows > 0) {
echo "usuário logado";
} else {
   echo "usuário não encontrado";
}
?>