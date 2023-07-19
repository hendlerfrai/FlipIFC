<?php
include('conexao.php');

$sql = "SELECT codUser, acertos FROM pontuacao ORDER BY acertos DESC";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {
    echo "<h2>Ranking:</h2>";
    echo "<ol>";

    while ($row = mysqli_fetch_assoc($resultado)) {
        $codUser = $row['codUser'];

        // Consulta para obter o nome do aluno com base no codUser
        $query = "SELECT nomeAluno FROM cadastro WHERE codUser = '$codUser'";
        $result = mysqli_query($conn, $query);
        $aluno = mysqli_fetch_assoc($result);

        echo '<li>' . $aluno['nomeAluno'] ." - Pontuação: " . $row['acertos'] .'</li>';
    }

    echo "</ol>";
} else {
    echo "Nenhum resultado encontrado.";
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estiloRanking.php" />
    
    <title>FlipIFC</title>
</head>
<body>
<div class='parent'>
    <div class="magicpattern">
</div>
</div>    
</body>
</html>