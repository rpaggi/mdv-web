<template>
  <label class="border-gray-200 rounded-tl-md rounded-tr-md relative border p-4 flex cursor-pointer">
    <input
        type="radio"
        :value="value"
        :name="name"
        class="h-4 w-4 mt-0.5 cursor-pointer text-blue-600 border-gray-300 focus:ring-blue-500"
        v-model="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
    <span class="ml-3 text-gray-900 block text-sm font-medium">
          {{ label }}
        </span>
  </label>
</template>

<script>
export default {
  name: "HsRadio",
  props:{
    label: String,
    modelValue: String,
    value: String,
    name: String
  },
  emits: ['update:modelValue'],
}
</script>

<style scoped>

</style>