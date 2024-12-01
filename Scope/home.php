<main>
    <section class="hero">
        <h1 class="text-center my-4">Filmes em Destaque</h1>
        <div id="filmesCarrossel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://ingresso-a.akamaihd.net/prd/img/movie/batman/77547685-09f7-4297-bb9c-5884577b0b22.jpg" 
                         class="d-block w-100" 
                         alt="The Batman" 
                         style="object-fit: cover; max-height: 500px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>The Batman (2022)</h5>
                        <p>Bruce Wayne luta contra o crime e enfrenta enigmas do Joker, descobrindo segredos de Gotham City.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://media.vanityfair.com/photos/65bc53b6dbcc8f7a911121f8/master/pass/DUN2-T3-0084r.jpg" 
                         class="d-block w-100" 
                         alt="Dune" 
                         style="object-fit: cover; max-height: 500px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Dune (2021)</h5>
                        <p>Paul Atreides viaja para o perigoso planeta Arrakis para salvar o futuro da sua família e do seu povo.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://static1.srcdn.com/wordpress/wp-content/uploads/2022/12/avatar-the-way-of-water-1-1.jpg" 
                         class="d-block w-100" 
                         alt="Avatar: The Way of Water" 
                         style="object-fit: cover; max-height: 500px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Avatar: The Way of Water (2022)</h5>
                        <p>Jake Sully e a sua família enfrentam ameaças em Pandora enquanto exploram o misterioso mundo aquático.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://m.media-amazon.com/images/S/pv-target-images/81d381a05f489e825309512dcdd20ea4b2f5f77d6f78cf8aea0fddc3fbafcbfe._SX1080_FMjpg_.jpg" 
                         class="d-block w-100" 
                         alt="Spider-Man: No Way Home" 
                         style="object-fit: cover; max-height: 500px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Spider-Man: No Way Home (2021)</h5>
                        <p>Com a sua identidade revelada, Peter Parker pede ajuda ao Doutor Estranho, mas o feitiço não funciona.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://fiocondutor.com.pt/wp-content/uploads/2022/05/TOPGUNMAVERICK_banner.jpg" 
                         class="d-block w-100" 
                         alt="Top Gun: Maverick" 
                         style="object-fit: cover; max-height: 500px;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Top Gun: Maverick (2022)</h5>
                        <p>Após 30 anos, Maverick retorna para treinar uma nova geração de pilotos numa missão perigosa.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#filmesCarrossel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#filmesCarrossel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div>
    </section>

    <section class="recent-films mt-5">
        <h3 class="text-center">Recentes e Bem Avaliados</h2>
        <div class="container">
            <div class="row" id="filmes-grid">
            </div>
        </div>
    </section>
</main>

<script>
    const apiKey = "dd26c594";

    const filmesDestaque = ["The Batman", "Dune", "Avatar: The Way of Water", "Spider-Man: No Way Home", "Top Gun: Maverick"];
    const filmesRecentes = ["Oppenheimer", "Spider-Man: Across the Spider-Verse", "Civil War", "Dune: Part Two", "The Penguin", "Anora"];

    async function carregarCarrossel() {
        const carouselContent = document.getElementById("carousel-content");

        for (let i = 0; i < filmesDestaque.length; i++) {
            const titulo = filmesDestaque[i];
            const url = `https://www.omdbapi.com/?apikey=${apiKey}&t=${encodeURIComponent(titulo)}`;
            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.Response === "True") {
                    const activeClass = i === 0 ? "active" : "";
                    carouselContent.innerHTML += `
                        <div class="carousel-item ${activeClass}">
                            <img src="${data.Poster}" class="d-block w-100" alt="${data.Title}" style="object-fit: cover; max-height: 500px;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>${data.Title} (${data.Year})</h5>
                                <p>${data.Plot || "Sinopse não disponível."}</p>
                            </div>
                        </div>
                    `;
                } else {
                    console.error(`Erro ao carregar o filme: ${titulo}`);
                }
            } catch (error) {
                console.error(`Erro na requisição: ${error.message}`);
            }
        }
    }

    async function carregarFilmesRecentes() {
        const filmesGrid = document.getElementById("filmes-grid");

        for (let titulo of filmesRecentes) {
            const url = `https://www.omdbapi.com/?apikey=${apiKey}&t=${encodeURIComponent(titulo)}`;
            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.Response === "True") {
                    filmesGrid.innerHTML += `
                        <div class="col-md-4 mb-4">
                            <div class="card bg-dark text-light">
                                <img src="${data.Poster}" class="card-img-top" alt="${data.Title}" style="object-fit: cover; max-height: 400px;">
                                <div class="card-body">
                                    <h5 class="card-title">${data.Title}</h5>
                                    <p class="card-text">${data.Plot ? data.Plot.substring(0, 100) + "..." : "Sinopse não disponível."}</p>
                                    <p><strong>Avaliação:</strong> ${data.imdbRating || "N/A"} ⭐</p>
                                    <a href="?page=about&title=${encodeURIComponent(data.Title)}" <button class="btn">Saiba Mais </button></a>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    console.error(`Erro ao carregar o filme: ${titulo}`);
                }
            } catch (error) {
                console.error(`Erro na requisição: ${error.message}`);
            }
        }
    }

    // Chamar as funções ao carregar a página
    document.addEventListener("DOMContentLoaded", () => {
        carregarCarrossel();
        carregarFilmesRecentes();
    });
</script>
