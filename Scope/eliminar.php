<?php
// Iniciar a sessão
session_start();

// Verificar se o utilizador está logado
if (!isset($_SESSION['id'])) {
    die("Utilizador não está logado.");
}

$user_id = $_SESSION['id']; 

// Conectar-se ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'scope');
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Remover os dados do utilizador da tabela 'utilizadores'
$stmt = $conn->prepare("DELETE FROM utilizadores WHERE id = ?");
$stmt->bind_param("i", $user_id);

// Executar a query
if ($stmt->execute()) {
    // Deletar a sessão do utilizador (deslogar)
    session_unset();
    session_destroy();

    // Redirecionar para a página inicial ou página de login
    header("Location: index.php"); // ou página de login
    exit();
} else {
    echo "Erro ao eliminar conta: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
