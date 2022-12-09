<template>
  <div class="flex align-center">
    <Switch
      v-model="modelValue"
      :class="[modelValue ? 'bg-blue-600' : 'bg-gray-400', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500']"
      @update:modelValue="onChange"
    >
      <span aria-hidden="true" :class="[modelValue ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']"/>
    </Switch>
    <span class="ml-3 pt-1"> {{ label }} </span>
  </div>
</template>

<script>
import { Switch } from '@headlessui/vue'

export default {
  name: "HsSwitch",
  components:{
    Switch
  },
  props:{
    label: String,
    modelValue: Boolean
  },
  methods:{
    onChange(){
      this.$emit('update:modelValue', this.modelValue)
    }
  }
}
</script>

<style scoped>

</style>