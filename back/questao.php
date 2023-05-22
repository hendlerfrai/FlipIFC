<?php
include('conexao.php');

$sql =  "select * from questao ORDER BY RAND() LIMIT 1";
$rs = mysqli_query($conn, $sql);

$rt = mysqli_fetch_assoc($rs);
//print_r($rt);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>Document</title>

</head>
<script>
    $(document).keydown(function() {
        var tecla = event.keyCode;
        if (tecla == 13 ) {

            if ($('#alternativaB').prop('checked') == true) {
                alert('vc acertou');
                window.location.href = 'verifica.php'
            } else {
                alert('vc errou')
            }
        }
    })
</script>

<body>

<div id="enunciado" style="background-color: gray">
<?php echo $rt['enunciado']; ?>
</div>

<div id="alta" style="background-color: green">
<input type="checkbox" name="" id="altA"> <?php echo strip_tags($rt['altA']); ?>
</div>
<div id="altb" style="background-color: yellow">
<input type="checkbox" name="altB" id="alternativaB"> <?php echo strip_tags($rt['altB']); ?>
</div>


</body>
</html>