function buscarArtistas(artista) {
    // Variáveis para armazenar os elementos HTML
    var nameElement = document.getElementById("name");
    var pictureElement = document.getElementById("picture");
    var titleElement = document.getElementById("title");

    // Limpar os elementos HTML
    nameElement.innerHTML = "";
    pictureElement.src = "";
    titleElement.innerHTML = "";

    // Requisição AJAX
    $.ajax({
        url: 'https://deezerdevs-deezer.p.rapidapi.com/search?q=' + encodeURIComponent(artista),
        headers: {
            'X-RapidAPI-Key': '3a01963fc7msh3fff38559614987p1230c5jsnabaf6498e8b1',
            'X-RapidAPI-Host': 'deezerdevs-deezer.p.rapidapi.com'
        },
        success: function(response) {
            console.log(response);

            var artistName = response.data[0].artist.name; // Obtém o nome do primeiro artista

            nameElement.innerHTML = "Nome do Artista: " + artistName + "<br>"; // Imprime o nome do artista

            for (var i = 0; i < 10; i++) {
                var pictureURL = response.data[i].artist.picture_medium;
                var songTitle = response.data[i].title;

                pictureElement.src = pictureURL;
                titleElement.innerHTML += "<aside># " + (i + 1) + ": " + songTitle + "</aside><br>";
            }
        },
        error: function() {
            console.error("Ocorreu um erro na requisição.");
        }
    });
}
