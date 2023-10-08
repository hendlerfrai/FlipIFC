<?php
session_start();
include('conexao.php');

$valor1 = $_POST['valor1'];
$valor2 = $_POST['valor2'];
$valor3 = $_POST['valor3'];
$valor4 = $_POST['valor4'];
$valor5 = $_POST['valor5'];

// Verificar se todos os campos do código de acesso estão preenchidos
if (!empty($valor1) && !empty($valor2) && !empty($valor3) && !empty($valor4) && !empty($valor5)) {
    $cod = $valor1 . $valor2 . $valor3 . $valor4 . $valor5;

    $sql = "SELECT * FROM cadastro WHERE codAcesso = '$cod'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $linha = mysqli_fetch_array($result);
        $_SESSION['codUser'] = $linha['codUser'];
        header("Location: areas.php");
        exit();
    } else {
        $_SESSION['mensagemErro'] = "Usuário não encontrado. Tente novamente.";
        header("Location: telaloginUsuario.php");
        exit();
    }
} else {
    $_SESSION['mensagemErro'] = "Por favor, preencha todos os campos do código de acesso.";
    header("Location: telaloginUsuario.php");
    exit();
}
?>