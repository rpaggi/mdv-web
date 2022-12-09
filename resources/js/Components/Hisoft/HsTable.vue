<template>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
              <th v-for="column in columns" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider" :class="column.class">
                {{ column.name }}
              </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white" :class="{'cursor-pointer hover:bg-gray-200':hasRowClick}" v-for="(item, index) in items" @click="rowClick(item)">
              <td v-for="column in columns" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <span v-if="!$slots[column.field]">{{ getValue(item, column.field) }}</span>
                <slot v-else :key="index" :name="column.field" :item="item"></slot>
              </td>
            </tr>
            <tr v-if="$slots['action_line']">
              <td colspan="100%">
                <slot name="action_line"></slot>
              </td>
            </tr>
            <tr v-if="items.length <= 0 && noResultMessage.length > 0">
              <td colspan="100%" class="py-4 text-center font-medium text-gray-500">{{ noResultMessage }}</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HsTable",
  props:{
    columns: Array,
    items: Array,
    noResultMessage: {
      type: String,
      default: "Nenhum resultado encontrado"
    },
  },
  computed:{
    hasRowClick(){
      return !!this.$attrs.onRowClick
    }
  },
  methods:{
    getValue(data, field){
      let indexes = field.split('.')
      let value = data
      indexes.forEach(ind => {
        value = value[ind] ?? ''
      })

      return value
    },
    rowClick(item){
      if(this.hasRowClick){
       this.$emit('rowClick', item)
      }
    }
  },
}
</script>

<style scoped>

</style>