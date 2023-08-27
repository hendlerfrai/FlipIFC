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

<script language="javascript">
    $(document).ready(function() {
        $('.cienciasn').focus();
    });
    $(document).keydown(function () {
        var tecla = event.keyCode;
        console.log(tecla);
        if (tecla == 13) {
		$( "button" ).on( "click", function() {
		  if ($( this ).prop('class') == "matematica") {
	 	       window.location.href = "questaoM.php";
		  }
		  if ($( this ).prop('class') == "cienciasn") {
	 	       window.location.href = "questaoCN.php";
		  }
		});
		
        }
        if (tecla == 40) {
            $('.matematica').focus();
        }
        if (tecla == 37) {
            $('.cienciasn').focus();
        }
    });
</script>
 

<body>

    <h1>Áreas do Conhecimento</h1>
    <div class="container">


        <button class="cienciash">
            <div class="button__line"></div>
            <div class="button__line"></div>
            <span class="button__text"> <a id="a1" href="questaoCH.php" target="_self"
                    style="text-decoration: none; color: #00135C;;">Ciências Humanas</a> </span>
            <div class="button__drow1"></div>
            <div class="button__drow2"></div>
        </button>

        <button class="cienciasn">
            <div class="button__line"></div>
            <div class="button__line"></div>
            <span class="button__text"><a id="a2" href="questaoCN.php" target="_self"
                    style="text-decoration: none; color: #00135C;;">Ciências da Natureza </a> </span>
            <div class="button__drow1"></div>
            <div class="button__drow2"></div>
        </button>

        <button class="linguaport">
            <div class="button__line"></div>
            <div class="button__line"></div>
            <span class="button__text"><a id="a3" href="questaoLP.php" target="_self"
                    style="text-decoration: none; color: #00135C;;">Língua Portuguesa</a> </span>
            <div class="button__drow1"></div>
            <div class="button__drow2"></div>
        </button>

        <button class="matematica">
            <div class="button__line"></div>
            <div class="button__line"></div>
            <span class="button__text"><a id="a4" href="questaoM.php" target="_self"
                    style="text-decoration: none; color: #00135C;;">Matemática</a> </span>
            <div class="button__drow1"></div>
            <div class="button__drow2"></div>
        </button>

    </div>
</body>

</html>