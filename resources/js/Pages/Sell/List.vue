<template>
  <AppLayout title="Vendas">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Vendas
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

            <div class="mb-5 w-full">
              <input
                  type="text"
                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-4 py-2 w-10/12 inline-flex"
                  placeholder="Pesquisar..."
                  v-model="term"
                  @keydown.enter.stop="search"
              >
              <div class="inline-flex flex justify-end w-2/12">
                <a :href="route('sells.create')" type="button" class="items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <i class="far fa-plus-circle"></i>
                  <span class="ml-2">Nova Venda</span>
                </a>
              </div>
            </div>

            <hs-table
                :columns="columns"
                :items="sells.data"
                @rowClick="rowClick"
            >
              <template v-slot:value="data">
                {{ Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format(sumValue(data.item)) }}
              </template>
              <template v-slot:status="data">
                <span v-if="data.item.status == 0" class="text-green-600">Concluída</span>
                <span v-else class="text-red-600">Cancelada</span>
              </template>
              <template v-slot:action="data">
                <div class="flex justify-end">
                  <!--a class="hover:text-gray-900 cursor-pointer" :href="route('sells.edit',{sell:data.item.id})" @click.stop="()=>{}">
                    <i class="fal fa-edit"></i>
                  </a-->
                </div>
              </template>
            </hs-table>

            <hs-paginate :paginate="sells"></hs-paginate>

          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import HsTable from "../../Components/Hisoft/HsTable.vue";
import HsPaginate from "@/Components/Hisoft/HsPaginate.vue";
import moment from "moment/moment";

export default {
  name: "Sell-List",
  components:{
    AppLayout,
    HsTable,
    HsPaginate
  },
  props:{
    sells: Array
  },
  data(){
    return{
      term: '',
      columns:[
        {
          class:'w-2/12',
          name: 'Número da Venda',
          field: 'id'
        },
        {
          class:'w-4/12',
          name: 'Cliente',
          field: 'person.name'
        },
        {
          class:'w-2/12',
          name: 'Valor',
          field: 'value'
        },
        {
          class:'w-2/12',
          name: 'Status',
          field: 'status'
        },

        {
          class:'w-2/12',
          name: '',
          field: 'action'
        }
      ],
    }
  },
  methods:{
    search(){
      this.$inertia.visit(`${route('sells.index')}?term=${this.term}`)
    },
    sumValue(sell){
      return sell.items.reduce((acc,curr) => acc += (curr.value - curr.discount), 0)
    },
    rowClick(item){
      this.$inertia.visit(route('sells.show', item.id))
    },
  },
  mounted() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if(urlParams.get("term")){
      this.term = urlParams.get("term")
    }
  }
}
</script>

<style scoped>

</style>