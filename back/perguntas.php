<?php
include('conexao.php');


$pontuacao = 0;

if ($_POST['questao1'] == 'Paris') {
  $pontuacao += 10;
}


// Insere o resultado do quiz no banco de dados
$nome = $_POST['nome'];
$data_hora = date("Y-m-d H:i:s");

$stmt = $mysqli->prepare("INSERT INTO pontuacao (codUser, pontuacao, data_hora) VALUES ($nome, $pontuacao, $data_hora)");
$stmt->execute();
$stmt->close();

// Exibe os resultados para o usuário
echo "Parabéns, $nome! Sua pontuação foi de $pontuacao pontos.";
?>