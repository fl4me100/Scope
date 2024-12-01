<?php
session_start();
if (!isset($_SESSION['id'])) {
    die(json_encode(['success' => false, 'message' => 'Utilizador não está logado.']));
}

$user_id = $_SESSION['id'];
$titulo = $_POST['titulo'];
$poster = $_POST['poster'];
$ano = $_POST['ano'];

$conn = new mysqli('localhost', 'root', '', 'scope');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Erro na conexão com a base de dados.']));
}

$stmt = $conn->prepare("SELECT favorito1, favorito2, favorito3, favorito4 FROM utilizadores WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Lógica para preencher o próximo slot vazio
$favoritos = ['favorito1', 'favorito2', 'favorito3', 'favorito4'];
$campo_vazio = null;

foreach ($favoritos as $campo) {
    if (empty($row[$campo])) {
        $campo_vazio = $campo;
        break;
    }
}

if (!$campo_vazio) {
    die(json_encode(['success' => false, 'message' => 'Já marcou 4 favoritos.']));
}

$update_stmt = $conn->prepare("UPDATE utilizadores SET $campo_vazio = ? WHERE id = ?");
$update_stmt->bind_param("si", $titulo, $user_id);

if ($update_stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar favorito.']);
}
?>
