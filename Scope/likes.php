<script>
async function carregarLikes() {
    try {
        const response = await fetch('listar_likes.php');
        const data = await response.json();

        if (data.success) {
            const likesContainer = document.getElementById("likesContainer");
            likesContainer.innerHTML = "";

            data.filmes.forEach(filme => {
                const filmeElement = document.createElement("div");
                filmeElement.className = "liked-item";
                filmeElement.innerHTML = `
                    <img src="${filme.poster}" alt="Poster de ${filme.titulo}" class="liked-poster">
                    <div>
                        <h3>${filme.titulo}</h3>
                        <p>Ano: ${filme.ano}</p>
                    </div>
                `;
                likesContainer.appendChild(filmeElement);
            });
        } else {
            console.error("Erro ao carregar likes:", data.message);
        }
    } catch (error) {
        console.error("Erro ao carregar likes:", error);
    }
}
carregarLikes()
</script>