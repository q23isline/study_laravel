// PrimeVue のクイックスタートをそのまま移植
// https://github.com/primefaces/primevue-examples/tree/9176050f621096ed98617bb84d50263364967939/laravel-quickstart
import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';

const app = createApp(App);

app.use(PrimeVue, {
    theme: {
        preset: Aura,
        options: {
            darkModeSelector: '.p-dark'
        }
    }
});


app.mount('#app');
