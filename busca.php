<?php
//SE ESSE SCRIPT AJUDOU VOCÊ DE ALGUMA FORMA, ME PAGUE UM CAFEZINHO.
//PIX: 222d4d27-2ae5-4ce0-8f5a-2bb5ed43f6a9
//QUALQUER VALOR AJUDA.

$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtém o parâmetro da busca
$query = isset($_GET['q']) ? $_GET['q'] : '';

$sql = $conn->prepare("SELECT nome FROM produtos WHERE nome LIKE ?");
$searchTerm = "%" . $query . "%";
$sql->bind_param("s", $searchTerm);
$sql->execute();
$result = $sql->get_result();

$results = [];
while ($row = $result->fetch_assoc()) {
    $results[] = $row;
}

echo json_encode($results);

$sql->close();
$conn->close();
?>
