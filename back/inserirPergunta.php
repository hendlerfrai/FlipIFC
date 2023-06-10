<?php

include('conexao.php');

$pontuacao = 0;
$acertos = 0;
$erros = 0;

if ($_POST['questao1'] == 'Paris') {
  $pontuacao += 10;
  $acertos += 1;
}
elseif {
  $erros += 1;
}


// Insere o resultado do quiz no banco de dados
$nome = $_POST['nome'];
$data_hora = date("Y-m-d H:i:s");

$stmt = $mysqli->prepare("INSERT INTO resultado (pontuacao, data_hora) VALUES ($pontuacao, $data_hora)");
$stmt->execute();
$stmt->close();
$sql = "UPDATE pontuacao SET acertos='$acertos', erros='$erros'";


// Exibe os resultados para o usuário
echo "Parabéns, $nome! Sua pontuação foi de $pontuacao pontos.";

?>