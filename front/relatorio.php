<?php
require 'caminho/para/phpmailer/PHPMailerAutoload.php';

// Função para enviar o e-mail
function enviarEmail($assunto, $mensagem) {
    $mail = new PHPMailer;

    // Configurações do servidor de e-mail (substitua pelos dados do seu servidor)
    $mail->isSMTP();
    $mail->Host = 'seu_host_smtp';
    $mail->SMTPAuth = true;
    $mail->Username = 'seu_email';
    $mail->Password = 'sua_senha';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configurações do e-mail
    $mail->setFrom('seu_email', 'Seu Nome');
    $mail->addAddress('email_professor_1', 'Nome Professor 1');
    $mail->addAddress('email_professor_2', 'Nome Professor 2'); // Adicione mais endereços, se necessário
    $mail->isHTML(true);

    // Assunto e corpo do e-mail
    $mail->Subject = $assunto;
    $mail->Body = $mensagem;

    if (!$mail->send()) {
        return "Erro ao enviar o e-mail: " . $mail->ErrorInfo;
    } else {
        return "E-mail enviado com sucesso!";
    }
}

// Função para obter o nome da área pelo código
function obterNomeDaAreaPeloCodigo($codigo) {
    include('conexao.php');

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $sql = "SELECT nome_area FROM area WHERE codArea = $codigo";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['nome_area'];
    } else {
        return "Área não encontrada";
    }
}

// Função para gerar o relatório semanal com as áreas e enviar por e-mail
function gerarRelatorioSemanal($semana) {
        // Conexão com o banco de dados (substitua pelos dados do seu servidor)
       function gerarRelatorioSemanal($semana) {

        include('conexao.php');

    // Consulta para obter o relatório semanal
    $sql = "SELECT codArea, SUM(resultado) AS acertos, COUNT(*) AS total_questoes FROM resultado WHERE WEEK(data_hora) = WEEK('$semana') GROUP BY codArea";
    $result = $conn->query($sql);

        // Consulta para obter o relatório semanal
        $sql = "SELECT codArea, SUM(resultado) AS acertos, COUNT(*) AS total_questoes FROM resultado WHERE WEEK(data_hora) = WEEK('$semana') GROUP BY codArea";
        $result = $conn->query($sql);

    // Montar o conteúdo do e-mail com as áreas e suas respectivas pontuações
    $assunto = "Relatório Semanal - " . date('Y-m-d', strtotime($semana));
    $mensagem = "<h2>Relatório Semanal - " . date('Y-m-d', strtotime($semana)) . "</h2>";

    // Montar um array associativo para agrupar as pontuações por área
    $pontuacoesPorArea = array();
    while ($row = $result->fetch_assoc()) {
        $codArea = $row['codArea'];
        $area = obterNomeDaAreaPeloCodigo($codArea);
        $acertos = $row['acertos'];
        $total_questoes = $row['total_questoes'];

        // Verificar se a área já existe no array, se não, criá-la
        if (!isset($pontuacoesPorArea[$area])) {
            $pontuacoesPorArea[$area] = array('acertos' => 0, 'total_questoes' => 0);
        }

        // Adicionar as pontuações da questão à área correspondente
        $pontuacoesPorArea[$area]['acertos'] += $acertos;
        $pontuacoesPorArea[$area]['total_questoes'] += $total_questoes;
    }

    // Montar a tabela com as áreas e suas respectivas pontuações
    $mensagem .= "<table>";
    $mensagem .= "<tr><th>Área</th><th>Acertos</th><th>Total de Questões</th></tr>";
    foreach ($pontuacoesPorArea as $area => $pontuacoes) {
        $acertos = $pontuacoes['acertos'];
        $total_questoes = $pontuacoes['total_questoes'];
        $mensagem .= "<tr><td>$area</td><td>$acertos</td><td>$total_questoes</td></tr>";
    }
    $mensagem .= "</table>";

    // Enviar o e-mail
    $resultado = enviarEmail($assunto, $mensagem);

    // Exibir o resultado do envio (pode ser útil para debug, você pode remover ou tratar de outra forma)
    echo $resultado;
}
}
// Exemplo de uso - gerar relatório para a semana atual e enviar por e-mail
$semanaAtual = date('Y-m-d');
gerarRelatorioSemanal($semanaAtual);
?>