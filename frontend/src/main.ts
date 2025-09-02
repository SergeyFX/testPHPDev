import { createApp } from 'vue'
import PrimeVue from 'primevue/config'
import Aura from '@primeuix/themes/aura';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Row from 'primevue/row';

import App from './App.vue'

// Import PrimeVue styles
//import 'primevue/resources/themes/saga-blue/theme.css';
//import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';

const app = createApp(App);
app.use(PrimeVue, {
    theme: {
        preset: Aura,
        options: {
            prefix: 'p',
            darkModeSelector: 'false',
            cssLayer: false
        }
    }
});


app.mount('#app');
