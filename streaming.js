const title = document.querySelector('.title');
const previa = document.querySelector('.previa');
const playPause = document.querySelector('.playPause');
const proxima = document.querySelector('.proxima');
const audio = document.querySelector('audio');

const songList = [
    {
        path: "Capítulo 4 Versículo 3 - Racionais Mcs.mp3",
        songName: "Capítulo 4, Versículo 3",
    },
    {
        path: "Roberto Carlos - O Calhambeque.mp3",
        songName: "O Calhambeque",
    },
    {
        path: "Tamo Ai Na Atividade.mp3",
        songName: "Tamo Ai Na Atividade",
    },
];

let song_Playing = false;

function playSong() {
    song_Playing = true;
    audio.play();
    playPause.classList.add('active');
    playPause.innerHTML = '<ion-icon name="pause-outline"></ion-icon>';
}

function pauseSong() {
    song_Playing = false;
    audio.pause();
    playPause.classList.remove('active');
    playPause.innerHTML = '<ion-icon name="play-outline"></ion-icon>';
}

// Iniciar ou pausar a música ao clicar
playPause.addEventListener("click", () => (song_Playing ? pauseSong() : playSong()));

// Carregar música
function loadSong(songList) {
    title.textContent = songList.songName;
    audio.src = songList.path;
    audio.load(); // Carrega o novo arquivo de áudio
    audio.addEventListener("canplaythrough", playSong); // Inicia a reprodução após o carregamento completo
}

// Música atual
let i = 0;

// Carregar - Selecionar a primeira música da playlist
loadSong(songList[i]);

// Música anterior
function previaSong() {
    i--;
    if (i < 0) {
        i = songList.length - 1;
    }
    loadSong(songList[i]);
}

previa.addEventListener("click", previaSong);

// Próxima música
function proximaSong() {
    i++;
    if (i > songList.length - 1) {
        i = 0;
    }
    loadSong(songList[i]);
}

proxima.addEventListener("click", proximaSong);
