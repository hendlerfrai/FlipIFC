<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Relatório Semanal</h1>

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

    function gerarRelatorioSemanal($semana) {
        global $conn;

        $sql = "SELECT codArea, SUM(resultado) AS acertos, COUNT(*) AS total_questoes FROM resultado WHERE WEEK(data_hora) = WEEK('$semana') GROUP BY codArea";
        $result = $conn->query($sql);

        $assunto = "Relatório Semanal - " . date('Y-m-d', strtotime($semana));
        $mensagem = "<h2>Relatório Semanal - " . date('Y-m-d', strtotime($semana)) . "</h2>";

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

    gerarRelatorioSemanal(date('Y-m-d'));
    ?>

</body>
</html>