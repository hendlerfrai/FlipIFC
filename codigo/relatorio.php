<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

require '../vendor/autoload.php';

try {
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->Username = 'projetoflipifc@gmail.com';
    $mail->Password = 'xkbn emub pjet nwhf';

    $mail->setFrom('flipifc@ifc.com', 'Equipe FlipIFC');
    $mail->addAddress('hendlerf.raissa@gmail.com', 'raissa');

    $assunto = "relatorio semanal - " . date('Y-m-d', strtotime('2023-09-25'));
    $mail->Subject = $assunto;

    $dompdf = new Dompdf();
    
        ob_start();
        include('conteudopdf.php'); 
        $html = ob_get_clean();

        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>relatorio</title>
            <style>
                /* Adicione estilos CSS para a tabela aqui */
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                }
            </style>
        </head>
        <body>
            " . $html . "
        </body>
        </html>
        ";

        $dompdf->loadHtml($html);
    
    $dompdf->render();

    $pdfFileName = 'relatorio.pdf';
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
