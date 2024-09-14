import { createApp } from 'vue';
import 'bootstrap/dist/css/bootstrap.min.css';

import FormBuilder from './components/FormBuilder.vue';
import FormRenderer from './components/FormRenderer.vue';


import '../css/app.css';

const app = createApp({});

app.component('form-builder', FormBuilder);
app.component('form-renderer', FormRenderer);

app.mount('#app');
