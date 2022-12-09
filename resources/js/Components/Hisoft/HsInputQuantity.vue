<template>
  <label class="block text-sm font-medium text-gray-700">{{ label }}</label>
    <div class="flex inline-flex items-center px-3">
      <button class="bg-gray-400 hover:bg-gray-600 hover:text-gray-400" style="border-radius: 50%; height: 32px; width: 45px" @click="decrement">
        <i class="fas fa-minus"></i>
      </button>
      <input
          :type="type"
          :value="modelValue"
          :class="$attrs.class"
          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-base border-gray-300 rounded-md px-4 py-2 mx-3 text-center"
          :placeholder="placeholder"
          v-mask="'##########'"
          @input="$emit('update:modelValue', $event.target.value)"
          :disabled="disabled"
          ref="input"
      >
      <button class="bg-gray-400 hover:bg-gray-600 hover:text-gray-400" style="border-radius: 50%; height: 32px; width: 45px" @click="increment">
        <i class="fas fa-plus"></i>
      </button>
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
  name: "HsInputQuantity",
  props:{
    label: String,
    placeholder: String,
    error: String,
    modelValue: String,
    disabled: Boolean,
    type:{
      type: String,
      default: 'text'
    },
    min:{
      type: Number,
      default: 0
    },
    max: Number
  },
  emits: ['update:modelValue'],
  directives: { mask },
  methods:{
    increment(){
      if(this.max && (this.modelValue+1) > this.max){
        return
      }
      this.$emit('update:modelValue', parseInt(this.modelValue) + 1)
    },
    decrement(){
      if((this.modelValue-1) < this.min){
        return
      }
      this.$emit('update:modelValue', parseInt(this.modelValue) - 1)
    },
  }
}
</script>

<style scoped>

</style>