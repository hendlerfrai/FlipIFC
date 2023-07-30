<?php
include('conexao.php');

$sql = "SELECT codUser, acertos FROM pontuacao ORDER BY acertos DESC";
$resultado = mysqli_query($conn, $sql);

$stmt = "SELECT *, SUM(resultado.resultado) AS acertos FROM `resultado` 
            INNER JOIN cadastro ON cadastro.codUser = `resultado`.codUser 
            WHERE 
            DATE(data_hora)>='2023-07-23' AND
            DATE(data_hora)<='2023-07-29' AND 
            resultado=1 
            GROUP BY resultado.codUser 
            DESC";
$retorno = mysqli_query($conn, $stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <div class="container">
    <table class="table">
        <thead>
            <th>Posição</th>
            <th>Estudante</th>
            <th>Pontuação</th>
            </thead>
            <tbody>
<?php
if (mysqli_num_rows($resultado) > 0) {
    echo "<h2>Ranking:</h2>";
    $pos = 0;
    while ($row = mysqli_fetch_assoc($retorno)) {
        
        $pos++;
        // Consulta para obter o nome do aluno com base no codUser
/*        $query = "SELECT nomeAluno FROM cadastro WHERE codUser = '$codUser'";
        $result = mysqli_query($conn, $query);
        $aluno = mysqli_fetch_assoc($result);*/
        echo '<tr>';
        echo "<td>$pos</td>";
        echo "<td>". $row['nomeAluno']."</td>";
        echo "<td>". $row['acertos']."</td>";
    echo '</tr>';
}

} else {
    echo "Nenhum resultado encontrado.";
}

mysqli_close($conn);
?>
            </tbody>
</table>  
</div>  
</body>
</html>
