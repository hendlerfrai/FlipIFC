<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/areas.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title> FlipIFC </title>

</head>
<body>

    <h1>Áreas do Conhecimento</h1>
    <div class="container">

         <button class="cienciash area-button" tabindex="0">
            <div class="button__line"></div>
            <div class="button__line"></div>
            <span class="button__text"> <a id="a1" href="questaoCH.php" target="_self"
                    style="text-decoration: none; color: #00135C;;">Ciências Humanas</a> </span>
            <div class="button__drow1"></div>
            <div class="button__drow2"></div>
        </button>

        <button class="cienciasn area-button" tabindex="0">
            <div class="button__line"></div>
            <div class="button__line"></div>
            <span class="button__text"><a id="a2" href="questaoCN.php" target="_self"
                    style="text-decoration: none; color: #00135C;;">Ciências da Natureza </a> </span>
            <div class="button__drow1"></div>
            <div class="button__drow2"></div>
        </button>

        <button class="linguaport area-button" tabindex="0">
            <div class="button__line"></div>
            <div class="button__line"></div>
            <span class="button__text"><a id="a3" href="questaoLP.php" target="_self"
                    style="text-decoration: none; color: #00135C;;">Língua Portuguesa</a> </span>
            <div class="button__drow1"></div>
            <div class="button__drow2"></div>
        </button>

        <button class="matematica area-button" tabindex="0">
            <div class="button__line"></div>
            <div class="button__line"></div>
            <span class="button__text"><a id="a4" href="questaoM.php" target="_self"
                    style="text-decoration: none; color: #00135C;;">Matemática</a> </span>
            <div class="button__drow1"></div>
            <div class="button__drow2"></div>
        </button>

    </div>
    <script language="javascript">
        $(document).ready(function() {
    var buttons = $('.area-button');
    var currentButtonIndex = 0;
    
    buttons.eq(currentButtonIndex).focus();

    buttons.keydown(function(event) {
        var tecla = event.keyCode;

        if (tecla == 13) {
            var targetUrl = $(this).find('a').attr('href');
            window.location.href = targetUrl;
        } else if (tecla == 40) { // Seta para baixo
            currentButtonIndex = (currentButtonIndex + 2) % buttons.length;
        } else if (tecla == 38) { // Seta para cima
            currentButtonIndex = (currentButtonIndex - 2 + buttons.length) % buttons.length;
        } else if (tecla == 37) { // Seta para esquerda
            currentButtonIndex = (currentButtonIndex - 1 + buttons.length) % buttons.length;
        } else if (tecla == 39) { // Seta para direita
            currentButtonIndex = (currentButtonIndex + 1) % buttons.length;
        }

        buttons.eq(currentButtonIndex).focus();
    });
});
    </script>
</body>

</html>