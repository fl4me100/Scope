
<style>
	.nav-link.active {
    font-weight: bold;
    color: #ffffff !important;
    background-color: #007bff;
    border-radius: 5px;
}
  nav{
    border-radius: 30px;
    margin-top:20px;
  }

</style>

<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

?>

<div class="container">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="?page=home"><img src="imagens/logo.png" alt="logo" id="logo"></a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="btn <?php echo $page == 'home' ? 'active' : ''; ?>" href="index.php?page=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="btn <?php echo $page == 'filmes' ? 'active' : ''; ?>" href="index.php?page=filmes">Filmes</a>
        </li>
        <li class="nav-item">
            <?php if(isset($_SESSION["nome"]))
            {
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
              }?>
              <a type="button" class="btn" href="?page=perfil"><?php echo htmlspecialchars($_SESSION['nome'])?></a>
              <img id="logonav" src="<?php echo $foto_url; ?>"><?php
            
            } else{
            ?>
            <a class="btn colr" type="button" class="btn btn-primary class_a" data-bs-toggle="modal" data-bs-target="#exampleModal" style="border-color: #e60000;">Entrar</a>
          <?php } ?>
          </li>
      </ul>
    </div>
  </nav>
</div>
