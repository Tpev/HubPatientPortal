import { createApp } from 'vue';

import FormBuilder from './components/FormBuilder.vue';
import FormRenderer from './components/FormRenderer.vue';

const app = createApp({});

app.component('form-builder', FormBuilder);
app.component('form-renderer', FormRenderer);

app.mount('#app');
