<?php
session_start();
include('conexao.php');

$cod = $_POST['valor1'].$_POST['valor2'].$_POST['valor3'].$_POST['valor4'].$_POST['valor5'];

$sql = "SELECT * FROM cadastro WHERE codAcesso ='$cod'";
$result = $conn->query($sql);
if ($result ->num_rows > 0) {
   $linha = mysqli_fetch_array($result);
   $_SESSION['codUser'] = $linha['codUser'];

   header("Location: areas.php");
        exit();

} else {
   unset($_SESSION['codUser']);
   echo '<script type="text/javascript">';
   echo 'alert("Usuário não encontrado. Tente novamente");';
   echo 'window.location.href = "telaloginUsuario.php";';
   echo '</script>';

}
?>    