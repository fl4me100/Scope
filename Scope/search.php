<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Filme na OMDb API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/style1.css" rel="stylesheet">
    <style>
        #resultado .card {
            background-color: #2b2b2b;
            color: #ffffff;
            padding: 20px;
            margin-top: 20px;
            border: none;
        }
        #resultado .card img {
            max-width: 100px;
            margin-right: 15px;
        }
        #resultado .card-title {
            font-size: 24px;
            font-weight: bold;
        }
        #resultado .year {
            font-size: 20px;
            color: #a5a5a5;
            margin-left: 10px;
        }
        #resultado .card-text {
            color: #cccccc;
        }
        .director-label {
            color: #a5a5a5;
            font-size: 16px;
        }
        .director-name {
            font-size: 16px;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>
  <div class="container">
<div class="container-fluid">
  <nav>
	<div class="row">
		<div class="col-md-2">
      <a href="?page=home"><img  src="../imagens/logo.png" alt="logo" id="logo"></a>
		</div>
    <div class="col-md-2 titulos">
      <a href="filmes.php"><h3>Filmes</h3></a>
		</div>
    <div class="col-md-2 titulos">
      <a href="search.php"><h3>Pesquisa</h3></a>
		</div>
</nav>
</div>
    <div class="container">
        <h1>Buscar Filme</h1>
        <label for="titulo" class="form-label">Título do Filme:</label>
        <input type="text" id="titulo" class="form-control" placeholder="Digite o título do filme">
        <button onclick="buscarFilme()" class="btn btn-primary mt-2">Buscar</button>

        <div id="resultado" class="mt-4"></div>
    </div>

    <script>
        async function buscarFilme() {
            const titulo = document.getElementById("titulo").value;
            if (!titulo) {
                document.getElementById("resultado").innerHTML = "<p>Por favor, insira um título de filme.</p>";
                return;
            }

            const apiKey = "dd26c594"; 
            const url = `https://www.omdbapi.com/?apikey=${apiKey}&t=${encodeURIComponent(titulo)}`;

            try {
                const response = await fetch(url);

                if (!response.ok) {
                    throw new Error(`Erro na requisição: ${response.status}`);
                }

                const data = await response.json();

                if (data.Response === "True") {
                    document.getElementById("resultado").innerHTML = `
                        <div class="card d-flex flex-row align-items-start">
                            <img src="${data.Poster}" alt="Poster de ${data.Title}" class="img-fluid">
                            <div>
                                <h2 class="card-title">${data.Title} <span class="year">(${data.Year})</span></h2>
                                <p class="card-text"><strong>Sinopse:</strong> ${data.Plot}</p>
                                <p class="director-label">Directed by <span class="director-name">${data.Director}</span></p>
                            </div>
                        </div>
                    `;
                } else {
                    document.getElementById("resultado").innerHTML = `<p>Filme não encontrado: ${data.Error}</p>`;
                }
            } catch (error) {
                console.error("Erro ao buscar o filme:", error);
                document.getElementById("resultado").innerHTML = `<p>Erro ao buscar o filme: ${error.message}</p>`;
            }
        }
    </script>