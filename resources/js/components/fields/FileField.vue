<template>
  <div>
    <input type="file"
           :name="field.name"
           :id="field.name"
           @change="onFileChange"
           class="form-control" />
    <div v-if="errors[field.name]" class="text-danger">
      {{ errors[field.name][0] }}
    </div>
  </div>
</template>

<script>
export default {
  props: ['field', 'errors'],
  emits: ['update:modelValue'],
  methods: {
    onFileChange(event) {
      this.$emit('update:modelValue', event.target.files[0]);
    },
  },
};
</script>
