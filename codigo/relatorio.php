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
    $dompdf->getOptions()->set('isPhpEnabled', true);
    $dompdf->getOptions()->set('isHtml5ParserEnabled', true);    
    ob_start();
    include('conteudopdf.php');
    $html = ob_get_clean();

    $header = "<div id='header'>
    <h1>
        <span style='color: #3604b5;'>F</span>
        <span style='color: #c11123;'>l</span>
        <span style='color: #3604b5;'>i</span>
        <span style='color: #c11123;'>p</span>
        <span style='color: green;'>IFC</span>
    </h1>
</div>
";
    $footer = '<div style="position: absolute; bottom: 0; text-align: center; padding: 10px; background-color: #d2dde9; width: 100%;">Instituto Federal Catarinense Campus Avançado Sombrio<br>Av. Pref. Francisco Lumertz Júnior, 931 - Januária, Sombrio - SC, 88960-000<br>Contato: projetoflipifc@gmail.com</div>';

    $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <style>
            @import url('https://fonts.googleapis.com/css?family=Neuton:400,700&display=swap');
                body {
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                    position: relative;
                }

                table {
                    width: 80%;
                    margin: 20px auto;
                    border-collapse: separate;
                    border-spacing: 0;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    border-radius: 10px;
                    overflow: hidden;
                }

                th, td {
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
        
                @font-face {
                    font-family: '0';
                    src: url('/css/04B_30__.TTF') format('truetype');
                }
            
                #header {
                    font-family: 'Neuton', serif;
                    text-align: center;
                    margin-top: 20px;
                }

            </style>
        </head>
        <body>
        <div id='header'> " . $header . "</div>
            " . $html ."
            <div id='footer'> " . $footer . "</div>
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
