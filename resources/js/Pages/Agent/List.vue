<template>
  <AppLayout title="Agentes">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Agentes
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
                <a :href="route('agents.create')" type="button" class="items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <i class="far fa-plus-circle"></i>
                  <span class="ml-2">Novo Agente</span>
                </a>
              </div>
            </div>

            <hs-table
                :columns="columns"
                :items="users.data"
            >
              <template v-slot:action="data">
                <div class="flex justify-end">
                  <a class="hover:text-gray-900 cursor-pointer" :href="route('agents.edit',{agent:data.item.id})" @click.stop="()=>{}">
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

            <hs-paginate :paginate="users"></hs-paginate>

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

export default {
  name: "Agent-List",
  components:{
    AppLayout,
    HsTable,
    HsPaginate
  },
  props:{
    users: Array
  },
  data(){
    return{
      term: '',
      columns:[
        {
          class:'w-5/12',
          name: 'Nome',
          field: 'name'
        },
        {
          class:'w-4/12',
          name: 'Email',
          field: 'email'
        },
        {
          class:'w-3/12',
          name: '',
          field: 'action'
        }
      ],
    }
  },
  methods:{
    search(){
      this.$inertia.visit(`${route('agents.index')}?term=${this.term}`)
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
          this.$axios.delete(route('agents.destroy', {agent:id})).then(response=>{
            this.$toast.fire(
                'O agente foi excluído!',
                '',
                'success'
            )
            this.$inertia.reload();
          })
        }
      })
    }
  }
}
</script>

<style scoped>

</style>