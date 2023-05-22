<?php
include('conexao.php');

$cod = $_POST['cod'];

$sql = "SELECT * FROM cadastro WHERE codAcesso ='$cod'";
$result = $conn->query($sql);
if ($result ->num_rows > 0) {
   header("Location: index.php");
        exit();

} else {
   echo '<script type="text/javascript">';
   echo 'alert("Usuário não encontrado. Tente novamente");';
   echo 'window.location.href = "login.php";';
   echo '</script>';

}
?>