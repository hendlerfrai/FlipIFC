

















/* codigo com grafico em pdf
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
require '../tcpdf/tcpdf.php'; // Importe a biblioteca TCPDF

function obterNomeDaAreaPeloCodigo($codigo) {
    include('conexao.php');

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
    include('conexao.php');

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

    // Crie um array de dados para o gráfico
    $data = array();
    $labels = array();

    foreach ($pontuacoesPorArea as $area => $pontuacoes) {
        $acertos = $pontuacoes['acertos'];
        $total_questoes = $pontuacoes['total_questoes'];
        $labels[] = $area;
        $data[] = $acertos;
    }

    // Configurar o PDF usando TCPDF
    $pdf = new TCPDF();
    $pdf->SetMargins(20, 20, 20); // Margens
    $pdf->AddPage();

    // Adicionar cabeçalho
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Relatório Semanal', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Data: ' . date('Y-m-d', strtotime($semana)), 0, 1, 'C');

    // Adicionar tabela HTML ao PDF
    $pdf->writeHTML($mensagem, true, false, true, false, '');

    // Adicionar rodapé
    $pdf->SetY(-15);
    $pdf->SetFont('helvetica', 'I', 8);
    $pdf->Cell(0, 10, 'Página ' . $pdf->getAliasNumPage() . ' de ' . $pdf->getAliasNbPages(), 0, 0, 'C');

    // Salvar o PDF em um arquivo
    $pdf->Output('relatorio.pdf', 'F');

    // Resto do código para enviar o e-mail com o PDF anexado
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'projetoflipifc@gmail.com';
        $mail->Password = 'ewmk vfsc qidr rzcx';

        $mail->setFrom('flipifc@ifc.com', 'Equipe FlipIFC');
        $mail->addAddress('raissa.hendler.felisberto@gmail.com');

        $assunto = "Relatório Semanal - " . date('Y-m-d', strtotime($semana));
        $mail->Subject = $assunto;
        $mail->Body = $mensagem;

        // Anexar o PDF ao e-mail
        $pdfPath = 'relatorio.pdf';
        $mail->addAttachment($pdfPath);

        $mail->send();
        return "E-mail enviado com sucesso!";
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

$resultado = gerarRelatorioSemanal('2023-09-25');
echo $resultado;
*/
?>
