<template>
  <label class="block text-sm font-medium text-gray-700">{{ label }}</label>
  <div class="mt-1">
    <input
        v-if="masks"
        type="text"
        :value="modelValue"
        :class="$attrs.class"
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-4 py-2"
        :placeholder="placeholder"
        @input="clean"
        v-mask="masks"
        :disabled="disabled"
        :maxlength="maxlength"
    >
    <input
        v-else
        :type="type"
        :value="modelValue"
        :class="$attrs.class"
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-4 py-2"
        :placeholder="placeholder"
        @input="$emit('update:modelValue', $event.target.value)"
        :disabled="disabled"
        :maxlength="maxlength"
    >
  </div>
  <div v-if="error">
    <p class="text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script>
import {mask} from 'vue-the-mask'

export default {
  name: "HsInputText",
  props:{
    label: String,
    placeholder: String,
    error: String,
    modelValue: String,
    masks: Object,
    masked: Boolean,
    disabled: Boolean,
    type:{
      type: String,
      default: 'text'
    },
    maxlength: String
  },
  emits: ['update:modelValue'],
  directives: { mask },
  methods:{
    clean(event){
      if(this.masked){
        this.$emit('update:modelValue', event.target.value)
        return
      }

      let value = event.target.value.replace(/[^0-9A-z-]/g,"").replaceAll("-","");
      this.$emit('update:modelValue', value)
    }
  }
}
</script>

<style scoped>

</style>