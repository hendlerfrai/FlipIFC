<?php
include('conexao.php');

if(isset($_POST['submit']) && !empty($_POST['nome']) && !empty($_POST['cod']) && !empty($_POST['escola']))
{

    //cadastrar
    $nome = $_POST['nome'];
    $cod = $_POST['cod'];
    $escola = $_POST['escola'];
    $turma = $_POST['turma'];
    $cidade = $_POST['cidade'];


    $sql_cod = "SELECT * FROM cadastro WHERE codAcesso = '$cod'";

    $result = $conn->query($sql_cod);
    if(mysqli_num_rows($result) < 1)
    {

        $sql_dados = "INSERT INTO cadastro (nomeAluno, codAcesso, codTurma, codEscola, codCidade) VALUES ('$nome', '$cod', '$turma', '$escola','$cidade')";

        echo $sql_dados;
        mysqli_query($conn, $sql_dados);
        if(mysqli_affected_rows($conn) > 0) {
            echo '<script type="text/javascript">';
            echo 'alert("Cadastro concluido com sucesso!");';
            echo 'window.location.href = "cadastro.php";';
            echo '</script>';

        }
        mysqli_close($conn);
    }
    else
    {
        mysqli_close($conn);
            echo '<script type="text/javascript">';
            echo 'alert("Esse código já foi cadastrado!");';
            echo 'window.location.href = "cadastro.php";';
            echo '</script>';
    }
 }
 else
 {
     //não cadastra
     mysqli_close($conn);

        echo '<script type="text/javascript">';
        echo 'alert("Informe todos os campos!");';
        echo 'window.location.href = "cadastro.php";';
        echo '</script>';
 }


?>