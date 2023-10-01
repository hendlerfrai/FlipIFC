<?php
function getAlternativaCompleta($alternativa, $questao) {
    switch ($alternativa) {
        case 'A':
            return "A - " . $questao;
        case 'B':
            return "B - " . $questao;
        case 'C':
            return "C - " . $questao;
        case 'D':
            return "D - " . $questao;
        case 'E':
            return "E - " . $questao;
        default:
            return 'Alternativa inválida';
    }
}


include('conexao.php');
require('verifica.php');

$dataAtual = date("Y-m-d");
$data_hora = date("Y-m-d H:i:s");
$area = 1;
$erros = 0;


$codUser = $_SESSION['codUser'];

$query = "SELECT nomeAluno, codUser FROM cadastro WHERE codUser = '$codUser'";
$result = mysqli_query($conn, $query);
$aluno = mysqli_fetch_array($result);

$score = 0;
$acertos = 0;
$erros = 0;
$numTentativas = 0; // Defina o número de tentativas de acordo com a lógica do seu sistema

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pontuacao = $_POST['alternativa'];
    $idQ = $_POST['codQuestao'];

    $stmt = $conn->prepare("SELECT resposta, enunciado, altA, altB, altC, altD, altE FROM questao WHERE codQuestao = ?");
    $stmt->bind_param("s", $idQ);
    $stmt->execute();
    $stmt->bind_result($altCorreta, $enunciado, $altA, $altB, $altC, $altD, $altE);
    $stmt->fetch();
    $stmt->close();


    // Verifica se é a primeira ou segunda tentativa do dia
    $sqlTentativas = "SELECT * FROM `resultado` WHERE data_hora >= '$dataAtual' AND codUser = $codUser";
    $rsTentativas = $conn->query($sqlTentativas);
    $numTentativas = $rsTentativas->num_rows;

    if ($numTentativas == 1) {
        if ($pontuacao == $altCorreta) { // Acertou a primeira tentativa
            $primeiraTentativa = true;
        } else { // Errou a primeira tentativa
            $erros += 1;
        }
    } elseif ($numTentativas == 2) {
        if ($pontuacao == $altCorreta) { // Acertou a segunda tentativa
            $segundaTentativa = true;
        } else { // Errou a segunda tentativa
            $erros += 1;
        }
    } elseif ($numTentativas >= 3) {
        // Redireciona para a página de ranking ou encerra aqui, dependendo do que você deseja fazer
        header('Location: ranking.php');
        exit();
    }

    // Insere o resultado no banco de dados
    $resultado = $pontuacao == $altCorreta ? 1 : 0;
    $sqlInsert = "INSERT INTO resultado (codUser, codQuestao, resultado, data_hora, codArea) VALUES (?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("iissi", $codUser, $idQ, $resultado, $data_hora, $area);
    $stmtInsert->execute();
    $stmtInsert->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/resuCN.css">
    <title>Resultado</title>
</head>
<body>
    <div class="mensagem-container">
        <?php if ($numTentativas == 0) { ?>
            <!-- Primeira tentativa -->
            <?php if ($pontuacao == $altCorreta) { ?>

                <h1>Parabéns, você acertou! Pronto para a próxima questão?</h1>
                <button class="botao1-button" type="submit">
                    <span class="botaoproximo">  <a href="questaoCH.php">Próxima Questão</a> </span>
                 </button>
            <?php } else { ?>
                <h1 style= "padding: 20px; margin-top: 200px;">Você errou :( </h1>
                <h2 style= "padding: 10px;" >Você assinalou a alternativa: <?php echo getAlternativaCompleta($pontuacao, ${"alt" . $pontuacao}); ?></h2>
                <h2 style= "padding: 10px;"> A alternativa correta era: <?php echo getAlternativaCompleta($altCorreta, ${"alt" . $altCorreta}); ?></h2>
                <button class="botao1-button" type="submit">
                    <span class="botaoproximo"> <a href="questaoCH.php">Tentar Novamente</a></span>
                 </button>
        <?php } ?>
        <?php } elseif ($numTentativas == 1) { ?>
            <!-- Segunda tentativa -->
            <?php if ($pontuacao == $altCorreta) { ?>
                <h1 style= "padding: 20px; margin-top: 300px;" >Você acertou! Suas tentativas acabaram.</h1>
                <button class="botao1-button" type="submit">
                    <span class="botaoproximo" > <a href="ranking.php">Ver Ranking</a></span>
                 </button>
                 <button class="botao2-button" type="submit">
                    <a href="index.php">Logout</a>
                </button>
            <?php } else { ?>
               <h1 style= "padding: 20px; margin-top: 200px;"> Você errou :( </h1>
                <h2 style= "padding: 10px;">Você assinalou a alternativa: <?php echo getAlternativaCompleta($pontuacao, ${"alt" . $pontuacao}); ?></h2>
                <h2 style= "padding: 10px;"> A alternativa correta era: <?php echo getAlternativaCompleta($altCorreta, ${"alt" . $altCorreta}); ?></h2>
                <h3 style= "padding: 10px;"> Suas tentativas acabaram. </h3>
                <button class="botao1-button" type="submit">
                    <span class="botaoproximo"> <a href="ranking.php">Ver Ranking</a></span>
                 </button>
                 <button class="botao2-button" type="submit">
                    <a href="index.php">Logout</a>
                 </button>
            <?php } ?>
        <?php } else { ?>
            <p>Você atingiu o limite de tentativas para hoje. Aguarde até amanhã.</p>
        <?php } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        var botao1 = $('.botao1-button'); // Primeiro botão
        var botao2 = $('.botao2-button'); // Segundo botão

        var buttons = botao1.add(botao2); // Combina os botões em uma única seleção

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

            buttons.blur(); // Remove o foco de todos os botões
            buttons.eq(currentButtonIndex).focus(); // Aplica o foco ao botão atual
        });
    });
</script>

</body>
</html>





