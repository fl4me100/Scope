<?php
session_start();

if (!isset($_SESSION['id'])) {
    die(json_encode(['success' => false, 'message' => 'Faça login para adicionar aos favoritos.']));
}

$user_id = $_SESSION['id'];
$titulo = $_POST['titulo'] ?? null;
$poster = $_POST['poster'] ?? null;
$ano = $_POST['ano'] ?? null;

if (!$titulo) {
    die(json_encode(['success' => false, 'message' => 'Título do filme é obrigatório.']));
}

$conn = new mysqli('localhost', 'root', '', 'scope');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Erro ao conectar à base de dados.']));
}

$stmt = $conn->prepare("SELECT `1`, `2`, `3`, `4` FROM utilizadores WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $favoritos = [$row['1'], $row['2'], $row['3'], $row['4']];

    if (in_array($titulo, $favoritos)) {
        echo json_encode(['success' => false, 'message' => 'Este filme já está nos favoritos.']);
        exit;
    }

    $posicao_livre = array_search(null, $favoritos);

    if ($posicao_livre === false) {
        echo json_encode(['success' => false, 'message' => 'Você já tem 4 filmes favoritos.']);
        exit;
    }

    $coluna = $posicao_livre + 1; // Ajustar índice para a coluna correspondente
    $update_stmt = $conn->prepare("UPDATE utilizadores SET `$coluna` = ? WHERE id = ?");
    $update_stmt->bind_param("si", $titulo, $user_id);

    if ($update_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Filme adicionado aos favoritos!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar o filme favorito.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Utilizador não encontrado.']);
}

$stmt->close();
$conn->close();
?>
