import { createApp } from 'vue';
import SearchBar from '../components/search-bar.vue';
import Comparaison from '../components/comparaison.vue';
import History from '../components/history.vue';

const app = createApp({
    data() {
        return {
            deltaToSend: {}
        }
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
app.component('history', History);

app.mount("#app");
