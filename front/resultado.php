<?php
session_start();

$acertos = isset($_SESSION['acertos']) ? $_SESSION['acertos'] : 0;
$erros = isset($_SESSION['erros']) ? $_SESSION['erros'] : 0;

if ($acertos == 1) {
    $mensagem = "Parabéns! Você acertou! Pronto para a próxima pergunta?";
    $botao = '<a href="questaoCN.php" class="btn-next">Próxima Pergunta</a>';
} elseif ($acertos == 2) {
    $mensagem = "Parabéns! Você acertou! Suas tentativas diárias terminaram. Deseja acessar o ranking? Até amanhã!";
    $botao = '<a href="ranking.php" class="btn-next">Acessar Ranking</a>';
} elseif ($erros == 1 ) {
    $altCorretaCompleta = isset($_SESSION['altCorretaCompleta']) ? $_SESSION['altCorretaCompleta'] : "alternativa desconhecida";
    $mensagem = "Você errou :( A resposta correta era: " . $altCorretaCompleta; 
    $botao = '<a href="questaoCN.php" class="btn-next">Próxima Pergunta</a>';
}
elseif ($erros == 2) {
    $altCorretaCompleta = isset($_SESSION['altCorretaCompleta']) ? $_SESSION['altCorretaCompleta'] : "alternativa desconhecida";
    $mensagem = "Você errou :( A resposta correta era: " . $altCorretaCompleta . ".Suas tentativas diárias terminaram, descanse e tente novamente amanhã ;) Deseja acessar o ranking? ";
    $botao = '<a href="ranking.php" class="btn-next">Acessar Ranking</a>';
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Seus metadados, estilos e scripts -->
    <title>Resultado</title>
</head>
<body>
    <div class="mensagem-container">
        <h2><?php echo $mensagem; ?></h2>
       <div> <?php echo $botao; ?> </div>
    </div>
</body>
</html>
