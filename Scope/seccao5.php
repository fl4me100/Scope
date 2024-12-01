<?php

$conn = new mysqli('localhost', 'root', '', 'scope');
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else $id="";
// Consulta SQL para selecionar os registos
$sql = "SELECT capa FROM filmes WHERE id LIKE '%".$id."%'";
$result = $conn->query($sql);
?>
<link rel="stylesheet" href="../css/style-filmes.css">
    <div class="container">
        <h1>Galeria de Filmes</h1>
        <div id="movie-grid" class="movie-grid">



  <?php      $sql = "SELECT * FROM filmes WHERE 1 limit 20 OFFSET 80";
$result = $conn->query($sql);


        if ($result->num_rows > 0) {
            while($linha = $result->fetch_assoc()) {
                
                echo "<img id=\"img\" src=\"" . $linha['capa'] . "\" alt=\"\">";
                
            }
        } 


?>
        <button class="btn btn-outline-success" type="submit"><a href="?page=seccao4">Anterior</a></button>
            <span id="pageIndicator">Página 5</span>
    </div>