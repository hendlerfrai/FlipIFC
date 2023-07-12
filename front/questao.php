<?php
include('conexao.php');
require('verifica.php');

$query = "SELECT nomeAluno FROM cadastro WHERE codAcesso = '$codUser'";
$result = mysqli_query($conn, $query);
$aluno = mysqli_fetch_array($result);

$data_hora = date("Y-m-d H:i:s");
$score = 0;
$acertos = 0;
$erros = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pontuacao = $_POST['alternativa'];

    $stmt = $conn->prepare("SELECT resposta FROM questao");
    $stmt->execute();
    $stmt->bind_result($altCorreta);
    $stmt->fetch();
    $stmt->close();

    if ($pontuacao == 'alt' . $altCorreta) {
        $score += 10;
        $acertos += 1;

        $stmt = $conn->prepare("INSERT INTO resultado (pontuacao, data_hora) VALUES ($score, $data_hora)");
        $stmt->execute();
        $stmt->close();

        echo "Você acertou, " . $aluno['nomeAluno'] . "! Sua pontuação foi de " . $score . " pontos.";
    } else {
        $erros += 1;
        echo "Você errou, " . $aluno['nomeAluno'] . ":( Sua pontuação foi de " . $score . " pontos.";
    }

    $sql = "UPDATE pontuacao SET acertos='$acertos', erros='$erros'";

}

$sql = "SELECT * FROM questao ORDER BY RAND() LIMIT 1";
$rs = mysqli_query($conn, $sql);
$rt = mysqli_fetch_assoc($rs);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>pergunta</title>
</head>
<body>
    <div id="enunciado" style="background-color: gray">
        <?php echo $rt['enunciado']; ?>
    </div>

    <form method="POST" action="">
        <div id="alta" style="background-color: green">
            <input type="radio" name="alternativa" id="altA">
            <label for="altA"><?php echo strip_tags($rt['altA']); ?> </label>
        </div>
        <div id="altb" style="background-color: yellow">
            <input type="radio" name="alternativa" id="altB">
            <label for="altB"><?php echo strip_tags($rt['altB']); ?> </label>
        </div>
        <div id="altc" style="background-color: purple">
            <input type="radio" name="alternativa" id="altC">
            <label for="altC"><?php echo strip_tags($rt['altC']); ?> </label>
        </div>
        <div id="altd" style="background-color: blue">
            <input type="radio" name="alternativa" id="altD">
            <label for="altD"><?php echo strip_tags($rt['altD']); ?></label>
        </div>
        <div id="alte" style="background-color: red">
            <input type="radio" name="alternativa" id="altE">
            <label for="altE"><?php echo strip_tags($rt['altE']); ?> </label>
        </div>
        <button type="submit">Enviar</button>
    </form>

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