
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/ppoProgresso.css">

    <title>FlipIFC</title>
</head>
<body>
        <div>
            <h1 id="titulo" style="padding-top: -30px"> Você concluiu suas tentativas diárias. </br> Deseja acessar o ranking? </h1>
        </div>
        <div>
        <button class="botao1">
            <span class="botaovoltar"> <a href="index.php" target="_self"
                    style="text-decoration: none; color: #aa422f;">Voltar</a> </span>
        </button>
        <button class="botao2">
            <span class="botasim"> <a href="ranking.php" target="_self"
                    style="text-decoration: none; color: #aa422f;">Sim</a> </span>
        </button>
        </div>

    <script>
        $(document).keydown(function(event) {
            var tecla = event.keyCode;
            if (tecla == 13) {
                window.location.href = 'ranking.php'
            }
        });
    </script>
</body>
</html>