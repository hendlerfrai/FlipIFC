<?php
include('conexao.php');
require('verifica.php');

$dataAtual = date("Y-m-d");
$data_hora = date("Y-m-d H:i:s");

$acertos = isset($_SESSION['acertos']) ? $_SESSION['acertos'] : 0;
$erros = isset($_SESSION['erros']) ? $_SESSION['erros'] : 0;

$sql1 = "SELECT * FROM `resultado` WHERE data_hora='$dataAtual' AND codUser=$codUser";
$rs1 = $conn->query($sql1);

$mensagem = "";
$botao = "";

if ($acertos == $rs1->num_rows <= 1) {
    $mensagem = "Parabéns! Você acertou! Pronto para a próxima pergunta?";
    $botao = '<a href="questaoCN.php" class="btn-next">Próxima Pergunta</a>';
    echo 'teste';
} elseif ($acertos >= 2) {
    $mensagem = "Parabéns! Você acertou!";
    $mensagem2 = "Suas tentativas diárias terminaram. Deseja acessar o ranking? Até amanhã!";
    $botao = '<a href="ranking.php" class="btn-next">Acessar Ranking</a>';
    echo 'teste';
} elseif ($erros == $rs1->num_rows <= 1) {
    $altCorretaCompleta = isset($_SESSION['altCorretaCompleta']) ? $_SESSION['altCorretaCompleta'] : "alternativa desconhecida";
    $mensagem = "Você errou :( A resposta correta era: " . $altCorretaCompleta;
    $botao = '<a href="questaoCN.php" class="btn-next">Próxima Pergunta</a>';
    echo 'teste';
} elseif ($erros >= 2) {
    $altCorretaCompleta = isset($_SESSION['altCorretaCompleta']) ? $_SESSION['altCorretaCompleta'] : "alternativa desconhecida";
    $mensagem = "Você errou :( A resposta correta era: " . $altCorretaCompleta . ". Suas tentativas diárias terminaram, descanse e tente novamente amanhã ;) Deseja acessar o ranking?";
    $botao = '<a href="ranking.php" class="btn-next">Acessar Ranking</a>';
}

//problemas no $rs1->num_rows
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <title>Resultado</title>
</head>
<body>
    <div class="mensagem-container">
        <h2><?php echo $mensagem; ?></h2>
        <h3><?php echo $mensagem2?></h3>
        <button><?php echo $botao; ?></button>
        <button>
          <a href="index.php" target="_self"> Voltar a tela e início </a> 
        </button>
    </div>
</body>
</html>
