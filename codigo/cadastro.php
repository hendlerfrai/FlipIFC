<!DOCTYPE html>
<html lang="pt-br">

        <?php
        include "conexao.php";
        ?>
<style>
    /* Reset de estilos para remover margens e preenchimentos padrão */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Defina uma fonte de backup em caso de falha no carregamento da fonte principal */
body {
    font-family: 'Poppins', sans-serif;
}

/* Estilo para o título principal */
h1 {
    font-size: 36px;
    text-align: center;
    margin-top: 20px;
    color: #333;
}

/* Estilo para o formulário de criação de conta */
.formulario {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.formulario h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.formulario label {
    display: block;
    margin-bottom: 10px;
    color: #555;
}

.formulario input[type="text"],
.formulario select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.formulario select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    background-repeat: no-repeat;
    background-position: right center;
    background-size: 16px;
}

/* Estilo para o botão de cadastro */
#jogo input[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

#jogo input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Estilo para o botão "já tenho uma conta" */
.login button {
    background-color: transparent;
    border: none;
    padding: 10px;
    margin-top: 20px;
    cursor: pointer;
}

.login a {
    text-decoration: none;
    color: #007BFF;
}

.login button:hover a {
    text-decoration: underline;
}

</style>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="stylecadastro.css">
    <title> cadastro </title>
</head>

<body>
        <h1> FlipIFC </h1>
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
                    echo '<option value="'. $row['codTurma']. '">'. $row['turma']. '</option>';
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
                    echo '<option value="'. $row['codCidade']. '">'. $row['nomeCidade']. '</option>';
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