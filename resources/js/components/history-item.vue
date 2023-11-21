<script setup>
const props = defineProps({
    title: String,
    artist: String,
    album: String,
    year: String,
    genres: Array,
    time: Number
})

function convertMsToMinSec(ms) {
    let min = Math.floor(ms / 60000);
    let sec = ((ms % 60000) / 1000).toFixed(0);
    return min + ":" + (sec < 10 ? '0' : '') + sec;
}

</script>
<template>
    <div class="item-container">
        <p>Titre: {{ title }}</p>
        <p>Artiste: {{ artist }}</p>
        <p>Album: {{ album }}</p>
        <p>Année: {{ year }}</p>
        <p>Genres: <span v-for="genre in genres">{{ genre + ", " }}</span></p>
        <p>Temps: {{ convertMsToMinSec(time) }}</p>
    </div>
</template>

<style lang="scss">
@import '../../css/variables.scss';

.item-container {
    border: 7px solid $magenta-off;
    border-radius: 40px;
    padding: 20px 30px;
    margin-bottom: 20px;
}
</style>
