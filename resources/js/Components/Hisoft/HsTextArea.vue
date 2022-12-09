<template>
  <label class="block text-sm font-medium text-gray-700">{{ label }}</label>
  <div class="mt-1">
    <textarea
        :class="$attrs.class"
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-4 py-2"
        :placeholder="placeholder"
        @input="$emit('update:modelValue', $event.target.value)"
        :disabled="disabled"
        :maxlength="maxlength"
        :rows="rows"
    >{{modelValue}}</textarea>
  </div>
  <div v-if="error">
    <p class="text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script>

export default {
  name: "HsTextArea",
  props:{
    label: String,
    placeholder: String,
    error: String,
    modelValue: String,
    disabled: Boolean,
    maxlength: String,
    rows:{
      default: 3
    }
  },
  emits: ['update:modelValue']
}
</script>

<style scoped>

</style>