<?php
require_once '../vendor/autoload.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

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

$dompdf->setPaper('A4');

$dompdf->render();

$dompdf->stream();
?>