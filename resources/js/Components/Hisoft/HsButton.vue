<template>
  <div v-bind="$attrs" class="cursor-pointer items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-system-700 hover:bg-system-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-system-500">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: "HsButton",
  props:{
    primary: Boolean,
    secondary: Boolean
  }
}
</script>

<style scoped>

</style>