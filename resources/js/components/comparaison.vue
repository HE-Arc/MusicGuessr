<script setup>
import { ref, watch, toRefs, toRaw } from 'vue';
import axios from 'axios';

const props = defineProps({
    data: Object
})
const { data } = toRefs(props);

const emit = defineEmits(['clear-history'])

const title = ref('');
const indexAlreadyHinted = ref([]);

const artist = ref({
    label: 'Artist ?',
    guessed: false
});

const album = ref({
    label: 'Album ?',
    guessed: false
});

const year = ref({
    label: 'Année ?',
    guessed: false,
    lowerBound: null,
    upperBound: null
});

const genres = ref({
    list: [],
    allGuessed: false,
    nbGuessed: 0
});

const time = ref({
    label: 'Temps ?',
    guessed: false,
    lowerBound: null,
    upperBound: null
});

function resetFields() {
    emit('clear-history');
    title.value = ''

    artist.value.label = 'Artist ?'
    artist.value.guessed = false

    album.value.label = 'Album ?'
    album.value.guessed = false

    year.value.label = 'Année ?'
    year.value.guessed = false
    year.value.lowerBound = null
    year.value.upperBound = null

    genres.value.list = []
    genres.value.allGuessed = false
    genres.value.nbGuessed = 0

    time.value.label = 'Temps ?'
    time.value.guessed = false
    time.value.lowerBound = null
    time.value.upperBound = null
}

function updateFields(comparisonData) {
    // this is related to the backend object strucutre
    // to understand, check Documentation API available at https://github.com/HE-Arc/MusicGuessr/wiki/Documentation-API
    let cp = comparisonData

    // artist
    if (cp.artist_comparison != null) {
        artist.value.label = cp.artist_name
        artist.value.guessed = true
    }

    // album
    if (cp.album_comparison != null) {
        album.value.label = cp.album_name
        album.value.guessed = true
    }

    // year
    if (cp.year_comparison == -1 && (year.value.upperBound == null || year.value.upperBound > cp.year)) {
        year.value.upperBound = cp.year
    }
    else if (cp.year_comparison == 0) {
        year.value.label = cp.year
        year.value.guessed = true
    }
    else if (cp.year_comparison == 1 && (year.value.lowerBound == null || year.value.lowerBound < cp.year)) {
        year.value.lowerBound = cp.year
    }

    if (!year.value.guessed) {
        if (year.value.upperBound != null && year.value.lowerBound != null) {
            year.value.label = "entre " + year.value.lowerBound + " et " + year.value.upperBound
        }
        else if (year.value.upperBound != null) {
            year.value.label = "avant " + year.value.upperBound
        }
        else if (year.value.lowerBound != null) {
            year.value.label = "après " + year.value.lowerBound
        }
    }

    // genres
    if (cp.common_genres.length > 0) {
        for (let i = 0; i < cp.common_genres.length; i++) {
            if (!genres.value.list.includes(cp.common_genres[i].genre_name)) {
                genres.value.list[genres.value.nbGuessed] = cp.common_genres[i].genre_name
                genres.value.nbGuessed += 1
            }
        }
        if (genres.value.nbGuessed == genres.value.list.length) {
            genres.value.allGuessed = true
        }
    }

    // time
    if (cp.duration_ms_comparison == -1 && (time.value.upperBound == null || time.value.upperBound > cp.duration_ms)) {
        time.value.upperBound = cp.duration_ms
    }
    else if (cp.duration_ms_comparison == 0) {
        time.value.label = convertMsToMinSec(cp.duration_ms)
        time.value.guessed = true
    }
    else if (cp.duration_ms_comparison == 1 && (time.value.lowerBound == null || time.value.lowerBound < cp.duration_ms)) {
        time.value.lowerBound = cp.duration_ms
    }

    if (!time.value.guessed) {
        if (time.value.upperBound != null && time.value.lowerBound != null) {
            time.value.label = "entre " + convertMsToMinSec(time.value.lowerBound) + " et " + convertMsToMinSec(time.value.upperBound)
        }
        else if (time.value.upperBound != null) {
            time.value.label = "moins de " + convertMsToMinSec(time.value.upperBound)
        }
        else if (time.value.lowerBound != null) {
            time.value.label = "plus de " + convertMsToMinSec(time.value.lowerBound)
        }
    }

    if (cp.isSame) {
        title.value = cp.name

        endGame()
        redirectToSuccess(cp.name, cp.artist_name, cp.spotify_id)
    }
    else
    {
        // add a clue
        addClueToTitle()
    }
}

async function addClueToTitle() {
    // get random index of title
    let index = Math.floor(Math.random() * title.value.length)

    while (indexAlreadyHinted.value.includes(index)) {
        index = Math.floor(Math.random() * title.value.length)
    }
    indexAlreadyHinted.value.push(index)

    const answer = await axios.post('/hint', {
        index: index
    })

    if (answer.status == 200) {
        title.value = title.value.substring(0, index) + answer.data.hint + title.value.substring(index + 1)
    }
    saveFieldsInLocalStorage()
}

