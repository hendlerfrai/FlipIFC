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
    <title>Relatório Semanal</title>
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
    <h1>Relatório Semanal</h1>
    " . $html . "
</body>
</html>
";

$dompdf->loadHtml($html);

$dompdf->setPaper('A4');

$dompdf->render();

$dompdf->stream();
?>
