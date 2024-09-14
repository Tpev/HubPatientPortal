<template>
  <div class="container">
    <h1>{{ form.title }}</h1>
    <form @submit.prevent="submitForm" :enctype="hasFile ? 'multipart/form-data' : null">
      <div v-for="(field, index) in fields" :key="index" class="form-group">
        <label :for="field.name">{{ field.label }}</label>
        <component :is="getFieldComponent(field)"
                   v-model="formData[field.name]"
                   :field="field"
                   :errors="errors">
        </component>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
import InputField from './fields/InputField.vue';
import CheckboxField from './fields/CheckboxField.vue';
import RadioField from './fields/RadioField.vue';
import FileField from './fields/FileField.vue';

export default {
  props: ['form', 'fields'],
  components: {
    InputField,
    CheckboxField,
    RadioField,
    FileField,
  },
  data() {
    const formData = {};
    const hasFile = this.fields.some(field => field.type === 'file');
    this.fields.forEach(field => {
      formData[field.name] = field.default || '';
    });
    return {
      formData,
      errors: {},
      hasFile,
    };
  },
  methods: {
    getFieldComponent(field) {
      switch (field.type) {
        case 'text':
        case 'email':
        case 'number':
          return 'InputField';
        case 'checkbox':
          return 'CheckboxField';
        case 'radio':
          return 'RadioField';
        case 'file':
          return 'FileField';
        default:
          return 'InputField';
      }
    },
    submitForm() {
      const formData = new FormData();
      for (const key in this.formData) {
        formData.append(key, this.formData[key]);
      }

      axios.post(window.location.pathname, formData)
        .then(response => {
          alert('Form submitted successfully!');
          // Optionally, redirect or reset the form
        })
        .catch(error => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          } else {
            console.error(error);
            alert('An error occurred while submitting the form.');
          }
        });
    },
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
