<template>
  <AppLayout title="Venda">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{title}} Venda
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-7 py-5">
          <div class="w-full mb-3 mt-3">
            <hs-autocomplete
                label="Cliente"
                :error="errors.person_id"
                :list="people"
                fieldLabel="name"
                v-model="form.person"
            ></hs-autocomplete>
          </div>
          <p class="text-sm font-medium text-gray-700">Itens</p>
          <div class="border border-gray-300 w-full rounded-md p-4">
            <div class="space-x-4">
              <div class="inline-block w-3/12">
                <p class="text-sm font-medium text-gray-700">Produto</p>
              </div>
              <div class="inline-block w-2/12 ">
                <p class="text-sm font-medium text-gray-700">Valor Unitário</p>
              </div>
              <div class="inline-block w-2/12 ">
                <p class="text-sm font-medium text-gray-700">Quantidade</p>
              </div>
              <div class="inline-block w-2/12 ">
                <p class="text-sm font-medium text-gray-700">Desconto</p>
              </div>
              <div class="inline-block w-1/12 ">
                <p class="text-sm font-medium text-gray-700">Valor Total</p>
              </div>
            </div>
            <ul>
              <li v-for="(item, index) in form.items" class="mb-3 space-x-4">
                <div class="inline-block w-3/12">
                  <hs-autocomplete
                    :list="products"
                    field-label="description"
                    v-model="item.product"
                    @update:modelValue="(v)=>{ updateValue(v, index) }"
                  ></hs-autocomplete>
                </div>
                <div class="inline-block w-2/12">
                  {{ Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format(item.value) }}
                </div>
                <div class="inline-block w-2/12">
                  <hs-input-number
                      v-model="item.quantity"
                  />
                </div>
                <div class="inline-block w-2/12">
                  <hs-input-money
                      v-model="item.discount"
                  />
                </div>
                <div class="inline-block w-1/12">
                  {{ Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format( getTotal(index) ) }}
                </div>
                <div class="inline-flex w-1/12 justify-end">
                  <div class="cursor-pointer" @click="removeItem(index)">
                    <i class="fas fa-times-circle text-red-400 hover:text-red-700"></i>
                  </div>
                </div>
              </li>
              <li class="flex justify-center">
                <div @click.stop="addItem()" type="button" class="w-4/12 flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                  <span class="ml-2">Adicionar Item</span>
                </div>
              </li>
            </ul>
          </div>
          
          <div class="mt-4 p-4">
            <div class="w-full flex justify-end"> <span class="font-bold mr-3">Valor Total:</span> {{ totalValue }} </div>
            <div class="w-full flex justify-end"> <span class="font-bold mr-3">Valor Total de Desconto:</span> {{ totalDiscount }} </div>
            <div class="w-full flex justify-end"> <span class="font-bold mr-3">Valor Total Final:</span> {{ finalValue }} </div>
          </div>
          
          <div class="w-full mt-4 flex justify-center">
            <a @click.stop="saveItem()" type="button" class="w-1/2 flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              <span v-if="!saving" class="ml-2">Salvar</span>
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
import HsInputText from "../../Components/Hisoft/HsInputText.vue";
import HsInputMoney from "../../Components/Hisoft/HsInputMoney.vue";
import HsInputNumber from "../../Components/Hisoft/HsInputNumber.vue";
import Spinner from "../../Components/Spinner/Spinner.vue";
import HsAutocomplete from "../../Components/Hisoft/HsAutocomplete.vue";

export default {
  name: "Sell-Form",
  props:{
    people: Array,
    products: Array,
    errors:Object,
    sell: Object
  },
  components:{
    AppLayout,
    HsAutocomplete,
    HsInputText,
    HsInputMoney,
    HsInputNumber,
    Spinner
  },
  data(){
    return {
      title: 'Nova',
      form:{
        person: null,
        items:[
          {
            product: null,
            quantity: 1,
            value: 0.00,
            discount: 0.00
          }
        ]
      },
      saving: false
    }
  },
  computed:{
    totalValue(){
      return Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format( this.form.items.reduce((acc,curr) => acc+(curr.value*curr.quantity), 0) )
    },
    totalDiscount(){
      return Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format( this.form.items.reduce((acc,curr) => acc + parseFloat(curr.discount), 0) )
    },
    finalValue(){
      return Intl.NumberFormat("pt-BR", {style: "currency",currency: "BRL",}).format( this.form.items.reduce((acc,curr) => acc + ((curr.value*curr.quantity)-curr.discount), 0) )
    }
  },
  methods:{
    removeItem(index){
      if(this.form.items.length < 2) return
      this.form.items.splice(index, 1);
    },
    addItem(){
      this.form.items.push({
        product: null,
        quantity: 1,
        value: 0.00,
        discount: 0.00
      })
    },
    updateValue(v, index){
      if(v==null) this.form.items[index].value = 0
      this.form.items[index].value = v.value
    },
    getTotal(index){
      let item = this.form.items[index]
      return ( item.value * item.quantity ) - item.discount
    },
    saveItem(){
      this.saving = true;

      if(!this.sell){
        this.insert()
      }else{
        this.update();
      }

    },
    insert(){
      this.$inertia.post(route('sells.store'), this.form,{
        onFinish:()=>{
          this.saving = false
        }
      })
    },
    update(){
      this.$inertia.put(route('sells.update', {sell:this.product.id}), this.form,{
        onFinish:()=>{
          this.saving = false
        }
      })
    },
  },
  beforeMount() {
    if(this.sell){
      this.form = { ...
        this.sell,
      }
      this.title = "Alterar"
    }
  }
}
</script>

<style>
.inline-block{
  display: inline-block;
}
</style>