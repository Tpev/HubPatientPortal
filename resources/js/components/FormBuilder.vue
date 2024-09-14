<template>
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-header bg-info text-white">
        <h2 class="mb-0">Create a New Patient Form</h2>
      </div>
      <div class="card-body">
        <form @submit.prevent="submitForm">
          <!-- Form Title -->
          <div class="mb-4">
            <label for="title" class="form-label fw-bold">Form Title</label>
            <input
              v-model="form.title"
              type="text"
              id="title"
              class="form-control"
              placeholder="Enter the form title"
              required
            />
          </div>

          <!-- Dynamic Form Fields -->
          <h4 class="fw-bold mt-5">Form Fields</h4>
          <div
            v-for="(field, index) in form.fields"
            :key="index"
            class="border rounded p-3 mb-4"
          >
            <!-- Field Label -->
            <div class="mb-3">
              <label class="form-label fw-bold">Field Label</label>
              <input
                v-model="field.label"
                type="text"
                class="form-control"
                placeholder="Enter the field label (e.g., 'First Name')"
                required
              />
            </div>

            <!-- Field Name -->
            <div class="mb-3">
              <label class="form-label fw-bold">Field Name</label>
              <input
                v-model="field.name"
                type="text"
                class="form-control"
                placeholder="Enter the field name (e.g., 'first_name')"
                required
              />
            </div>

            <!-- Field Type -->
            <div class="mb-3">
              <label class="form-label fw-bold">Field Type</label>
              <select
                v-model="field.type"
                class="form-select"
              >
                <option value="text">Text</option>
                <option value="email">Email</option>
                <option value="number">Number</option>
                <option value="checkbox">Checkbox</option>
                <option value="radio">Radio Button</option>
                <option value="file">File Upload</option>
                <!-- Add more types as needed -->
              </select>
            </div>

            <!-- Options (for checkbox and radio) -->
            <div class="mb-3" v-if="field.type === 'radio' || field.type === 'checkbox'">
              <label class="form-label fw-bold">Options (comma-separated)</label>
              <input
                v-model="field.options"
                type="text"
                class="form-control"
                placeholder="E.g., 'Option 1, Option 2, Option 3'"
              />
              <small class="form-text text-muted">
                Enter the options that patients can choose from.
              </small>
            </div>

            <!-- Placeholder -->
            <div class="mb-3">
              <label class="form-label fw-bold">Placeholder</label>
              <input
                v-model="field.placeholder"
                type="text"
                class="form-control"
                placeholder="Enter placeholder text"
              />
            </div>

            <!-- Default Value -->
            <div class="mb-3">
              <label class="form-label fw-bold">Default Value</label>
              <input
                v-model="field.default"
                type="text"
                class="form-control"
                placeholder="Enter a default value (optional)"
              />
            </div>

            <!-- Validation Rules -->
            <div class="mb-3">
              <label class="form-label fw-bold">Validation Rules</label>
              <input
                v-model="field.validation"
                type="text"
                class="form-control"
                placeholder="E.g., 'required|min:5'"
              />
              <small class="form-text text-muted">
                Specify validation rules for this field.
              </small>
            </div>

            <!-- Remove Field Button -->
            <div class="text-end">
              <button
                type="button"
                class="btn btn-outline-danger btn-sm"
                @click="removeField(index)"
              >
                Remove Field
              </button>
            </div>
          </div>

          <!-- Add Field Button -->
          <button
            type="button"
            class="btn btn-outline-primary me-2"
            @click="addField"
          >
            Add Field
          </button>

          <!-- Submit Button -->
          <button
            type="submit"
            class="btn btn-success float-end"
          >
            Create Form
          </button>
        </form>
      </div>
    </div>
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
      axios
        .post('/admin/forms', this.form)
        .then((response) => {
          alert('Form created successfully!');
          // Optionally, reset the form
          this.form.title = '';
          this.form.fields = [];
        })
        .catch((error) => {
          console.error(error);
          alert('An error occurred while creating the form.');
        });
    },
  },
};
</script>

<style scoped>
/* Custom styles if needed */
</style>
