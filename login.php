<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css">
    <title> FlipIFC </title>

   
</head>

<body>
    <div class="logo">
        <div class="F1"></div>
        <div class="F2"></div>
        <div class="F3"></div>

        <div class="L"></div>

        <div class="I1"></div>
        <div class="I2"></div>

        <div class="P1"></div>
        <div class="P2"></div>
        <div class="P3"></div>

        <h1> IFC </h1>
    </div>
    <div class="formulario">
    <?php
                    if(isset($_SESSION['nao_autenticado'])):
                    ?>
                    <div class="notification is-danger">
                      <p>ERRO: código inválidos.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                    ?>

    <form method="POST" action="loginBack.php" class="conta">
            <h3> login </h3>
            <label for="cod"> código: </label>
            <input type="text" id="cod" name="cod">
            <br>
            </br>

            <div class="botao">
                <button class="entrar">
                    <a href="index.php" target="_blank" style="text-decoration: none;"> entrar na conta </a>
                </button>
            </div>
        </form>
    </div>

    <script>
        window.alert
    </script>

</body>

</html>