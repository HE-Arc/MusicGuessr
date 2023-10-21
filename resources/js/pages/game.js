import { createApp } from 'vue';
import SearchBar from '../components/search-bar.vue';

const app = createApp({});

app.component('search-bar', SearchBar);

app.mount("#app");
