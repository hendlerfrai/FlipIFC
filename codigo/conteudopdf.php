<?php
include('conexao.php');

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
    $mensagem .= "<tr><th>Área</th><th>Acertos</th><th>Total de Questões</th></tr>";
    foreach ($pontuacoesPorArea as $area => $pontuacoes) {
        $acertos = $pontuacoes['acertos'];
        $total_questoes = $pontuacoes['total_questoes'];
        $mensagem .= "<tr><td>$area</td><td>$acertos</td><td>$total_questoes</td></tr>";
    }
    $mensagem .= "</table>";

    echo $mensagem;
}

$segunda_atual = date('Y-m-d', strtotime("next monday"));

$domingo_atual = date('Y-m-d', strtotime("$segunda_atual +6 days"));

$segunda_anterior = date('Y-m-d', strtotime("$segunda_atual -7 days"));

$domingo_anterior = date('Y-m-d', strtotime("$domingo_atual -7 days"));

gerarRelatorioSemanal($segunda_anterior, $domingo_anterior);
?>
