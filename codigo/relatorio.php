<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

require '../vendor/autoload.php';

try {
    $mail = new PHPMailer(true);

    // Configuração do servidor SMTP e credenciais
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->Username = 'projetoflipifc@gmail.com';
    $mail->Password = 'xkbn emub pjet nwhf';

    // Remetente e destinatário
    $mail->setFrom('flipifc@ifc.com', 'Equipe FlipIFC');
    $mail->addAddress('luizascrs@gmail.com');

    $dataInicioSemana = date('Y-m-d', strtotime('last monday', strtotime('this week')));
    $dataFimSemana = date('Y-m-d', strtotime('last sunday', strtotime('this week')));
    $dataSemanaAnterior = date('Y-m-d', strtotime('-1 week'));

    $assunto = "Relatorio Semanal - Semana de " . $dataInicioSemana . " a " . $dataFimSemana;
    $mail->Subject = $assunto;

    $dompdf = new Dompdf();
    $dompdf->getOptions()->set('isPhpEnabled', true);
    $dompdf->getOptions()->set('isHtml5ParserEnabled', true);

    ob_start();
    include('conteudopdf.php');
    $html = ob_get_clean();

    $html = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <style>
        .header {
            background-color: #fff;
            width: 70%;
            transform: scale(0.7); /* Adicione essa linha para diminuir todos os elementos em 20% */
            transform-origin: top left;
            margin-left: 350px;
            margin-bottom: -600px;
        }
        </style>
    </head>
    <body>
        " . $html ."
    </body>
    </html>
    ";

    $dompdf->loadHtml($html);

    $dompdf->render();

    $pdfFileName = 'relatorio_semanal_' . date('Y-m-d', strtotime($dataSemanaAnterior)) . '.pdf';
    $pdfPath = '../imagensFlip2019/' . $pdfFileName;
    file_put_contents($pdfPath, $dompdf->output());

    $mail->addAttachment($pdfPath, $pdfFileName);

    $mail->Body = "Relatório semanal em anexo.";

    $mail->send();

    echo "E-mail enviado com sucesso!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

if (file_exists($pdfPath)) {
    unlink($pdfPath);
}
?>
