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












       /*
        $select_nome = mysqli_query($conn, $query_select_nome);
        $select_cod = mysqli_query($conn, $query_select_cod);
        $select_escola = mysqli_query($conn, $query_select_escola);

        $array_nome = mysqli_fetch_array($select_nome);
        $array_cod = mysqli_fetch_array($select_cod);
        $array_escola = mysqli_fetch_array($select_escola);

        $logarray_nome = $array_nome['nomeUser'];
        $logarray_cod = $array_cod['codAcesso'];

                         // cadastro nome

        if($usuário == "" || $usuário == null){
        echo"<script language='javascript' type='text/javascript'>
        window.alert('O campo usuário deve ser preenchido');</script>";
        }
                            // cadastro código

        else if($código == "" || $código == null){
        echo"<script language='javascript' type='text/javascript'>
        window.alert('O campo código deve ser preenchido');</script>";
        }
        else{
        if($logarray_cod == $código){
            echo"<script language='javascript' type='text/javascript'>
            window.alert('Esse código já está sendo usado');</script>";
        }
        }

                            // instituição

       else{ if($instituição == "" || $instituição == null){
        echo"<script language='javascript' type='text/javascript'>
        window.alert('O campo instituição deve ser preenchido');</script>";
        }
    }else{
            $query = "INSERT INTO usuario (nomeUser, codAcesso) VALUES ('$usuário', '$codigo')";
            $query .= "INSERT INTO escola (nomeEscola) VALUES ('$instituição')";
            $insert = mysqli_query($conn, $query); }


*/
      ?>
