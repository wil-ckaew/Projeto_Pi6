<?php
// Conex�o com o banco de dados
$conn = mysqli_connect("", "", "", "");

// Verifica se a conex�o foi estabelecida com sucesso
if (!$conn) {
    die("Falha na conex�o com o banco de dados: " . mysqli_connect_error());
}

// Consulta SQL para recuperar os �ltimos registros de temperatura
$sql = "SELECT time, temperature FROM esp32_table_dht11_leds_record ORDER BY date DESC, time DESC LIMIT 30";

// Execute a consulta SQL
$result = mysqli_query($conn, $sql);

// Inicialize uma matriz para armazenar os dados de temperatura
$temperatureData = array();

// Verifica se a consulta foi bem-sucedida e se h� pelo menos um registro retornado
if ($result && mysqli_num_rows($result) > 0) {
    // Loop atrav�s dos resultados e armazena os dados de temperatura na matriz
    while ($row = mysqli_fetch_assoc($result)) {
        $temperatureData[] = $row;
    }
}

// Converte a matriz $temperatureData em JSON e imprime
echo json_encode($temperatureData);
?>
