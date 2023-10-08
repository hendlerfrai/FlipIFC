<?php
include('conexao.php');
require('verifica.php');

$query = "SELECT cadastro.nomeAluno, SUM(resultado.resultado) AS total_acertos
          FROM cadastro
          LEFT JOIN resultado ON cadastro.codUser = resultado.codUser
          GROUP BY cadastro.codUser, cadastro.nomeAluno
          HAVING total_acertos >= 0
          ORDER BY total_acertos DESC
          LIMIT 10";
$result = mysqli_query($conn, $query);
header("refresh:120;url=index.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/estiloRanking.css">

    <script>
       document.addEventListener("keypress", function (e) {
       if (e.key === "Enter") {
        const btn = document.querySelector("#send");
        btn.click();
        window.location.href="index.php";
       }
    }); 
    </script>
</head>
<body>
<div class='parent'>
    <div class="magicpattern">
    <div class="container">
    <h2>Ranking</h2>

    <table class="table">
    <thead>
            <th>Posição</th>
            <th> </th>
            <th> </th>
            <th>Nome do Aluno</th>
            <th>Total de Acertos</th>
</thead>
<tbody>
        <?php
        $posicao = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $nomeAluno = $row['nomeAluno'];
            $totalAcertos = $row['total_acertos'];
            echo "<tr>";
            echo "<td class='pos'>{$posicao}</td>";
            echo "<td></td>";
            echo "<td></td>";

            echo "<td>{$nomeAluno}</td>";
            echo "<td>{$totalAcertos}</td>";
            echo "</tr>";
            $posicao++;
        }
        
        ?>
</tbody>

    </table>
    <button class="btn" id="send" style="text-decoration: none">
     <a href="index.php" target="_self" >voltar a tela inicial</a>
     </button>
    </div>
    </div>
    <script language="javascript">
        $(document).ready(function() {
    var buttons = $('.btn');
    var currentButtonIndex = 0;
    
    buttons.eq(currentButtonIndex).focus();
   
});
    </script>
    
</body>
</html>
