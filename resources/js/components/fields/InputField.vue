<template>
  <div>
    <input :type="field.type"
           :name="field.name"
           :id="field.name"
           v-model="modelValue"
           :placeholder="field.placeholder"
           class="form-control" />
    <div v-if="errors[field.name]" class="text-danger">
      {{ errors[field.name][0] }}
    </div>
  </div>
</template>

<script>
export default {
  props: ['field', 'modelValue', 'errors'],
  emits: ['update:modelValue'],
};
</script>
