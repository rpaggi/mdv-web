<template>
  <AppLayout title="Produtos">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Produtos
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
                <a :href="route('products.create')" type="button" class="items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <i class="far fa-plus-circle"></i>
                  <span class="ml-2">Novo Produto</span>
                </a>
              </div>
            </div>

            <hs-table
                :columns="columns"
                :items="products.data"
            >
              <template v-slot:value="data">
                {{ Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format(data.item.value) }}
              </template>
              <template v-slot:action="data">
                <div class="flex justify-end">
                  <a class="hover:text-gray-900 cursor-pointer" :href="route('products.edit',{product:data.item.id})" @click.stop="()=>{}">
                    <i class="fal fa-edit"></i>
                  </a>
                  <a class="hover:text-gray-900 ml-4 cursor-pointer" @click.stop="deleteItem(data.item.id)">
                    <i class="fal fa-trash"></i>
                  </a>
                </div>
              </template>
              <template v-slot:module="data">
                {{ data.item.module.name }}
              </template>
            </hs-table>

            <hs-paginate :paginate="products"></hs-paginate>

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
  name: "Product-List",
  components:{
    AppLayout,
    HsTable,
    HsPaginate
  },
  props:{
    products: Array
  },
  data(){
    return{
      term: '',
      columns:[
        {
          class:'w-6/12',
          name: 'Descrição',
          field: 'description'
        },
        {
          class:'w-2/12',
          name: 'Valor',
          field: 'value'
        },
        {
          class:'w-2/12',
          name: 'Qtd em Estoque',
          field: 'quantity'
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
      this.$inertia.visit(`${route('products.index')}?term=${this.term}`)
    },
    deleteItem(id){
      this.$swal.fire({
        title: 'Você tem certeza que deseja excluir?',
        text: "Essa ação é irreversível!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
      }).then((result) => {
        if (result.isConfirmed) {
          this.$axios.delete(route('products.destroy', {product:id})).then(response=>{
            this.$toast.fire(
                'O produto foi excluído!',
                '',
                'success'
            )
            this.$inertia.reload();
          })
        }
      })
    }
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