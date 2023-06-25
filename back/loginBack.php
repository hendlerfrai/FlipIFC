<?php
session_start();
include('conexao.php');

$cod = $_POST['cod'];

$sql = "SELECT * FROM cadastro WHERE codAcesso ='$cod'";
$result = $conn->query($sql);
if ($result ->num_rows > 0) {
   $_SESSION['codUser'] = $cod;
   header("Location: questao.php");
   exit();

} else {
   unset($_SESSION['codUser']);
   echo '<script type="text/javascript">';
   echo 'alert("Usuário não encontrado. Tente novamente");';
   echo 'window.location.href = "login.php";';
   echo '</script>';

}
?>
