<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/loginUsuario.css">

    <title> FlipIFC </title>
</head>
<script>
    $(document).keydown(function () {
        var tecla = event.keyCode;
        if (tecla == 13) {
            window.location.href = 'areas.php'
        }
    })    
</script>

<body>

    <div class="container d-flex justify-content-center mt-5">
        <div class="row">
            <div class="col-sm-4">
                <form method="POST" action="loginBack.php" class="form" style="margin-top: 90%;">
                    <p class="heading">Digite seu código:</p>
                    </svg>
                    <div class="box">
                        <input class="input" type="text" maxlength="1" name="valor1">
                        <input class="input" type="text" maxlength="1" name="valor2">
                        <input class="input" type="text" maxlength="1" name="valor3">
                        <input class="input" type="text" maxlength="1" name="valor4">
                        <input class="input" type="text" maxlength="1" name="valor5">
                    </div>
                    <button class="btn1">
                        <a href="areas.php" target="_self" style="text-decoration: none; color: black;"> Enviar </a>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>