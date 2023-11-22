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
    <style>
        body {
            background: radial-gradient(circle at 50% 50%, #e4e0d7, #cf3e6f, #5a54c5);
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .formulario {
            width: 420px;
            height: auto;
            border-radius: 15px;
            background-color: rgb(216, 216, 216);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            transition: 0.4s ease-in-out;
            margin: auto;
            padding: 20px;
            text-align: center;
        }

        .formulario:hover {
            box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1);
            transform: scale(0.99);
        }

        .conta {
            position: relative;
        }

        h3 {
            color: black;
            font-weight: bold;
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login {
            text-align: center;
        }

        .login button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: 0.4s ease-in-out;
        }

        .login button:hover {
            background-color: #45a049;
        }

        .btn1 {
            position: relative;
  width: 17em;
  height: 3em;
  border-radius: 5px;
  border: none;
  outline: none;
  transition: 0.4s ease-in-out;
  box-shadow: 1px 1px 3px #b5b5b5, -1px -1px 3px #ffffff;}

        .btn1:active {
            box-shadow: inset 3px 3px 6px #b5b5b5, inset -3px -3px 6px #ffffff;
        }

        .btn1:hover,
        .btn1:focus {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="formulario">
        <form method="POST" action="cadastroBack.php" class="conta" id="formCadastro">
            <h3>Criar uma conta</h3>

            <label for="nome">Nome completo:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="cod">Código:</label>
            <input type="password" id="cod" name="cod" maxlength="5" required>

            <label for="escola">Campus:</label>
            <select name="escola" value="Selecione">
                <option hidden>Selecione</option>
                <?php
                $query = "SELECT * FROM escola";
                $result = $conn->query($query);
                while ($row = $result->fetch_array()) {
                    echo '<option value="' . $row['codEscola'] . '">' . $row['nomeEscola'] . '</option>';
                }
                ?>
            </select>

            <div class="btn" id="jogo">
                <input type="hidden" name="submit" value="Cadastrar">
                <a href="areas.php"></a>
            </div>

            <button class="btn1" type="submit">Cadastrar</button>

            <div class="login">
                <button class="login" onclick="window.location.href='telaloginUsuario.php'">
                    Já tenho uma conta
                </button>
            </div>
        </form>
    </div>

    <script>
        const form = document.getElementById('formCadastro');
        let currentInputIndex = 0;

        document.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowDown') {
                currentInputIndex = (currentInputIndex + 1) % form.elements.length;
                form.elements[currentInputIndex].focus();
            } else if (e.key === 'ArrowUp') {
                currentInputIndex = (currentInputIndex - 1 + form.elements.length) % form.elements.length;
                form.elements[currentInputIndex].focus();
            } else if (e.key === 'Enter') {
                currentInputIndex = (currentInputIndex - 1 + form.elements.length) % form.elements.length;
                form.elements[currentInputIndex].focus();

                // Se for o último input, submit o formulário
                if (currentInputIndex === form.elements.length - 1) {
                    form.submit();
                }
            }
        });
    </script>
</body>

</html>
