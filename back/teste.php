<?php

require_once "conexao.php";


class Login
{


    public function logar($cod)
    {

        if (empty($cod)) {// campo vazio
            
            echo "preencha ocodigo ";

        } else {// campo cheio 
            

            // query
            $sql = "SELECT * FROM cadastro WHERE codAcesso = $cod";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $email);

            $stmt->execute();

            $dados = $stmt->fetchALL(PDO::FETCH_ASSOC);


                if ($cod == $dados['codigo']) { // senha correta
                    
                    // query
                    $sql = "SELECT * FROM cadastro WHERE codAcesso = $cod";
                    $stmt = Conexao::getConexao()->prepare($sql);
                    $stmt->bindValue(1, $cod);

                    $stmt->execute();

                    $dadosAll = $stmt->fetch(PDO::FETCH_ASSOC);

                    // session
                    session_start();
                    $_SESSION['nome'] = $dadosAll['nome'];
                    $_SESSION['cod'] = $dadosAll['cod'];


                    header("location: index.php");

                } else { // senha incorreta
                    echo '<div id="alert">senha incorreta !!</div>';
                }
        }
    }
}