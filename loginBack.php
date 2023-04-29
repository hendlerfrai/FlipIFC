<?php
session_start();
include('conexao.php');
 
if(empty($_POST['cod'])) {
	header('Location: index.php');
	exit();
}
 
$cod = mysqli_real_escape_string($conn, $_POST['cod']);
 
$query = "SELECT * FROM `cadastro` WHERE codAcesso  = '{$cod}' )";
 
$result = mysqli_query($conn, $query);
 
$row = mysqli_num_rows($result);
 
if($row == 1) {
	$_SESSION['cod'] = $cod;
	header('Location: painel.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}











/*
include('conn.php');

// Verifica se houve um envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtém o código digitado pelo usuário
  $cod = $_POST["cod"];

  // Consulta o banco de dados para verificar se o código existe
  $sql = "SELECT * FROM cadastro WHERE codAcesso = $cod and nomeAluno = $nome";
  $result = mysqli_query($conn, $sql);

  // Verifica se o resultado da consulta não é vazio
  if (mysqli_num_rows($result) > 0) {
    // Obtém o nome da pessoa correspondente ao código
    $row = mysqli_fetch_assoc($result);
    $nome = $row["nome"];

    // Exibe a mensagem de boas-vindas com o nome da pessoa
    echo "Bem-vindo, $nome!";
  } else {
    // Exibe a mensagem de código não cadastrado
    echo "Código não cadastrado.";
  }
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
*/
?>
