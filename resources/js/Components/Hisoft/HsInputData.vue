<template>
  <label class="block text-sm font-medium text-gray-700">{{ label }}</label>
  <div class="mt-1">
    <div class="relative shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md bg-white">
      <input
          type="text"
          :class="$attrs.class"
          class="px-4 py-2 w-full"
          :placeholder="placeholder"
          @input="emit"
          v-mask="'##/##/####'"
          :disabled="disabled"
          v-model="value"
      >
      <i class="fad fa-times-circle hover:text-red-400 cursor-pointer" style="position: absolute; right: 10px;top:10px" @click="clean"></i>
    </div>
  </div>
  <div v-if="error">
    <p class="text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script>
import {mask} from 'vue-the-mask'
import {format, parseISO, isValid} from 'date-fns'

export default {
  name: "HsInputData",
  props:{
    label: String,
    placeholder: String,
    error: String,
    modelValue: String,
    disabled: Boolean,
    type:{
      type: String,
      default: 'text'
    }
  },
  emits: ['update:modelValue'],
  directives: { mask },
  data(){
    return {
      value: null
    }
  },
  methods:{
    clean(){
      this.value = null
      this.$emit('update:modelValue', null)
    },
    emit(event){
      if(event.target.value.length < 10){
        this.$emit('update:modelValue', null)
        return
      }
      let date = event.target.value
      let splited = date.split('/')
      let iso = `${splited[2]}-${splited[1]}-${splited[0]}`
      let parsed = parseISO(iso);
      if(!isValid(parsed)){
        this.$emit('update:modelValue', null)
        this.value = null
        return
      }
      this.$emit('update:modelValue', iso)
    }
  },
  beforeMount() {
    let date = parseISO(this.modelValue)
    if(isValid(date)){
      this.value = format(date, 'dd/MM/yyyy')
    }
  }
}
</script>

<style scoped>

</style>