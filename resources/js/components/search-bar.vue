<script setup>
import { ref } from 'vue';
import axios from 'axios';

const emit = defineEmits(['send-comparaison'])
const userInput = ref('');
let songs = ref([]);
let focusIndex = ref(0);

async function getSongs(userInput) {
    if (userInput.length < 2) {
        songs.value = []
        focusIndex.value = -1
        return
    }
    const answer = await axios.get('/song_beginning_with/' + userInput)
    if (answer.data.length > 0) {
        songs.value = answer.data
        focusIndex.value = 0
    } else {
        songs.value = []
        focusIndex.value = -1
    }
}

async function sendProposition(songId) {
    const answer = await axios.post('/comparison_with_answer_song/', {
        song_id: songId
    })
    emit('send-comparaison', answer.data);

    songs.value = [];
    focusIndex.value = -1;
    userInput.value = '';
}
</script>

<template>
    <div class="input-container">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px" id="search-icon">
            <path fill="white"
                d="M 21 3 C 11.601563 3 4 10.601563 4 20 C 4 29.398438 11.601563 37 21 37 C 24.355469 37 27.460938 36.015625 30.09375 34.34375 L 42.375 46.625 L 46.625 42.375 L 34.5 30.28125 C 36.679688 27.421875 38 23.878906 38 20 C 38 10.601563 30.398438 3 21 3 Z M 21 7 C 28.199219 7 34 12.800781 34 20 C 34 27.199219 28.199219 33 21 33 C 13.800781 33 8 27.199219 8 20 C 8 12.800781 13.800781 7 21 7 Z" />
        </svg>
        <input v-model="userInput" id="search-bar" @input="getSongs(userInput)"
            v-on:keyup.enter="songs.length > 0 ? sendProposition(songs[focusIndex].id) : null"
            v-on:keydown.arrow-up="focusIndex > 0 ? focusIndex-- : null"
            v-on:keydown.arrow-down="focusIndex < songs.length - 1 ? focusIndex++ : null" class="neon-effect-cyan-off"
            v-on:keydown.escape="songs = []"
            type="text" @focusout="focusIndex = -1" placeholder="Taper le nom d'une musique">
        <ul class="propositions-list">
            <li v-for="song, key in songs" @click="sendProposition(song.id)"
            @mouseover="focusIndex = key"
            @mouseleave="focusIndex = -1"
            :class="{hover: focusIndex == key}">"{{ song.track_name }}" de {{ song.artist_name }},
                sorti en {{
                    song.year }}</li>
        </ul>
    </div>
</template>

<style lang="scss">
@import '../../css/variables.scss';

.input-container {
    position: relative;
}

#search-icon {
    position: absolute;
    top: 20px;
    left: 27px;
    width: 20px;
    height: 20px;
    fill: white;
}

#search-bar {
    width: 100%;
    padding: 10px 15px 12px 55px;
    border-radius: 40px;

    &::placeholder {
        color: white;
    }
}

.propositions-list {
    max-height: 30vh;
    overflow: auto;
    position: absolute;
    background-color: rgba($color: $background, $alpha: .9);
    border-radius: 10px;
    width: 100%;

    li {
        padding: 5px 10px;
        cursor: pointer;

        &.hover {
            background-color: #1a1a1a;
        }
    }
}
</style>
