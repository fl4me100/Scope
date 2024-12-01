<?php

if (!isset($_SESSION['id'])) {
    die("Utilizador não está logado.");
}

$user_id = $_SESSION['id']; 

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
        $foto_perfil_id = $utilizador['foto_perfil'];
    } else {
        die("Utilizador não encontrado.");
    }
} else {
    echo "Erro na execução da consulta: " . $stmt->error;
}

$foto_stmt = $conn->prepare("SELECT icon FROM icons WHERE id = ?");
$foto_stmt->bind_param("i", $foto_perfil_id);
$foto_stmt->execute();
$foto_result = $foto_stmt->get_result();

if ($foto_result->num_rows > 0) {
    $foto = $foto_result->fetch_assoc();
    $foto_url = $foto['icon'];
} else {
    $foto_url = "https://via.placeholder.com/80"; 
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário</title>
    <link href="/css/style1.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: Arial, sans-serif;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .profile-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }

        .section {
            margin-top: 20px;
        }

        .favorite-films img,
        .recent-likes img {
            width: 100%;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .favorite-films img:hover,
        .recent-likes img:hover {
            transform: scale(1.05);
        }

        .reviews {
            background-color: #1e1e1e;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .watchlist,
        .diary {
            background-color: #1e1e1e;
            padding: 15px;
            border-radius: 10px;
        }

        .small-text {
            font-size: 14px;
            color: #a0a0a0;
        }

        .activity-item {
            border-bottom: 1px solid #333;
            padding: 10px 0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .logout-btn {
            background-color: #ff4d4d;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
            width: 40%;
            text-align: center;
        }

        .logout-btn:hover {
            background-color: #ff3333;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header">
            <img src="<?php echo $foto_url; ?>" alt="Foto de Perfil">
            <div>
                
                <p class="small-text"></p>
                <h1><?php echo htmlspecialchars($utilizador['nome']); ?></h1>
                <a href="?page=editar">Editar Perfil</a>
                <a href="?page=eliminar" style="color: red;">Eliminar Conta</a>
            </div>
        </div>

        <div class="section container">
    <h2>Filmes Favoritos</h2>
    <div class="row g-2 favorite-films">
        <?php
        $stmt = $conn->prepare("SELECT `1`, `2`, `3`, `4` FROM utilizadores WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $favoritos = $result->fetch_assoc();
            foreach ($favoritos as $filme) {
                if ($filme) {
                    $apiKey = "dd26c594";
                    $url = "https://www.omdbapi.com/?apikey=$apiKey&t=" . urlencode($filme);
                    $response = file_get_contents($url);
                    $data = json_decode($response, true);

                    if ($data['Response'] === "True") {
                        echo '<div class="col-3">
                                <img src="' . htmlspecialchars($data['Poster']) . '" alt="' . htmlspecialchars($data['Title']) . '">
                                <p>' . htmlspecialchars($data['Title']) . '</p>
                              </div>';
                    } else {
                        echo '<div class="col-3"><p>Erro ao carregar o filme.</p></div>';
                    }
                }
            }
        } else {
            echo '<p>Sem filmes favoritos.</p>';
        }

        $stmt->close();
        ?>
    </div>
</div>
        <form action="logout.php" method="post" class="container">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>