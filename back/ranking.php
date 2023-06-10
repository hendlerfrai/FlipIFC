<?php
include('conexao.php');

// Consulta SQL para obter os dados classificados por pontuação em ordem decrescente
$sql = "SELECT codUser, acertos FROM pontuacao ORDER BY acertos DESC";
$resultado = mysqli_query($conn, $sql);

// Verifica se há registros retornados
if (mysqli_num_rows($resultado) > 0) {
    echo "<h2>Ranking:</h2>";
    echo "<ol>";
    
    // Itera sobre os resultados e exibe as informações dos usuários
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<li>" . $row['codUser'] . " - Pontuação: " . $row['acertos'] . "</li>";
    }
    
    echo "</ol>";
} else {
    echo "Nenhum resultado encontrado.";
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>
