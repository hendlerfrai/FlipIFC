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
<<<<<<< HEAD
<script>
    $(document).keydown(function () {
        var tecla = event.keyCode;
        if (tecla == 13) {
            window.location.href = 'areas.php'
        }
    });
    function jumpto(campoatual, proxcampo)
    {
   var tamanho_max = eval("document.box." + campoatual + ".maxLength;");
   var tamanho_atual = eval("document.box."+ campoatual +".value.length;");
   if (tamanho_atual = tamanho_max)
      { 
         eval("document.box."+ proxcampo +".focus();");
      }
    }; 
    
</script>
=======
>>>>>>> db01d6b224da5ab859cd2eafceab59f6386cd93a

<body>

    <div class="container d-flex justify-content-center mt-5">
        <div class="row">
            <div class="col-sm-4">
                <form method="POST" action="loginBack.php" class="form" style="margin-top: 90%;">
                    <p class="heading">Digite seu código:</p>
                    </svg>
                    <div class="box">
<<<<<<< HEAD
                        <input class="input" type="text" maxlength="1" name="valor1" onkeyUp="javascript:jumpto('valor1','valor2')">
                        <input class="input" type="text" maxlength="1" name="valor2"onkeyUp="javascript:jumpto('valor2','valor3')">
                        <input class="input" type="text" maxlength="1" name="valor3" onkeyUp="javascript:jumpto('valor3','valor4')">
                        <input class="input" type="text" maxlength="1" name="valor4" onkeyUp="javascript:jumpto('valor4','valor5')">
                        <input class="input" type="text" maxlength="1" name="valor5" onkeyUp="javascript:jumpto('valor5','valor1')">
=======
                        <input class="input" type="text" maxlength="1" name="valor1" oninput="moveToNext(this, 'valor2')">
                        <input class="input" type="text" maxlength="1" name="valor2" oninput="moveToNext(this, 'valor3')">
                        <input class="input" type="text" maxlength="1" name="valor3" oninput="moveToNext(this, 'valor4')">
                        <input class="input" type="text" maxlength="1" name="valor4" oninput="moveToNext(this, 'valor5')">
                        <input class="input" type="text" maxlength="1" name="valor5">
>>>>>>> db01d6b224da5ab859cd2eafceab59f6386cd93a
                    </div>
                    <button class="btn1">
                        <a href="areas.php" target="_self" style="text-decoration: none; color: black;"> Enviar </a>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
    $(document).keydown(function () {
        var tecla = event.keyCode;
        if (tecla == 13) {
            window.location.href = 'areas.php'
        }
    })    

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