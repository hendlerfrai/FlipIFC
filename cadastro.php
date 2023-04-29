<!DOCTYPE html>
<html lang="pt-br">
<?php
include "conexao.php";
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="stylecadastro.css">
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

    <form method="POST" action="cadastroBack.php" class="conta">

            <h3>criar uma conta</h3>
            <label for="nome"> nome completo: </label>
            <input type="text" id="nome" name="nome">
            <br>
            </br>

            <label for="cod"> código :</label>
            <input type="text" id="cod" name="cod">
            <br> <!-- tirar -->
            </br>

            <label for="escola"> instituição:</label>
            <select name="escola">
                <option>Selecione</option>
                <?php
                $query = "SELECT * FROM escola";
                $result = $conn->query($query);
                while ($row = $result->fetch_array()) {
                    echo '<option value="'. $row['codEscola']. '">'. $row['nomeEscola']. '</option>';
                }
                ?>
            </select>
         <br>
        </br>
            <label for="turma"> turma:</label>
            <select name="turma">
                <option>Selecione</option>
                <?php
                $query = "SELECT * FROM turma";
                $result = $conn->query($query);
                while ($row = $result->fetch_array()) {
                    echo '<option value="'. $row['turma']. '">'. $row['turma']. '</option>';
                }
                ?>
            </select>
        <br>
        </br>

        <!-- banco de dados -->
            <label for="cidade"> cidade:</label>
            <select name="cidade">
                <option>Selecione</option>
                <?php
                $query = "SELECT * FROM cidade";
                $result = $conn->query($query);
                while ($row = $result->fetch_array()) {
                    echo '<option value="'. $row['nomeCidade']. '">'. $row['nomeCidade']. '</option>';
                }
                ?>
            </select>
        <br>
        </br>
       <!-- fim do banco de dados -->

            <div class="col-6 col-md-4" id="jogo">
                <input  type="submit" name="submit" value="Cadastrar">
            </div>

            <div class="login">
                <button class="login">
                    <a href="login.php" target="_blank" style="text-decoration: none;"> já tenho uma conta </a>
                </button>
            </div>
        </form>
    </div>
</body>
</html>