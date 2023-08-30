<?php
include('conexao.php');
require('verifica.php');

$dataAtual = date("Y-m-d");
$data_hora = date("Y-m-d H:i:s");
$area = 2;

$sql = "SELECT * FROM questao WHERE codArea = 1 ORDER BY RAND() LIMIT 1";
$rs = mysqli_query($conn, $sql);
$rt = mysqli_fetch_assoc($rs);

$query = "SELECT nomeAluno, codUser FROM cadastro WHERE codUser = '$codUser'";
$result = mysqli_query($conn, $query);
$aluno = mysqli_fetch_array($result);

$score = 0;
$acertos = 0;
$erros = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pontuacao = $_POST['alternativa'];
    $idQ = $rt['codQuestao'];

    $stmt = $conn->prepare("SELECT resposta FROM questao WHERE codQuestao = ?");
    $stmt->bind_param("s", $idQ);
    $stmt->execute();
    $stmt->bind_result($altCorreta);
    $stmt->fetch();
    $stmt->close();

    if ($pontuacao == $altCorreta) { // ACERTOU
        $score += 10;
        $acertos += 1;
        $erros += 0;

        if ($acertos == 1) {
            $_SESSION['acertos'] = 1;
        } elseif ($acertos == 2) {
            $_SESSION['acertos'] = 2;
        }

        $stmt = "INSERT INTO resultado (codUser, codQuestao, resultado, data_hora, codArea) VALUES ($codUser, $idQ, 1, '$dataAtual', '$area');";
        $result = mysqli_query($conn, $stmt);
    } else { // ERROU
        $score += 0;
        $acertos += 0;
        $erros += 1;

        if ($erros == 1) {
            $_SESSION['erros'] = 1;
            $_SESSION['altCorretaCompleta'] = $rt['alt' . $altCorreta]; // Armazena a alternativa completa

            $stmt = "INSERT INTO resultado (codUser, codQuestao, resultado, data_hora, codArea) VALUES ($codUser, $idQ, 0, '$dataAtual', '$area');";
            $result = mysqli_query($conn, $stmt);
        } elseif ($erros == 2) {
            $_SESSION['erros'] = 2;
            $_SESSION['altCorretaCompleta'] = $rt['alt' . $altCorreta]; // Armazena a alternativa completa

            $stmt = "INSERT INTO resultado (codUser, codQuestao, resultado, data_hora, codArea) VALUES ($codUser, $idQ, 0, '$dataAtual', '$area');";
            $result = mysqli_query($conn, $stmt);
        }
    }

    header('Location: resultadoCN.php'); // Redirecionamento para a página de resultado
    exit();
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="cronometro.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/questoes.css">

    <title> pergunta </title>
</head>

<body>
    <div class='parent'>
        <div class="magicpattern">
            <div class="contagem">
                <h1 id="timer"></h1>
            </div>
            <div>
                <h1 id="titulo" style="padding-top: -30px"> ciências da natureza </h1>
            </div>

            <div id="enunciado">
                <?php echo $rt['enunciado']; ?>
            </div>


            <div class="container">
                <form method="POST" action="questaoCN.php">
                    <div id="alta" class="quest">
                        <input type="radio" value="A" name="alternativa" id="altA">
                        <label for="altA"><?php echo strip_tags($rt['altA']); ?> </label>
                    </div>
                    <div id="altb" class="quest">
                        <input type="radio" value="B" name="alternativa" id="altB">
                        <label for="altB"><?php echo strip_tags($rt['altB']); ?> </label>
                    </div>
                    <div id="altc" class="quest">
                        <input type="radio" value="C" name="alternativa" id="altC">
                        <label for="altC"><?php echo strip_tags($rt['altC']); ?> </label>
                    </div>
                    <div id="altd" class="quest">
                        <input type="radio" value="D" name="alternativa" id="altD">
                        <label for="altD"><?php echo strip_tags($rt['altD']); ?></label>
                    </div>
                    <div id="alte" class="quest">
                        <input type="radio" value="E" name="alternativa" id="altE">
                        <label for="altE"><?php echo strip_tags($rt['altE']); ?> </label>
                    </div>
                    <button type="submit"> Enviar </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
    $('.quest input[type="radio"]').keydown(function(event) {
        var tecla = event.keyCode;
        if (tecla == 38) { // Seta para cima
            $(this).parent().prev().find('input[type="radio"]').focus();
        } else if (tecla == 40) { // Seta para baixo
            $(this).parent().next().find('input[type="radio"]').focus();
        }
    });

    $('.quest input[type="radio"]').focus(function() {
        $(this).parent('.quest').addClass('focused'); // Adiciona a classe CSS quando focado
    });

    $('.quest input[type="radio"]').blur(function() {
        $(this).parent('.quest').removeClass('focused'); // Remove a classe CSS quando perder o foco
    });

    $('.quest input[type="radio"]').change(function() {
        $('.quest').removeClass('selected'); // Remove a classe de seleção de todas as alternativas
        $(this).parent('.quest').addClass('selected'); // Adiciona a classe de seleção na alternativa atual
    });
});

        $(document).ready(function() {
            $('.quest input[type="radio"]').keydown(function(event) {
                var tecla = event.keyCode;
                if (tecla == 38) { // Seta para cima
                    $(this).parent().prev().find('input[type="radio"]').focus();
                } else if (tecla == 40) { // Seta para baixo
                    $(this).parent().next().find('input[type="radio"]').focus();
                }
            });
        });
        $(document).ready(function() {
            $('#altA').prop('checked', true);
            $('#alta').focus(); // Foca na div da alternativa A

            $('.quest input[type="radio"]').focus(function() {
                $(this).parent('.quest').addClass('focused'); // Adiciona a classe CSS quando focado
            });

            $('.quest input[type="radio"]').blur(function() {
                $(this).parent('.quest').removeClass('focused'); // Remove a classe CSS quando perder o foco
            });
        });

        $(document).keydown(function(event) {
            var tecla = event.keyCode;
            if (tecla == 13) {
                $('form').submit();
            }
        });
    </script>
</body>

</html>