<?php
if (!isset($_SESSION['id'])) {
    die("Utilizador não está logado.");
}

$user_id = $_SESSION['id']; 

// Conexão ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'scope');
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT nome, email, foto_perfil FROM utilizadores WHERE id = ?");
$stmt->bind_param("i", $user_id);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $utilizador = $result->fetch_assoc();
    } else {
        die("Utilizador não encontrado.");
    }
} else {
    echo "Erro na execução da consulta: " . $stmt->error;
}

$icons_stmt = $conn->prepare("SELECT id, icon FROM icons");
$icons_stmt->execute();
$icons_result = $icons_stmt->get_result();

// Processar o formulário de atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $foto_perfil_id = $_POST['foto_perfil']; 

    // Validar os dados
    if (empty($nome) || empty($email)) {
        echo "Todos os campos são obrigatórios.";
    } else {
        $update_stmt = $conn->prepare("UPDATE utilizadores SET nome = ?, email = ?, foto_perfil = ? WHERE id = ?");
        
        if ($update_stmt === false) {
            echo "Erro ao preparar a consulta de atualização: " . $conn->error;
        } else {
            $update_stmt->bind_param("ssii", $nome, $email, $foto_perfil_id, $user_id);
            
            // Executar a consulta
            if ($update_stmt->execute()) {
                $_SESSION['nome'] = $nome;
                $_SESSION['foto_perfil'] = $foto_perfil_id; 

                header('Location: index.php?page=perfil');
                exit();
            } else {
                echo "Erro ao atualizar perfil: " . $update_stmt->error;
            }
        }

        $update_stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #333;
            background-color: #2a2a2a;
            color: white;
        }

        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #6200ea;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #3700b3;
        }

        .select-icon-btn {
            padding: 10px 20px;
            background-color: #6200ea;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .select-icon-btn:hover {
            background-color: #3700b3;
        }

        .icons-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .icons-container img {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            cursor: pointer;
            border: 3px solid transparent;
            transition: transform 0.3s ease, border 0.3s ease;
        }

        .icons-container img:hover {
            transform: scale(1.1);
        }

        .icons-container img.selected {
            border-color: #6200ea;
            box-shadow: 0 0 10px rgba(98, 0, 234, 0.8);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Perfil</h1>
        <form method="post" action="">
            <div class="form-group">
                Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($utilizador['nome']); ?>"><br><br>
            </div>
            <div class="form-group">
                Email: <input type="email" name="email" value="<?php echo htmlspecialchars($utilizador['email']); ?>"><br><br>
            </div>

            <h3>Foto de Perfil:</h3>
            <div class="icons-container">
                <?php while ($icon = $icons_result->fetch_assoc()): ?>
                    <label>
                        <input type="radio" name="foto_perfil" value="<?php echo $icon['id']; ?>" 
                               <?php echo ($utilizador['foto_perfil'] == $icon['id']) ? 'checked' : ''; ?> class="icon-option">
                               
                        <img src="<?php echo $icon['icon']; ?>" alt="Ícone" class="icon-option-img" data-id="<?php echo $icon['id']; ?>">
                    </label>
                <?php endwhile; ?>
            </div>

            <br><br>
            <input type="submit" class="btn" value="Atualizar">
        </form>
    </div>

    <script>
        // Adicionar evento para selecionar ícones
        document.querySelectorAll('.icon-option-img').forEach(function(img) {
            img.addEventListener('click', function() {
                document.querySelectorAll('.icon-option-img').forEach(function(i) {
                    i.classList.remove('selected');
                });
                img.classList.add('selected');
                document.querySelector(`input[name="foto_perfil"][value="${img.getAttribute('data-id')}"]`).checked = true;
            });
        });
    </script>
</body>
</html>

<?php
// Fechar conexões
$stmt->close();
$icons_stmt->close();
$conn->close();
?>