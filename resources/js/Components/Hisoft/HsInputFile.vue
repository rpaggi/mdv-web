<template>
  <label class="block text-sm font-medium text-gray-700">{{ label }}</label>
  <div class="mt-1">
    <input
        type="file"
        id="hs-upload"
        class="hidden"
        :placeholder="placeholder"
        @change="handle"
        ref="files"
        :disabled="disabled"
        :accept="accept"
    >
    <label
        for="hs-upload"
        :class="$attrs.class"
        class="shadow-sm focus:ring-system-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 bg-gray-100 rounded-md px-4 py-2 cursor-pointer hover:bg-indigo-300 hover:text-white"
    >
      <span v-if="files.length > 0">
        {{ files[0].name }}
      </span>
      <span v-else>
        Clique aqui para selecionar um arquivo...
      </span>
    </label>
  </div>
  <div v-if="error">
    <p class="text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script>
export default {
  name: "HsInputFile",
  props:{
    label: String,
    placeholder: String,
    error: String,
    modelValue: String,
    disabled: Boolean,
    accept: String
  },
  data(){
    return{
      files: []
    }
  },
  methods:{
    handle(){
      this.files = this.$refs.files.files
    }
  }
}
</script>

<style scoped>

</style>