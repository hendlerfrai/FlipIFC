<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <title> FlipIFC </title>


</head>
<script>
       document.addEventListener("keypress", function (e) {
       if (e.key === "Enter") {
        const btn = document.querySelector("#send");
        btn.click();
        window.location.href="telaloginUsuario.php";
       }
    }); 
    </script>
<body>
        <div class='wrap'>
          <div class='top-plane'></div>
          <div class='bottom-plane'></div>
        </div>

    <div id="logo2">
        <h1 id="F">
            F
        </h1>
        <h1 id="L">
            L
        </h1>
        <h1 id="I">
            I
        </h1>
        <h1 id="P">
            P
        </h1>
        <h1 id="ifc"> IFC </h1>
    </div>
    <button class="btn" id="send">
        <a href="telaloginUsuario.php" target="_self" style="text-decoration: none; color: #3604b5; padding: 5px;"> Pressione enter <br> para iniciar </a>
    </button>

</body>


</html>