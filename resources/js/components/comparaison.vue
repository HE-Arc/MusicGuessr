<script setup>
import { ref, watch, toRefs, toRaw } from 'vue';
import axios from 'axios';

const props = defineProps({
    data: Object
})
const { data } = toRefs(props);

const title = ref('');
const artist = ref('Artist ?');
const artistGuessed = ref(false);

const album = ref('Album ?');
const albumGuessed = ref(false);

const year = ref('Année ?');
const yearGuessed = ref(false);
const yearLowerBound = ref(null);
const yearUpperBound = ref(null);

const genres = ref([]);
const genreGuessed = ref(false);
const nbGenresGuessed = ref(0);

const time = ref('Temps ?');
const timeGuessed = ref(false);
const timeLowerBound = ref(null);
const timeUpperBound = ref(null);

function resetFields() {
    title.value = ''
    artist.value = 'Artist ?'
    album.value = 'Album ?'
    year.value = 'Année ?'
    genres.value = []
    time.value = 'Temps ?'
}

function updateFields(comparisonData) {
    // this is related to the backend object strucutre
    // to understand, check Documentation API available at https://github.com/HE-Arc/MusicGuessr/wiki/Documentation-API

    let cp = comparisonData

    // artist
    if (cp.artist_comparison != null) {
        artist.value = cp.artist_name
        artistGuessed.value = true
    }

    // album
    if (cp.album_comparison != null) {
        album.value = cp.album_name
        albumGuessed.value = true
    }

    // year
    if (cp.year_comparison == -1 && (yearUpperBound.value == null || yearUpperBound.value > cp.year)) {
        yearUpperBound.value = cp.year
    }
    else if (cp.year_comparison == 0) {
        year.value = cp.year
        yearGuessed.value = true
    }
    else if (cp.year_comparison == 1 && (yearLowerBound.value == null || yearLowerBound.value < cp.year)) {
        yearLowerBound.value = cp.year
    }

    if (!yearGuessed.value) {
        if (yearUpperBound.value != null && yearLowerBound.value != null) {
            year.value = "entre " + yearLowerBound.value + " et " + yearUpperBound.value
        }
        else if (yearUpperBound.value != null) {
            year.value = "avant " + yearUpperBound.value
        }
        else if (yearLowerBound.value != null) {
            year.value = "après " + yearLowerBound.value
        }
    }

    // genres
    if (cp.common_genres.length > 0) {
        console.log(genres.value)
        for (let i = 0; i < cp.common_genres.length; i++) {
            if (!genres.value.includes(cp.common_genres[i].genre_name)) {
                genres.value[nbGenresGuessed.value] = cp.common_genres[i].genre_name
                nbGenresGuessed.value += 1
            }
        }
        console.log("nbGenresguessed " + nbGenresGuessed.value)
        console.log("length tab " + genres.value.length)
        if (nbGenresGuessed.value == genres.value.length) {
            genreGuessed.value = true
        }
    }

    // time
    if (cp.duration_ms_comparison == -1 && (timeUpperBound.value == null || timeUpperBound.value > cp.duration_ms)) {
        timeUpperBound.value = cp.duration_ms
    }
    else if (cp.duration_ms_comparison == 0) {
        time.value = convertMsToMinSec(cp.duration_ms)
        timeGuessed.value = true
    }
    else if (cp.duration_ms_comparison == 1 && (timeLowerBound.value == null || timeLowerBound.value < cp.duration_ms)) {
        timeLowerBound.value = cp.duration_ms
    }

    if (!timeGuessed.value) {
        if (timeUpperBound.value != null && timeLowerBound.value != null) {
            time.value = "entre " + convertMsToMinSec(timeLowerBound.value) + " et " + convertMsToMinSec(timeUpperBound.value)
        }
        else if (timeUpperBound.value != null) {
            time.value = "moins de " + convertMsToMinSec(timeUpperBound.value)
        }
        else if (timeLowerBound.value != null) {
            time.value = "plus de " + convertMsToMinSec(timeLowerBound.value)
        }
    }

    if (cp.isSame) {
        // TODO end game, you find the sound
        console.log("GAGNE")
        title.value = cp.name
    }
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
        title.value += "_ "
    }
    localStorage.setItem('title', title.value)

    for (let i = 0; i < answer.data.nb_artist_genre; i++) {
        genres.value.push("Genre n°" + (i + 1))
        localStorage.setItem('genres' + i, genres.value[i])
    }
    localStorage.setItem('nbGenre', answer.data.nb_artist_genre)

    console.log(answer)
}

function fetchFromLocalStorage() {
    title.value = localStorage.getItem('title')
    genres.value = []
    for (let i = 0; i < localStorage.getItem('nbGenre'); i++) {
        genres.value.push(localStorage.getItem('genres' + i))
    }
}

async function endGame() {
    await axios.post('/end_game')
    localStorage.clear()
    startGame()
}

async function gameStarted() {
    const answer = await axios.post('/has_game_started')
    if (!answer.data.is_started) {
        startGame()
    }
    else {
        fetchFromLocalStorage()
    }
}
gameStarted()

watch(data, (proxyObject) => {
    updateFields(toRaw(proxyObject))
});
</script>

<template>
    <div>
        <div class="comparison-container neon-effect-magenta rounded">
            <h2 class="music-title neon-text-effect-cyan">{{ title }}</h2>
            <div class="criterions">
                <div class="criterion artist">
                    <div class="icon">
                        <img :src="artistGuessed ? '/img/artist-icon-on.png' : '/img/artist-icon.png'"
                            alt="Icone d'artiste">
                    </div>
                    <p class="name">
                        {{ artist }}
                    </p>
                </div>
                <div class="criterion album">
                    <div class="icon">
                        <img :src="albumGuessed ? '/img/album-icon-on.png' : '/img/album-icon.png'" alt="Icone d'album">
                    </div>
                    <p class="name">
                        {{ album }}
                    </p>
                </div>
                <div class="criterion year">
                    <div class="icon">
                        <img :src="yearGuessed ? '/img/year-icon-on.png' : '/img/year-icon.png'" alt="Icone de calendrier">
                    </div>
                    <p class="name">
                        {{ year }}
                    </p>
                </div>
                <div class="criterion genres">
                    <div class="icon">
                        <img :src="genreGuessed ? '/img/genre-icon-on.png' : '/img/genre-icon.png'" alt="Icone de genre">
                    </div>
                    <ul class="list-genres">
                        <li v-for="genre in genres">{{ genre }}</li>
                    </ul>
                </div>
                <div class="criterion time">
                    <div class="icon">
                        <img :src="timeGuessed ? '/img/time-icon-on.png' : '/img/time-icon.png'" alt="Icone de temps">
                    </div>
                    <p class="name">
                        {{ time }}
                    </p>
                </div>
            </div>
        </div>
        <div class="button-container">
            <button @click="endGame">Nouvelle musique</button>
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
}

.criterions {
    display: flex;
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

.button-container
{
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
</style>
