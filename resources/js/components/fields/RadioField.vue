<template>
  <div>
    <div v-for="(option, idx) in options" :key="idx" class="form-check">
      <input type="radio"
             :name="field.name"
             :id="field.name + idx"
             :value="option"
             v-model="internalValue"
             class="form-check-input" />
      <label :for="field.name + idx" class="form-check-label">{{ option }}</label>
    </div>
    <div v-if="errors[field.name]" class="text-danger">
      {{ errors[field.name][0] }}
    </div>
  </div>
</template>

<script>
export default {
  props: ['field', 'modelValue', 'errors'],
  emits: ['update:modelValue'],
  computed: {
    options() {
      return this.field.options ? this.field.options.split(',').map(opt => opt.trim()) : [];
    },
    internalValue: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit('update:modelValue', value);
      },
    },
  },
};
</script>
