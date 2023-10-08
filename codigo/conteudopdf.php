<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Relatório Semanal</title>
    <style>
         body {
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        font-family: 'customFont', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        position: relative; /* Adicione isso para posicionar os elementos absolutos corretamente */
    }

    .header {
    width: 0%;
    transform: scale(0.7); /* Adicione essa linha para diminuir todos os elementos em 20% */
    transform-origin: top left;
    margin-left: 350px;
    margin-top: 100px;
}


    /* Adicione estilos para centralizar o conteúdo */
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative; /* Adicione isso para posicionar os elementos absolutos corretamente */
        padding-top: 100px; /* Ajuste isso conforme necessário */
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
            font-size: 1em;
            font-family: Helvetica, Arial;
            margin: 10px;
            color: #00135c;
            text-shadow: 0px 3px 4px rgba(0, 0, 0, 0.447);
        }

        .F1, .F2, .F3, .L, .I1, .I2, .P1, .P2, .P3, h1 {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 70%;
    }
         div.F1 {
            position: absolute;
            width: 41.27px;
            height: 11.99px;
            left: 240px;
            top: 10px;
            background: #3604b5;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 90px;
            transform: rotate(-3.99deg);
        }


        div.F2 {
            position: absolute;
            width: 13px;
            height: 58.65px;
            left: 245px;
            top: 8px;
            background: #3604b5;
            border-radius: 90px;
            transform: rotate(-3.99deg);
        }

        div.F3 {
            position: absolute;
            width: 41.27px;
            height: 11.99px;
            left: 240px;
            top: 33px;
            background: #3604b5;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 90px;
            transform: rotate(-3.99deg);
        }

        /* L*/

        div.L {
            position: absolute;
            width: 63.26px;
            height: 11.99px;
            left: 270px;
            top: 50px;

            background: #c11123;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 90px;
            transform: rotate(76.61deg);
        }

        /* I */

        div.I1 {
            position: absolute;
            width: 10.46px;
            height: 45.81px;
            left: 318px;
            top: 23px;
            background: #3604b5;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 90px;
            transform: rotate(-3.99deg);
        }

        div.I2 {
            position: absolute;
            width: 13px;
            height: 12px;
            left: 320px;
            top: 8px;
            background: #3604b5;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 50%;
        }

        /* P */

        div.P1 {
            position: absolute;
            width: 9.77px;
            height: 61.1px;
            left: 345px;
            top: 5px;
            background: #c11123;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 90px;
            transform: rotate(6.05deg);
        }

        div.P2 {
            position: absolute;
            width: 41.27px;
            height: 11.99px;
            left: 350px;
            top: 9px;
            background: #c11123;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 90px;
            transform: rotate(33.03deg);
        }

        div.P3 {
            position: absolute;
            width: 41.27px;
            height: 11.99px;
            left: 350px;
            top: 25px;

            background: #c11123;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 90px;
            transform: rotate(-20.68deg);
        }


        /* IFC */

        h1 {
            position: absolute;
            width: 124px;
            height: 14px;
            left: 450px;
            top: 20px;
            font-family: 'Honey and Raspberries';
            font-style: normal;
            font-weight: 400;
            font-size: 40px;
            line-height: 46px;
            letter-spacing: 0.065em;

            color: #000000; 

            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
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

    $today = new DateTime();
    $lastWeekStart = clone $today;
    $lastWeekStart->modify('-2 week')->modify('Monday');
    $lastWeekEnd = clone $lastWeekStart;
    $lastWeekEnd->modify('+6 days')->setTime(23, 59, 59);

    gerarRelatorioSemanal($lastWeekStart->format('Y-m-d'), $lastWeekEnd->format('Y-m-d'));

    function gerarRelatorioSemanal($segunda, $domingo) {
        global $conn;

        $sql = "SELECT codArea, SUM(resultado) AS acertos, COUNT(*) AS total_questoes FROM resultado WHERE data_hora >= '$segunda' AND data_hora <= '$domingo' GROUP BY codArea";
        $result = $conn->query($sql);

        $assunto = "Relatório Semanal - $segunda até $domingo";
        ?>

        <div class="header">
    <div class="F1"></div>
    <div class="F2"></div>
    <div class="F3"></div>

    <div class="L"></div>

    <div class="I1"></div>
    <div class="I2"></div>

    <div class="P1"></div>
    <div class="P2"></div>
    <div class="P3"></div>

    <h1> IFC </h1>
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
        echo '<div class="container">';
        $mensagem .= "<table>";
        $mensagem .= "<thead><tr><th>Área</th><th>Acertos</th><th>Total de Questões</th></tr></thead>";
        foreach ($pontuacoesPorArea as $area => $pontuacoes) {
            $acertos = $pontuacoes['acertos'];
            $total_questoes = $pontuacoes['total_questoes'];
            $mensagem .= "<tr><td>$area</td><td>$acertos</td><td>$total_questoes</td></tr>";
        }
        $mensagem .= "</table>";
        echo '</div>';
        ?>

        <div style="position: absolute; bottom: 0; text-align: center; padding: 10px; background-color: #d2dde9; width: 97.5%;">Instituto Federal Catarinense Campus Avançado Sombrio<br>Av. Pref. Francisco Lumertz Júnior, 931 - Januária, Sombrio - SC, 88960-000<br>Contato: projetoflipifc@gmail.com</div>
        <?php
        echo $mensagem;
    }
    ?>
</body>
</html>
