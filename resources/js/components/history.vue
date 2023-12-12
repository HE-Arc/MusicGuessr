<script setup>
import { ref, watch, toRefs, toRaw, onMounted } from 'vue';
import historyItem from './history-item.vue';

const props = defineProps({
    data: Object
})
const { data } = toRefs(props);
const history = ref([]);
const emit = defineEmits(['clear-history'])

watch(data, (proxyObject) => {
    let music = toRaw(proxyObject)

    history.value.unshift({
        title: music.name,
        artist: music.artist_name,
        album: music.album_name,
        year: music.year,
        genres: music.artist_genres.map(genre => genre.genre_name),
        time: music.duration_ms,
    })
    localStorage.setItem('history', JSON.stringify(history.value))
});

onMounted(() => {
    if (localStorage.getItem('history') != null) {
        history.value = JSON.parse(localStorage.getItem('history'))
    }
})

const clearHistory = () => {
    history.value = []
    localStorage.removeItem('history')
};

defineExpose({ clearHistory })

</script>

<template>
    <div>
        <h2 v-show="history.length > 0">Propositions précédentes:</h2>
        <historyItem v-for="item in history" :title="item.title" :artist="item.artist" :album="item.album" :year="item.year"
            :genres="item.genres" :time="item.time"></historyItem>
    </div>
</template>

<style lang="scss"></style>
