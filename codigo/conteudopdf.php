<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Relatório Semanal</title>
    <style>
       @font-face {
    font-family: 'customFont';
    src: url('/css/04B_30__.TTF') format('truetype');
}

body {
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    position: relative;
    font-family: 'customFont', sans-serif;
}

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
    border-spacing: 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    background-color: #fff;
}

th, td {
    font-family: 'customFont', sans-serif; 
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

thead {
    background-color: #d2dde9;
    color: black;
}

h2 {
    text-align: center;
    font-size: 1.2em;
    font-family: Helvetica, Arial;
    margin: 10px;
    color: #00135c;
    text-shadow: 0px 3px 4px rgba(0, 0, 0, 0.447);
}

#header {
    text-align: center;
    margin-top: 20px;
}

        </style>
</head>
<body>

<?php
require('conexao.php');

function obterNomeDaAreaPeloCodigo($codigo) {
    global $conn;

    $sql = "SELECT nome_area FROM area WHERE codArea = $codigo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['nome_area'];
    } else {
        return "Área não encontrada";
    }
}

function gerarRelatorioSemanal($segunda, $domingo) {
    global $conn;

    $sql = "SELECT codArea, SUM(resultado) AS acertos, COUNT(*) AS total_questoes FROM resultado WHERE data_hora >= '$segunda' AND data_hora <= '$domingo' GROUP BY codArea";
    $result = $conn->query($sql);

    $assunto = "Relatório Semanal - $segunda até $domingo";
    ?>

    <div id='header'>
<h1>
    <span style='color: #3604b5;'>F</span>
    <span style='color: #c11123;'>l</span>
    <span style='color: #3604b5;'>i</span>
    <span style='color: #c11123;'>p</span>
    <span style='color: green;'>IFC</span>
</h1>
</div>

<?php
    $mensagem = "<h2>Relatório Semanal - $segunda até $domingo</h2>";
    
    $pontuacoesPorArea = array();
    while ($row = $result->fetch_assoc()) {
        $codArea = $row['codArea'];
        $area = obterNomeDaAreaPeloCodigo($codArea);
        $acertos = $row['acertos'];
        $total_questoes = $row['total_questoes'];

        if (!isset($pontuacoesPorArea[$area])) {
            $pontuacoesPorArea[$area] = array('acertos' => 0, 'total_questoes' => 0);
        }

        $pontuacoesPorArea[$area]['acertos'] += $acertos;
        $pontuacoesPorArea[$area]['total_questoes'] += $total_questoes;
    }
    $mensagem .= "<table>";
    $mensagem .= "<thead><tr><th>Área</th><th>Acertos</th><th>Total de Questões</th></tr></thead>";
    foreach ($pontuacoesPorArea as $area => $pontuacoes) {
        $acertos = $pontuacoes['acertos'];
        $total_questoes = $pontuacoes['total_questoes'];
        $mensagem .= "<tbody><tr><td>$area</td><td>$acertos</td><td>$total_questoes</td></tr></tbody>";
    }
    $mensagem .= "</table>";
    ?>

<div style="position: absolute; bottom: 0; text-align: center; padding: 10px; background-color: #d2dde9; width: 100%;">Instituto Federal Catarinense Campus Avançado Sombrio<br>Av. Pref. Francisco Lumertz Júnior, 931 - Januária, Sombrio - SC, 88960-000<br>Contato: projetoflipifc@gmail.com</div>

<?php
    echo $mensagem;
}

$segunda_atual = date('Y-m-d', strtotime("next monday"));
$domingo_atual = date('Y-m-d', strtotime("$segunda_atual +6 days"));
$segunda_anterior = date('Y-m-d', strtotime("$segunda_atual -7 days"));
$domingo_anterior = date('Y-m-d', strtotime("$domingo_atual -7 days"));

gerarRelatorioSemanal($segunda_anterior, $domingo_anterior);
?>

</body>
</html>