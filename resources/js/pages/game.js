import { createApp } from 'vue';
import { createPinia } from 'pinia'
import SearchBar from '../components/search-bar.vue';
import Comparaison from '../components/comparaison.vue';

const pinia = createPinia();
const app = createApp({
    data() {
        deltaToSend: {}
    },
    methods: {
        sendDeltaToComparaison(answerData)
        {
            this.deltaToSend = answerData;
        }
    }
});

app.component('search-bar', SearchBar);
app.component('comparaison', Comparaison);

app.use(pinia)
app.mount("#app");
