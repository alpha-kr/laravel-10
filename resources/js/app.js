import './bootstrap';
import '../css/app.css';
import App from './Pages/App.vue';
import { createApp } from 'vue';
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import '@mdi/font/css/materialdesignicons.css';
import store from './Store/main'

const vuetify = createVuetify({
    icons: {
        defaultSet: 'mdi', // This is already the default value - only for display purposes
    },
    components,
    directives,
})

createApp(App)
    .use(store)
    .use(vuetify)
    .mount('#app')


