<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/ppoProgresso.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>FlipIFC</title>
</head>
<body>
<?php

include('conexao.php');
require('verifica.php');

if (!isset($_SESSION['codUser'])) {
    echo "Erro: Sessão não iniciada.";
    exit();
}

$escolhaAnterior = $_SESSION['escolhaAnterior'];
$codUser = $_SESSION['codUser'];

$aparicao = 0;
$dataAtual = date('Y-m-d'); 

// Verifique se já existe um registro na tabela 'acabou' para o usuário e data atual
$sqlAparicao = "SELECT * FROM `acabou` WHERE codUser = $codUser AND DATE(data_hora) = '$dataAtual'";
$rsAparicao = $conn->query($sqlAparicao);
$aparicao = $rsAparicao->num_rows;

// Verifique se já existe um registro na tabela 'resultado' para o usuário e data atual
$sqlTentativas = "SELECT * FROM `resultado` WHERE codUser = $codUser AND DATE(data_hora) = '$dataAtual'";
$rsTentativas = $conn->query($sqlTentativas);
$numTentativas = $rsTentativas->num_rows;

$mensagem = "";

if ($numTentativas == 0 && $aparicao == 0) {
    $mensagem = "Deseja ir para a próxima questão?"; 
    switch ($escolhaAnterior) {
        case "questaoCN":
            $urlBotaoSim = "questaoCN.php"; 
            break;
        case "questaoLP":
            $urlBotaoSim = "questaoLP.php"; 
            break;
        case "questaoM":
            $urlBotaoSim = "questaoM.php"; 
            break;
        case "questaoCH":
            $urlBotaoSim = "questaoCH.php"; 
            break;
        default:
            $urlBotaoSim = "questaoCH.php"; 
            break;
    }
} else {
    $mensagem = "Deseja acessar o ranking?";
    $urlBotaoSim = "ranking.php"; // Defina a URL apropriada aqui
}

$aparicao += 1; // Incrementa a aparição em 1

// Insere a nova aparição na tabela 'acabou'
$sqlInserirAparicao = "INSERT INTO `acabou` (codUser, data_hora, aparicao) VALUES ('$codUser', NOW(), $aparicao)";
$conn->query($sqlInserirAparicao);

// Conta o número real de aparições na tabela 'acabou'
$sqlContagem = "SELECT COUNT(*) FROM `acabou` WHERE codUser = $codUser";
$resultContagem = $conn->query($sqlContagem);
$row = $resultContagem->fetch_row();
$numAparicoes = $row[0];

echo $numAparicoes;
?>
<div>
    <h1 id="titulo">
        O tempo acabou :(
        <br><?php echo $mensagem; ?>
    </h1>
</div>
<div>
    <button class="botao1">
        <span class="botaovoltar"><a href="index.php" target="_self" style="text-decoration: none; color: #aa422f;">Logout</a></span>
    </button>
    <button class="botao2">
        <span class="botasim"><a href="<?php echo $urlBotaoSim; ?>" target="_self" style="text-decoration: none; color: #aa422f;">Sim</a></span>
    </button>
</div>

<script>
    $(document).ready(function() {
        var botao1 = $('.botao1');
        var botao2 = $('.botao2');
        var buttons = botao1.add(botao2);
        var currentButtonIndex = 0;

        buttons.eq(currentButtonIndex).focus();

        $(document).keydown(function(event) {
            var tecla = event.keyCode;

            if (tecla == 13) { // Tecla Enter
                var targetUrl = buttons.eq(currentButtonIndex).find('a').attr('href');
                window.location.href = targetUrl;
            } else if (tecla == 37) {
                currentButtonIndex = (currentButtonIndex + 1) % buttons.length;
            } else if (tecla == 39) {
                currentButtonIndex = (currentButtonIndex - 1 + buttons.length) % buttons.length;
            }

            buttons.blur();
            buttons.eq(currentButtonIndex).focus();
        });
    });
</script>
</body>
</html>