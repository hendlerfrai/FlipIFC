<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/loginUser.css">

    <title>FlipIFC</title>
</head>

<body>
    <div style="margin-top: -70px; margin-left: 550px">
        <div class="row">
        <div id="mensagem-erro">
                        <?php
                        session_start();
                        if (isset($_SESSION['mensagemErro'])) {
                            echo $_SESSION['mensagemErro'];
                        }
                        ?>
                    </div>
            <div class="col-sm-4">
                
                <form method="POST" action="loginBack.php" class="form" style="margin-top: 90%;">
                    <p class="heading">Digite seu código:</p>
                    <div class="box">
                        <input class="input" type="password" maxlength="1" name="valor1" oninput="moveToNext(this, 'valor2')">
                        <input class="input" type="password" maxlength="1" name="valor2" oninput="moveToNext(this, 'valor3')">
                        <input class="input" type="password" maxlength="1" name="valor3" oninput="moveToNext(this, 'valor4')">
                        <input class="input" type="password" maxlength="1" name="valor4" oninput="moveToNext(this, 'valor5')">
                        <input class="input" type="password" maxlength="1" name="valor5">
                    </div>
                    <button type="submit" class="btn1">Enviar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        //selecionar o primeiro automatico --------------------------------
         document.addEventListener("DOMContentLoaded", function() {
            var valor1 = document.querySelector("input[type='password']");

            if (valor1) {
                valor1.focus(); // Dar foco ao elemento
                valor1.select(); // Selecionar o conteúdo do elemento
            }
        });
            // apagar tudo no delete -----------------------------------------------
        function deleteInputsAndFocusFirst() {
            const inputs = document.querySelectorAll("input[type='password']");
            inputs.forEach((input, index) => {
                input.value = '';
                if (index === 0) {
                    input.focus();
                }
            });
        }
        document.addEventListener("keydown", function (event) {
            var tecla = event.keyCode || event.which;
            if (tecla === 8) { 
                deleteInputsAndFocusFirst();
            }
        });
       
        // enter ----------------------------------------------------------------
    $(document).keydown(function () {
        var tecla = event.keyCode;
        if (tecla == 13) {
            window.location.href = 'areas.php'
        }
    })   ; 
        // passar automatico
    function moveToNext(input, nextInputName) {
            const maxLength = parseInt(input.getAttribute("maxlength"));
            const currentLength = input.value.length;
            if (currentLength >= maxLength) {
                const nextInput = document.getElementsByName(nextInputName)[0];
                if (nextInput) {
                    nextInput.focus();
                }
            }
        }

       
</script>
</body>

</html>