async function redirectToSuccess(title, artist, spotify_id) {
    let urlToRedirect = '/success?title=' + encodeURIComponent(title)
            + '&artist=' + encodeURIComponent(artist)
            + '&spotify_id=' + encodeURIComponent(spotify_id);

    const answer = await axios.post('/nb_tries')
    if (answer.status == 200) {
        urlToRedirect += '&nb_tries=' + encodeURIComponent(answer.data.nb_tries);
    }

    window.location.href = urlToRedirect;
}

function convertMsToMinSec(timeInMs) {
    let minutes = Math.floor(timeInMs / 60000)
    let seconds = ((timeInMs % 60000) / 1000).toFixed(0)
    return minutes + ":" + (seconds < 10 ? '0' : '') + seconds
}


async function startGame() {
    resetFields()

    const answer = await axios.post('/start_game')

    // setup default values
    for (let i = 0; i < answer.data.title_length; i++) {
        title.value += "_"
    }
    localStorage.setItem('title', title.value)

    for (let i = 0; i < answer.data.nb_artist_genre; i++) {
        genres.value.list.push("Genre n°" + (i + 1))
        localStorage.setItem('Genre n°' + i + 1, genres.value.list[i])
    }
    localStorage.setItem('nbGenre', answer.data.nb_artist_genre)

    saveFieldsInLocalStorage()
}

function saveFieldsInLocalStorage()
{
    localStorage.setItem('title', title.value)
    localStorage.setItem('artist', JSON.stringify(artist.value))
    localStorage.setItem('album', JSON.stringify(album.value))
    localStorage.setItem('year', JSON.stringify(year.value))
    localStorage.setItem('genres', JSON.stringify(genres.value))
    localStorage.setItem('time', JSON.stringify(time.value))
}

function fetchFromLocalStorage() {
    title.value = localStorage.getItem('title')

    genres.value.list = []
    for (let i = 0; i < localStorage.getItem('nbGenre'); i++) {
        genres.value.list.push(localStorage.getItem('genres' + i))
    }

    artist.value = JSON.parse(localStorage.getItem('artist'))
    album.value = JSON.parse(localStorage.getItem('album'))
    year.value = JSON.parse(localStorage.getItem('year'))
    genres.value = JSON.parse(localStorage.getItem('genres'))
    time.value = JSON.parse(localStorage.getItem('time'))
}

async function endGame() {
    await axios.post('/end_game')
    localStorage.clear()
    emit('clear-history');
}

function newMusic()
{
    endGame()
    startGame()
}

async function isGameStarted() {
    const answer = await axios.post('/has_game_started')

    if (!answer.data.is_started) {
        startGame()
        return false
    }
    else {
        fetchFromLocalStorage()
        return true
    }
}
isGameStarted()

watch(data, (proxyObject) => {
    updateFields(toRaw(proxyObject))
});
</script>

<template>
    <div>
        <h2>Musique à deviner:</h2>
        <div class="comparison-container neon-effect-magenta rounded">
            <h2 class="music-title neon-text-effect-cyan">{{ title }}</h2>
            <div class="criterions">
                <div class="criterion artist">
                    <div class="icon">
                        <img :src="artist.guessed ? '/img/artist-icon-on.png' : '/img/artist-icon.png'"
                            alt="Icone d'artiste">
                    </div>
                    <p class="name">
                        {{ artist.label }}
                    </p>
                </div>
                <div class="criterion album">
                    <div class="icon">
                        <img :src="album.guessed ? '/img/album-icon-on.png' : '/img/album-icon.png'" alt="Icone d'album">
                    </div>
                    <p class="name">
                        {{ album.label }}
                    </p>
                </div>
                <div class="criterion year">
                    <div class="icon">
                        <img :src="year.guessed ? '/img/year-icon-on.png' : '/img/year-icon.png'" alt="Icone de calendrier">
                    </div>
                    <p class="name">
                        {{ year.label }}
                    </p>
                </div>
                <div class="criterion genres">
                    <div class="icon">
                        <img :src="genres.allGuessed ? '/img/genre-icon-on.png' : '/img/genre-icon.png'" alt="Icone de genre">
                    </div>
                    <ul class="list-genres">
                        <li v-for="genre in genres.list">{{ genre }}</li>
                    </ul>
                </div>
                <div class="criterion time">
                    <div class="icon">
                        <img :src="time.guessed ? '/img/time-icon-on.png' : '/img/time-icon.png'" alt="Icone de temps">
                    </div>
                    <p class="name">
                        {{ time.label }}
                    </p>
                </div>
            </div>
        </div>
        <div class="button-container">
            <button @click="newMusic" class="btn btn-cyan">Nouvelle musique</button>
        </div>
    </div>
</template>

<style lang="scss">
.comparison-container {
    padding: 20px;
}

.music-title {
    text-align: center;
    font-size: 1.7rem;
    word-wrap: break-word;
}

.criterions {
    display: grid;
    grid-template-columns: 1fr;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;

    .icon {
        display: flex;
        justify-content: center;
    }

    .name,
    li {
        text-align: center;
    }
}

.button-container {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}
@media (min-width: 576px) {
    .criterions
    {
        grid-template-columns: repeat(3, 1fr);
    }
}
@media (min-width: 768px) {
    .criterions
    {
        grid-template-columns: repeat(5, 1fr);
    }
}
</style>
