<template>
  <div class="container">
    <h1>Create a New Form</h1>
    <form @submit.prevent="submitForm">
      <!-- Form Title -->
      <div class="form-group">
        <label for="title">Form Title</label>
        <input v-model="form.title" type="text" class="form-control" required>
      </div>

      <!-- Dynamic Form Fields -->
      <h3 className="mt-4">Form Fields</h3>
      <div v-for="(field, index) in form.fields" :key="index" class="mb-4">
        <div class="form-group">
          <label>Field Label</label>
          <input v-model="field.label" type="text" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Field Name</label>
          <input v-model="field.name" type="text" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Field Type</label>
          <select v-model="field.type" class="form-control">
            <option value="text">Text</option>
            <option value="email">Email</option>
            <option value="number">Number</option>
            <option value="checkbox">Checkbox</option>
            <option value="radio">Radio Button</option>
            <option value="file">File Upload</option>
          </select>
        </div>
        <div class="form-group" v-if="field.type === 'radio' || field.type === 'checkbox'">
          <label>Options (comma-separated)</label>
          <input v-model="field.options" type="text" class="form-control" placeholder="Option1, Option2, Option3">
        </div>
        <div class="form-group">
          <label>Placeholder</label>
          <input v-model="field.placeholder" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label>Default Value</label>
          <input v-model="field.default" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label>Validation Rules</label>
          <input v-model="field.validation" type="text" class="form-control" placeholder="e.g., required|min:5">
        </div>
        <button type="button" class="btn btn-danger mt-2" @click="removeField(index)">Remove Field</button>
        <hr>
      </div>
      <button type="button" class="btn btn-secondary mt-2" @click="addField">Add Field</button>
      <button type="submit" class="btn btn-success mt-3">Create Form</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        title: '',
        fields: [],
      },
    };
  },
  methods: {
    addField() {
      this.form.fields.push({
        label: '',
        name: '',
        type: 'text',
        placeholder: '',
        default: '',
        validation: '',
        options: '',
      });
    },
    removeField(index) {
      this.form.fields.splice(index, 1);
    },
    submitForm() {
      axios.post('/admin/forms', this.form)
        .then(response => {
          alert('Form created successfully!');
          // Optionally, redirect or reset the form
        })
        .catch(error => {
          console.error(error);
          alert('An error occurred while creating the form.');
        });
    },
  },
};
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
