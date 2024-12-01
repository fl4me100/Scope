<link href="../css/style1.css" rel="stylesheet">
<style>
        /* Estilos principais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: rgb(2, 0, 36);
            background: radial-gradient(circle, rgba(2, 0, 36, 1) 0%, rgba(0, 0, 0, 1) 30%, rgba(68, 68, 68, 1) 100%);
            background-size: cover;
        }

        .movie-details {
            max-width: 800px;
            margin: 0 auto;
            color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            display: flex;
        }

        .movie-details img {
            max-width: 200px;
            margin-right: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.7);
        }

        .movie-title {
            color: #d1d1d1;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 0;
        }

        .movie-year {
            color: #b3b3b3;
            font-size: 20px;
            margin-left: 8px;
        }

        .movie-info {
            margin-top: 10px;
            font-size: 16px;
        }

        .director, .cast, .genre {
            margin-top: 15px;
            font-size: 15px;
        }

        .movie-info strong {
            color: #007bff;
        }

        .movie-actions {
            display: flex;
            align-items: center;
            margin-top: 15px;
        }

        .action-button {
            background-color: #4b4b4b;
            color: #ffffff;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            margin-right: 10px;
        }

        .action-button:hover {
            background-color: #616161;
        }

        .heart-container {
    --heart-color: rgb(255, 0, 0);
    position: relative;
    width: 30px;
    height: 30px;
    transition: .3s;
    margin-left: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right:20px;
}

.heart-container .checkbox {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%; /* Mantém o checkbox ocupando toda a área do contêiner */
    height: 100%;
    opacity: 0;
    z-index: 20;
    cursor: pointer;
}

.heart-container .svg-container {
    width: 60%; /* Reduz o tamanho do coração para 60% do contêiner */
    height: 60%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.heart-container .svg-outline,
.heart-container .svg-filled {
    fill: var(--heart-color);
    position: absolute;
    width: 100%; /* Define o tamanho do SVG para 100% da svg-container */
    height: 100%;
}

.heart-container .svg-filled {
    animation: keyframes-svg-filled 1s;
    display: none;
}

.heart-container .checkbox:checked ~ .svg-container .svg-filled {
    display: block;
}

@keyframes keyframes-svg-filled {
    0% { transform: scale(0); }
    25% { transform: scale(1.2); }
    50% { transform: scale(1); filter: brightness(1.5); }
}
    </style>
</head>
<body>
</div>
    <div class="container mt-5">
        <div id="movieContent" class="movie-details">
            <!-- Detalhes do filme serão adicionados aqui -->
        </div>
    </div>

    <script>
        // Função para capturar o título do filme da URL
        function getMovieTitleFromURL() {
            const params = new URLSearchParams(window.location.search);
            return params.get("title");
        }

        // Busca e exibe os detalhes do filme
        async function carregarDetalhesDoFilme() {
            const titulo = getMovieTitleFromURL();
            if (!titulo) {
                document.getElementById("movieContent").innerHTML = "<p>Vá à aba \"Filmes\" e digite um filme para saber mais sobre ele.</p>";
                return;
            }

            const apiKey = "dd26c594";
            const url = `https://www.omdbapi.com/?apikey=${apiKey}&t=${encodeURIComponent(titulo)}`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.Response === "True") {
                    document.getElementById("movieContent").innerHTML = `
                        <img src="${data.Poster}" alt="Poster de ${data.Title}">
                        <div>
                            <h2 class="movie-title">${data.Title}<span class="movie-year">(${data.Year})</span></h2>
                            <p class="movie-info"><strong>Sinopse:</strong> ${data.Plot}</p>
                            <p class="director"><strong>Realizado Por:</strong> ${data.Director}</p>
                            <p class="cast"><strong>Elenco:</strong> ${data.Actors}</p>
                            <p class="genre"><strong>Género:</strong> ${data.Genre}</p>
                            <p class="movie-info"><strong>Duração:</strong> ${data.Runtime}</p>
                            <p class="movie-info"><strong>Pontuação:</strong> ${data.imdbRating}/10</p>
                            <div class="movie-actions">
                                <div class="heart-container" title="Like">
                                    <input type="checkbox" class="checkbox" id="heartCheckbox" onclick="salvarLike('${data.Title}')">
                                    <div class="svg-container">
                                        <svg viewBox="0 0 24 24" class="svg-outline" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                    </path>
                </svg>
                <svg viewBox="0 0 24 24" class="svg-filled" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                    </path>
                </svg>
                <svg class="svg-celebrate" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="10,10 20,20"></polygon>
                    <polygon points="10,50 20,50"></polygon>
                    <polygon points="20,80 30,70"></polygon>
                    <polygon points="90,10 80,20"></polygon>
                    <polygon points="90,50 80,50"></polygon>
                    <polygon points="80,80 70,70"></polygon>
                </svg>
                                    </div>
                        </div>
                    `;
                } else {
                    document.getElementById("movieContent").innerHTML = `<p>Erro: ${data.Error}</p>`;
                }
            } catch (error) {
                console.error("Erro ao procurar os detalhes do filme:", error);
                document.getElementById("movieContent").innerHTML = "<p>Erro ao carregar os detalhes do filme.</p>";
            }
        }

        async function salvarLike(titulo) {
    try {
        const response = await fetch('salvar_like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `titulo=${encodeURIComponent(titulo)}`,
        });

        const data = await response.json();
        if (data.success) {
            alert(data.message);
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error("Erro ao guardar nos favoritos:", error);
    }
}


        carregarDetalhesDoFilme();
    </script>