<?php
session_start();
include('conexao.php');
require('verifica.php');

$email = $_SESSION['email'];
$sqlUserId = "SELECT iduser FROM usuario WHERE email = '$email'";
$resultUserId = mysqli_query($conn, $sqlUserId);
$rowUserId = mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['iduser'];

// Consulta SQL para obter os dados do usuário
$sqlUserData = "SELECT * FROM usuario WHERE iduser = $userId";
$resultUserData = mysqli_query($conn, $sqlUserData);
$rowUserData = mysqli_fetch_assoc($resultUserData);

// Inicializa as variáveis
$mensagem = "";
$selectedOption = "";
$row = array();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedOption = $_POST["resposta"];
    $idQuestao = $_POST["id_questao"];

    $sql = "SELECT * FROM questao WHERE idquest = $idQuestao";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $respostaCorreta = $row['resultado'];

        if ($selectedOption === null) {
            echo "<script>
                    alert('Selecione uma opção!');
                    window.history.back();
                  </script>";
        } else {
            if ($selectedOption == $respostaCorreta) {
                $mensagem = "Resposta correta!";
$userId = $rowUserId['iduser'];
                $query = "UPDATE usuario SET acertos = acertos + 1 WHERE iduser = $userId";
            } else {
                $mensagem = "Você errou. A resposta correta é " . $respostaCorreta ."° alternativa " ;
                $query = "UPDATE usuario SET erros = erros + 1 WHERE iduser = $userId";
            }
            if ($conn->query($query) === TRUE) {
                echo "Pontuação atualizada com sucesso.";
            } else {
                echo "Erro ao atualizar pontuação: " . $conn->error;
            }
            
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <title>Verificação de Resposta</title>
    <style>
        body {
            background-color: #081b29;
            color: white;
            padding-top: 80px;
        }

        .navbar-fixed {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: brown;
        }

        .navbar-brand {
            color: #081b29;
        }

        .nav-link {
            color: #081b29;
        }

        .dropdown-menu {
            background-color: #F4F4F4;
        }

        .resultado {
            text-align: center;
        } 
    </style>
</head>

<body>

    <header class="header navbar-fixed">
        <nav class="navbar navbar-expand-lg navbar-blue p-1 m-2">
            <div class="container">
                <a href="#" class="navbar-brand"><i class="bi bi-joystick"></i>FlipEnem</a>


                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="nav col-12 mb-2 justify-content-end mb-md-0">
                        <li class="nav-item"><a href="index.php" class="nav-link px-2 link-body-emphasis bi bi-house-fill"> Home</a></li>
                        <li class="nav-item"><a href="feed.php" class="nav-link px-2 link-body-emphasis bi bi-chat-dots-fill"> Feedback</a></li>
                        <li class="nav-item"><a href="sobreprojeto.php" class="nav-link px-2 link-body-emphasis bi bi-device-ssd-fill"> Sobre o projeto</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <div class="container">
    <div class="resultado">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 principal" style="background-color: rgba(0, 0, 0, 0.5); padding: 20px;">
                <?php echo $mensagem; ?>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="caixa-informacoes">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 principal" style="background-color: rgba(0, 0, 0, 0.5); padding: 20px;">
                    <strong>Alternativa selecionada:</strong>
                    <?php echo isset($row['quest' . $selectedOption]) ? $row['quest' . $selectedOption] : ''; ?>
                </div>
                <div class="col-md-3"></div>
            </div>
            
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 principal" style="background-color: rgba(0, 0, 0, 0.5); padding: 20px;">
                    <strong>Alternativa correta:</strong>
                    <?php echo isset($row['quest' . $respostaCorreta]) ? $row['quest' . $respostaCorreta] : ''; ?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

        <div class="botoes">
            <a href="jogar.php" class="btn btn-primary">Jogar Novamente</a>
        </div>
    </div>
</div>

<?php
$email = $_SESSION['email'];
$sqlUserId = "SELECT iduser FROM usuario WHERE email = '$email'";
$resultUserId = mysqli_query($conn, $sqlUserId);
$rowUserId = mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['iduser'];

// Consulta SQL para obter os dados do usuário
$sqlUserData = "SELECT * FROM usuario WHERE iduser = $userId";
$resultUserData = mysqli_query($conn, $sqlUserData);
$rowUserData = mysqli_fetch_assoc($resultUserData);

// Inicializa as variáveis
$mensagem = "";
$selectedOption = "";
$row = array();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedOption = $_POST["resposta"];
    $idQuestao = $_POST["id_questao"];

    $sql = "SELECT * FROM questao WHERE idquest = $idQuestao";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $respostaCorreta = $row['resultado'];

        if ($selectedOption === null) {
            echo "<script>
                    alert('Selecione uma opção!');
                    window.history.back();
                  </script>";
        } else {
            if ($selectedOption == $respostaCorreta) {
                $mensagem = "Resposta correta!";
$userId = $rowUserId['iduser'];
                $query = "UPDATE usuario SET acertos = acertos + 1 WHERE iduser = $userId";
            } else {
                $mensagem = "Você errou. A resposta correta é " . $respostaCorreta ."° alternativa " ;
                $query = "UPDATE usuario SET erros = erros + 1 WHERE iduser = $userId";
            }
            if ($conn->query($query) === TRUE) {
                echo "Pontuação atualizada com sucesso.";
            } else {
                echo "Erro ao atualizar pontuação: " . $conn->error;
            }
            
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="estilos.css">
    <title>Verificação de Resposta</title>
    <style>
        body {
            background-color: #081b29;
            color: white;
            padding-top: 80px;
        }

        .navbar-fixed {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: brown;
        }

        .navbar-brand {
            color: #081b29;
        }

        .nav-link {
            color: #081b29;
        }

        .dropdown-menu {
            background-color: #F4F4F4;
        }

        .resultado {
            text-align: center;
        } 
    </style>
</head>

<body>

    <header class="header navbar-fixed">
        <nav class="navbar navbar-expand-lg navbar-blue p-1 m-2">
            <div class="container">
                <a href="#" class="navbar-brand"><i class="bi bi-joystick"></i>FlipEnem</a>


                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="nav col-12 mb-2 justify-content-end mb-md-0">
                        <li class="nav-item"><a href="index.php" class="nav-link px-2 link-body-emphasis bi bi-house-fill"> Home</a></li>
                        <li class="nav-item"><a href="feed.php" class="nav-link px-2 link-body-emphasis bi bi-chat-dots-fill"> Feedback</a></li>
                        <li class="nav-item"><a href="sobreprojeto.php" class="nav-link px-2 link-body-emphasis bi bi-device-ssd-fill"> Sobre o projeto</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <div class="container">
    <div class="resultado">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 principal" style="background-color: rgba(0, 0, 0, 0.5); padding: 20px;">
                <?php echo $mensagem; ?>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="caixa-informacoes">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 principal" style="background-color: rgba(0, 0, 0, 0.5); padding: 20px;">
                    <strong>Alternativa selecionada:</strong>
                    <?php echo isset($row['quest' . $selectedOption]) ? $row['quest' . $selectedOption] : ''; ?>
                </div>
                <div class="col-md-3"></div>
            </div>
            
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 principal" style="background-color: rgba(0, 0, 0, 0.5); padding: 20px;">
                    <strong>Alternativa correta:</strong>
                    <?php echo isset($row['quest' . $respostaCorreta]) ? $row['quest' . $respostaCorreta] : ''; ?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>

        <div class="botoes">
            <a href="jogar.php" class="btn btn-primary">Jogar Novamente</a>
        </div>
    </div>
</div>
