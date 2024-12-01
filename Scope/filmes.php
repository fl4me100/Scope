<style>
        /* Estilo adicional para a área do resultado */
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
        <br>
        <h1>Procurar Filme</h1>
        <input type="text" id="titulo" class="form-control" placeholder="Digite o título do filme"><br>
        <button onclick="buscarFilme()" class="btn">Procurar</button>

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
                                <h2 class="card-title">
    <a href="?page=about&title=${encodeURIComponent(data.Title)}">${data.Title}</a>
    <span class="year">(${data.Year})</span>
</h2>

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
</div>