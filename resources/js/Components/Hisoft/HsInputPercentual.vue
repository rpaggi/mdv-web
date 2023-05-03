<template>
  <label class="block text-sm font-medium text-gray-700">{{ label }}</label>
  <div class="mt-1">
    <input
        type="text"
        :value="modelValue"
        :class="$attrs.class"
        class="shadow-sm focus:ring-system-500 focus:border-system-500 block w-full sm:text-sm border-gray-300 rounded-md px-4 py-2"
        :placeholder="placeholder"
        @input="clean"
        :disabled="disabled"
        v-money="money"
    >
  </div>
  <div v-if="error">
    <p class="text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script>
import {VMoney} from 'v-money'

export default {
  name: "HsInputPercentual",
  props:{
    label: String,
    placeholder: String,
    error: String,
    modelValue: String,
    masks: Object,
    masked: Boolean,
    disabled: Boolean,
  },
  computed:{
    money(){
      return {
        decimal: ',',
        thousands: '',
        prefix: '',
        suffix: ' %',
        precision: 2,
        masked: false
      }
    }
  },
  emits: ['update:modelValue'],
  directives: {
    money: VMoney
  },
  methods:{
    clean(event){
      if(this.masked){
        this.$emit('update:modelValue', event.target.value)
        return
      }
      let value = event.target.value.replaceAll("%","").replaceAll(" ","").replaceAll(",",".");
      this.$emit('update:modelValue', value)
    }
  }
}
</script>

<style scoped>

</style>