<?
    #Pontuação
    function coresPts($posicao){
        switch($posicao){
            case 0:
                $cor = "#FFCC00";
                break;
            case 1:
                $cor = "#000000";
                break;
            case 2:
                $cor = "#CCCCCCC";
                break;

        }

        return $cor;

    }

# Buscando pontuação
$rank = mysql_query("SELECT * FROM forum ORDER BY pontos DESC LIMIT 0, 6") or die(mysql_error());

    $i = 0;
    while($row = mysql_fetch_assoc($rank)){
        $i++; 
/*-----------------------------------------------------------------------------------------------------------------------------------------*/
<div style="background: <? echo coresPts($i); ?>;width: 60px;height: 20px;padding: 20px;">
    <?php echo $row['nome']; ?> com <?php echo $row['pontos']; 
</div>

<?php
/**
 * @file getRanking.inc.php
 * Recebe a identificação de um usuário e retorna o seu ranking.
 *
 * @author Paulo Riceli Dias Lelis
 * @more http://pauloriccelli@blogspot.com
 *
 * @param string
 * @return int
**/
function _getRanking( $user_id = null )
{
    $sql = 'SELECT 
            `usuario`, `pontos` 
            FROM 
            `usuarios` ORDER BY `pontos` DESC';
    $query = mysql_query( $sql );
    // inicia o contador
    $cont = 0;

    while( $rows = mysql_fetch_row( $query ) )
    {
        $cont++;
        if( "$rows['0']" === "$user_id" )
        {
	    return $cont;
        }
    }
}
?>

 ?>
 <?php
// um possível trecho de código que mostra uma tela com muitos rankings:

while( $rows = mysql_fetch_array( $query_pagina ) )
{
    $ranking = _getRanking( $rows['id'] );
    echo $rows['nome'] . ' ranking ' . $ranking ;
}
?>