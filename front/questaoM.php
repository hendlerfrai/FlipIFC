<?php
include('conexao.php');
require('verifica.php');

//print_r($_SESSION);

$dataAtual = date("Y-m-d");
$data_hora = date("Y-m-d H:i:s");
$area = 4;

$sql = "SELECT * FROM questao WHERE codArea = 4 ORDER BY RAND() LIMIT 1";
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

    if ($pontuacao == $altCorreta) {
        $score += 10;
        $acertos += 1;
        $erros += 0;

        $stmt = "INSERT INTO resultado (codUser, codQuestao, resultado, data_hora, codArea) VALUES ($codUser, $idQ, 1, '$dataAtual', '$area');";
        $result = mysqli_query($conn, $stmt);
        if ($acertos == 1) {
            $_SESSION['acertos'] = 1;
        } elseif ($acertos == 2) {
            $_SESSION['acertos'] = 2;
        }
    } else {
        $score += 0;
        $acertos += 0;
        $erros += 1;
       
                $stmt = "INSERT INTO resultado (codUser, codQuestao, resultado, data_hora, codArea) VALUES ($codUser, $idQ, 0, '$dataAtual', '$area');";
                $result = mysqli_query($conn, $stmt);

        if ($erros == 1) {
            $_SESSION['erros'] = 1;
            $_SESSION['altCorreta'] = $rt['alt' . $altCorreta]; // Armazena a alternativa completa
        } elseif ($erros == 2) {
            $_SESSION['erros'] = 2;
            $_SESSION['altCorreta'] = $rt['alt' . $altCorreta]; // Armazena a alternativa completa
        }
    }

    header('Location: resultado.php'); 
    exit(); 
}

$sql1 = "SELECT * FROM `resultado` WHERE data_hora='$dataAtual' AND codUser=$codUser";
$rs1 = $conn->query($sql1);
if ($rs1->num_rows >= 2) {
echo "Já jogou duas vezes ";
header('Refresh: 2 url= index.php');
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
    <link rel="stylesheet" type="text/css" href="css/questao.css">

    <title> pergunta </title>
</head>
<body style="position: relative">
<div class='parent'>
    <div class="magicpattern">
        <div class="contagem">
            <h1 id="timer"></h1>
        </div>
        <div>
            <h1 id="titulo" style="padding-top: -30px"> matemática </h1>
        </div>

        <div id="enunciado">
        <?php echo $rt['enunciado']; ?>
        </div>


    <div class="container">
        <form method="POST" action="questaoM.php">
            <div id="alta">
                <input type="radio" value="A" name="alternativa" id="altA">
                <label for="altA"><?php echo strip_tags($rt['altA']); ?> </label>
            </div>
            <div id="altb">
                <input type="radio" value="B" name="alternativa" id="altB">
                <label for="altB"><?php echo strip_tags($rt['altB']); ?> </label>
            </div>
            <div id="altc">
                <input type="radio" value="C" name="alternativa" id="altC">
                <label for="altC"><?php echo strip_tags($rt['altC']); ?> </label>
            </div>
            <div id="altd">
                <input type="radio" value="D" name="alternativa" id="altD">
                <label for="altD"><?php echo strip_tags($rt['altD']); ?></label>
            </div>
            <div id="alte">
                <input type="radio" value="E" name="alternativa" id="altE">
                <label for="altE"><?php echo strip_tags($rt['altE']); ?> </label>
            </div>
            <button type="submit"> Enviar </button>
        </form>
    </div>
   </div>
</div>

<script>
    $(document).keydown(function(event) {
        var tecla = event.keyCode;
        if (tecla == 13) {
            $('form').submit();
        }
    });
</script>
</body>
</html>
