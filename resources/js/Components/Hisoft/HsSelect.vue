<template>
  <label class="block text-sm font-medium text-gray-700">{{ label }}</label>
  <select
      class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
      :value="modelValue"
      :disabled="disabled"
      @input="$emit('update:modelValue', $event.target.value)"
  >
    <option v-if="placeholder" value="" disabled>{{ placeholder }}</option>
    <option v-for="o in options" :value="o.value">{{ o.label }}</option>
  </select>
  <div v-if="error">
    <p class="text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script>
export default {
  name: "HsSelect",
  props:{
    label: String,
    placeholder: String,
    disabled: Boolean,
    options: {
      type:Array,
      default:()=>[]
    },
    modelValue: String,
    error: String
  }
}
</script>

<style scoped>

</style>