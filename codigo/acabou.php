<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/ppoProgresso.css">
    <title>FlipIFC</title>
</head>
<body>
<?php
include('conexao.php');
require('verifica.php');

if (!isset($_SESSION['codUser'])) {
    echo "erro"; 
    exit();
}

$escolhaAnterior = $_SESSION['escolhaAnterior'];

$mensagem = ""; 
if (isset($_SESSION['codUser'])) {
    $codUser = $_SESSION['codUser'];

    $dataAtual = date('Y-m-d'); 

    $sqlTentativas = "SELECT * FROM `resultado` WHERE codUser = $codUser AND DATE(data_hora) = '$dataAtual'";
    $rsTentativas = $conn->query($sqlTentativas);
    $numTentativas = $rsTentativas->num_rows;

    if ($numTentativas == 0) {
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
    } elseif ($numTentativas == 1) {
        $mensagem = "Deseja acessar o ranking?";
        $urlBotaoSim = "ranking.php"; 
    } 
} else {
    echo "erro";
    exit();
}
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
