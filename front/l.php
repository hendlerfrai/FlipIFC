<?php
include('conexao.php');
require('verifica.php');

<<<<<<< HEAD:front/questao.php
//print_r($_SESSION);

$dataAtual = date("Y-m-d");
$data_hora = date("Y-m-d H:i:s");


=======
>>>>>>> 0b1f174ce1ca5f4d1d4bca8d5b322d08d00b800f:front/l.php
$sql = "SELECT * FROM questao ORDER BY RAND() LIMIT 1";
$rs = mysqli_query($conn, $sql);
$rt = mysqli_fetch_assoc($rs);

<<<<<<< HEAD:front/questao.php
$query = "SELECT nomeAluno, codUser FROM cadastro WHERE codUser = '$codUser'";
$result = mysqli_query($conn, $query);
$aluno = mysqli_fetch_array($result);

=======
$query = "SELECT nomeAluno FROM cadastro WHERE codAcesso = '$codUser'";
$result = mysqli_query($conn, $query);
$aluno = mysqli_fetch_array($result);

$data_hora = date("Y-m-d H:i:s"); 
>>>>>>> 0b1f174ce1ca5f4d1d4bca8d5b322d08d00b800f:front/l.php
$score = 0;
$acertos = 0;
$erros = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pontuacao = $_POST['alternativa'];
<<<<<<< HEAD:front/questao.php
    $idQ = $rt['codQuestao'];
    echo "id da questao: " . $idQ;
    echo "<br>";

    $stmt = $conn->prepare("SELECT resposta FROM questao WHERE codQuestao = ?");
    $stmt->bind_param("s", $idQ);
=======
    echo $pontuacao;
    $idQ = $rt ['codQuestao'];
    echo $idQ;
    echo "--------------------------------";
    $stmt = $conn->prepare("SELECT resposta FROM questao WHERE codQuestao = $idQ");
>>>>>>> 0b1f174ce1ca5f4d1d4bca8d5b322d08d00b800f:front/l.php
    $stmt->execute();
    $stmt->bind_result($altCorreta);
    $stmt->fetch();
    $stmt->close();

<<<<<<< HEAD:front/questao.php
    if ($pontuacao == $altCorreta){ // ACERTOU
=======
    if ($pontuacao == $rt){
        echo "coisa2";
>>>>>>> 0b1f174ce1ca5f4d1d4bca8d5b322d08d00b800f:front/l.php
        $score += 10;
        $acertos += 1;
        $erros += 0;

//        $stmt = $conn->prepare("UPDATE resultado SET resultado = ?, data_hora = ? WHERE codUser = ?");

$stmt = "INSERT INTO resultado (codUser, codQuestao, resultado, data_hora) VALUES ($codUser,$idQ,1,'$dataAtual');";
$result = mysqli_query($conn, $stmt);

<<<<<<< HEAD:front/questao.php
=======
        $stmt = $conn->prepare("INSERT INTO resultado (resultado, data_hora) VALUES ($score, $data_hora)");
        $stmt->execute();
        $stmt->close();
>>>>>>> 0b1f174ce1ca5f4d1d4bca8d5b322d08d00b800f:front/l.php

        echo "Você acertou, " . $aluno['nomeAluno'] . "! Sua pontuação foi de " . $score . " pontos.";

    } else {
        $score += 0;
        $acertos += 0;
        $erros +=1;

        $stmt = "INSERT INTO resultado (codUser, codQuestao, resultado, data_hora) VALUES ($codUser,$idQ,0,'$dataAtual');";
        $result = mysqli_query($conn, $stmt);


        echo "Você errou, " . $aluno['nomeAluno'] . " :( Sua pontuação foi de " . $score . " pontos. A resposta correta era alt". $altCorreta;
    }

    $sql = "UPDATE pontuacao SET acertos='$acertos', erros='$erros' WHERE codUser IN (SELECT codUser FROM cadastro)";
    mysqli_query($conn, $sql);
}

$sql1 = "SELECT * FROM `resultado` WHERE data_hora='$dataAtual' AND codUser=$codUser";
$rs1 = $conn->query($sql1);
if ($rs1->num_rows >= 2) {
echo "Já jogou duas vezes ";
header('Refresh: 2 url= ppoP.php');
}
<<<<<<< HEAD:front/questao.php

=======
>>>>>>> 0b1f174ce1ca5f4d1d4bca8d5b322d08d00b800f:front/l.php
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

<<<<<<< HEAD:front/questao.php
    <title> pergunta </title>
=======
    <title>pergunta</title>
>>>>>>> 0b1f174ce1ca5f4d1d4bca8d5b322d08d00b800f:front/l.php
</head>
<body>
<div class='parent'>
    <div class="magicpattern">
        <div class="contagem">
            <h1 id="timer"></h1>
        </div>
        <div>
            <h1 id="titulo" style="padding-top: -30px"> ciências humanas </h1>
        </div>

        <div id="enunciado">
        <?php echo $rt['enunciado']; ?>
        </div>


    <div class="container">
        <form method="POST" action="questao.php">
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
<<<<<<< HEAD:front/questao.php
</div>
=======
   </div>
>>>>>>> 0b1f174ce1ca5f4d1d4bca8d5b322d08d00b800f:front/l.php

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