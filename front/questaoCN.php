<?php
include('conexao.php');
require('verifica.php');

$dataAtual = date("Y-m-d");
$data_hora = date("Y-m-d H:i:s");
$area = 2;

$sql = "SELECT * FROM questao WHERE codArea = 2 ORDER BY RAND() LIMIT 1";
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
                        <input type="radio" value="A" name="alternativa" id="altA" checked>
                        <button for="altA"><?php echo strip_tags($rt['altA']); ?> </button>
                    </div>
                    <div id="altb" class="quest">
                        <input type="radio" value="B" name="alternativa" id="altB">
                        <button for="altB"><?php echo strip_tags($rt['altB']); ?> </button>
                    </div>
                    <div id="altc" class="quest">
                        <input type="radio" value="C" name="alternativa" id="altC">
                        <button for="altC"><?php echo strip_tags($rt['altC']); ?> </button>
                    </div>
                    <div id="altd" class="quest">
                        <input type="radio" value="D" name="alternativa" id="altD">
                        <button for="altD"><?php echo strip_tags($rt['altD']); ?></button>
                    </div>
                    <div id="alte" class="quest">
                        <input type="radio" value="E" name="alternativa" id="altE">
                        <button for="altE"><?php echo strip_tags($rt['altE']); ?> </button>
                    </div>
                    <button class= "enter" type="submit"> Enviar </button>
                </form>
            </div>
        </div>
    </div>

    <script>          
    function selectRadio(divId) {
        document.getElementById(divId).querySelector('input[type="radio"]').checked = true;
    }

    function handleArrowKey(event) {
        const currentDiv = document.querySelector('.selected');
        if (currentDiv) {
            const divId = currentDiv.id;
            if (event.key === 'ArrowUp') {
                const prevDiv = currentDiv.previousElementSibling;
                if (prevDiv) {
                    currentDiv.classList.remove('selected');
                    prevDiv.classList.add('selected');
                    selectRadio(prevDiv.id);
                }
            } else if (event.key === 'ArrowDown') {
                const nextDiv = currentDiv.nextElementSibling;
                if (nextDiv) {
                    currentDiv.classList.remove('selected');
                    nextDiv.classList.add('selected');
                    selectRadio(nextDiv.id);
                }
            }
        } else {
            const firstDiv = document.querySelector('.quest');
            if (firstDiv) {
                firstDiv.classList.add('selected');
                selectRadio(firstDiv.id);
            }
        }
    }
    const questDivs = document.querySelectorAll('.quest');
    questDivs.forEach(div => {
        div.addEventListener('click', () => {
            questDivs.forEach(div => div.classList.remove('selected'));
            div.classList.add('selected');
            selectRadio(div.id);
        });
    });

    document.addEventListener('keydown', handleArrowKey);

    $(document).keydown(function(event) {
        var tecla = event.key;
        if (tecla === "Enter") {
            $('form').submit();
        }
    });


          /* codigo antigo, so p deixar salvo
                $(document).ready(function() {
    $('.quest input[type="radio"]').keydown(function(event)) {
        var tecla = event.key;

        if (tecla === "ArrowUp" || tecla === "ArrowDown") {
            event.preventDefault();
            var $divAtual = $(this).parent('.quest');
            var $radioAtual = $(this);
            var $opcoes = $('.quest input[type="radio"]'); // Todas as opções

            var currentIndex = $opcoes.index($radioAtual);
            var newIndex = currentIndex;

            if (tecla === "ArrowDown") {
                newIndex = (currentIndex + 1) % $opcoes.length;
            } else if (tecla === "ArrowUp") {
                newIndex = (currentIndex - 1 + $opcoes.length) % $opcoes.length;
            }

            $opcoes.eq(newIndex).prop('checked', true);
            $opcoes.eq(newIndex).focus();
        }
    }
    });
    

    $('#alta, #altb, #altc, #altd, #alte').keydown(function(event) {
        var tecla = event.key;
        
        if (tecla === "ArrowUp" || tecla === "ArrowDown") {
            event.preventDefault();
            var $opcoes = $('#alta, #altb, #altc, #altd, #alte');
            var currentIndex = $opcoes.index(this);
            var newIndex = currentIndex;
            
            if (tecla === "ArrowDown") {
                newIndex = (currentIndex + 1) % $opcoes.length;
            } else if (tecla === "ArrowUp") {
                newIndex = (currentIndex - 1 + $opcoes.length) % $opcoes.length;
            }
            
            $opcoes.eq(newIndex).focus();
        }
    }); */

</script>

</body>

</html>