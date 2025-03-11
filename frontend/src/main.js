import './assets/main.css'

import { createApp } from 'vue';
import App from './App.vue';
// import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.css';
import { createVuetify } from 'vuetify';
import * as components from "vuetify/components";

import axios from './plugins/axios';


const app = createApp(App);

const vuetify = createVuetify({components});

app.use(vuetify);

app.config.globalProperties.$axios = axios;

app.mount('#app');
