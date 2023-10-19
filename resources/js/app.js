import './bootstrap';

import { createApp } from 'vue';
import Test from './components/test.vue';

const app = createApp({});

app.component('test-component', Test);

app.mount("#app");
