<template>
  <div class="container">
    <h1>{{ formInstance.formTemplate.title }}</h1>
    <form @submit.prevent="submitForm">
      <!-- Render fields -->
      <!-- ... -->
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['formInstance', 'fields'],
  data() {
    const formData = {};
    this.fields.forEach(field => {
      formData[field.name] = field.default || '';
    });
    return {
      formData,
      errors: {},
    };
  },
  methods: {
    submitForm() {
      axios.post(`/form/${this.formInstance.uuid}`, this.formData)
        .then(response => {
          alert('Form submitted successfully!');
          // Optionally redirect or reset form
        })
        .catch(error => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
            console.error(error);
            alert('An error occurred.');
          }
        });
    },
  },
};
</script>
