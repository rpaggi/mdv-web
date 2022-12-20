<template>
  <AppLayout title="Venda">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Venda
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-7 py-5">
          <p class="mb-2">
            <span class="font-bold">Número:</span> {{sell.id}}
          </p>
          <p class="mb-2">
            <span class="font-bold">Cliente:</span> {{sell.person.name}}
          </p>
          <p class="mb-2">
            <span class="font-bold">Data/Hora:</span> {{formatDateFull(sell.created_at)}}
          </p>
          <p class="mb-7">
            <span class="font-bold">Status: </span>
            <span v-if="sell.status == 0"  class="text-green-600">Concluída</span>
            <span v-else class="text-red-600">Cancelada</span>
          </p>
          <div>
            <p class="">Itens</p>
            <table class="border-b border-gray-300 sm:rounded-lg w-full shadow">
              <tr>
                <th class="w-4/12 text-left px-2 py-3 bg-gray-100">Produto</th>
                <th class="w-2/12 text-left px-2 py-3 bg-gray-100">Valor Unitário</th>
                <th class="w-2/12 text-left px-2 py-3 bg-gray-100">Quantidade</th>
                <th class="w-2/12 text-left px-2 py-3 bg-gray-100">Desconto</th>
                <th class="w-2/12 text-left px-2 py-3 bg-gray-100">Valor Total</th>
              </tr>
              <tr v-for="item in sell.items">
                <td class="p-2">{{item.product.description}}</td>
                <td class="p-2">{{formatValue( item.value )}}</td>
                <td class="p-2">{{item.quantity}}</td>
                <td class="p-2">{{formatValue(item.discount)}}</td>
                <td class="p-2">{{formatValue(item.value * item.quantity)}}</td>
              </tr>
            </table>
          </div>

          <div class="mt-4 p-4">
            <div class="w-full flex justify-end"> <span class="font-bold mr-3">Valor Total:</span> {{ totalValue }} </div>
            <div class="w-full flex justify-end"> <span class="font-bold mr-3">Valor Total de Desconto:</span> {{ totalDiscount }} </div>
            <div class="w-full flex justify-end"> <span class="font-bold mr-3">Valor Total Final:</span> {{ finalValue }} </div>
          </div>

          <div class="w-full flex justify-end space-x-4">
            <a @click.stop="goBack" type="button" class="w-1/3 flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              <span class="ml-2">Voltar</span>
            </a>
            <a v-if="sell.status == 0" @click.stop="cancel" type="button" class="w-1/3 flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              <span v-if="!saving" class="ml-2">Cancelar Venda</span>
              <spinner sm v-else></spinner>
            </a>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import moment from "moment";
import Spinner from "../../Components/Spinner/Spinner.vue";

export default {
  name: "Sell-Show",
  props:{
    sell: Object
  },
  components:{
    AppLayout,
    Spinner
  },
  data(){
    return {
      saving: false
    }
  },
  computed:{
    totalValue(){
      return Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format( this.sell.items.reduce((acc,curr) => acc+(curr.value*curr.quantity), 0) )
    },
    totalDiscount(){
      return Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format( this.sell.items.reduce((acc,curr) => acc + parseFloat(curr.discount), 0) )
    },
    finalValue(){
      return Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format( this.sell.items.reduce((acc,curr) => acc + ((curr.value*curr.quantity)-curr.discount), 0) )
    }
  },
  methods:{
    formatDateFull(date){
      return moment(date).format('DD/MM/yyyy hh:mm')
    },
    formatValue(value){
      return Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format( value )
    },
    goBack(){
      this.$inertia.visit(route("sells.index"))
    },
    async cancel(){
      this.saving = true

      const dialogRes = await this.$swal.fire({
        title: 'Você tem certeza que deseja cancelar a venda?',
        text: "Essa ação é irreversível!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
      })

      if (dialogRes.isConfirmed) {
          await this.$axios.post(route('sells.cancel', {id:this.sell.id}))

          this.$toast.fire(
            'A venda foi cancelada!',
            '',
            'success'
          )
          this.$inertia.reload();
        }

      this.saving = false
    }
  },
  beforeMount() {

  }
}
</script>

<style>
.inline-block{
  display: inline-block;
}
</style>