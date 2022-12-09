<template>
  <AppLayout title="Agentes">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{title}} Agente
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-7 py-5">
          <div class="inline-flex w-full space-x-4">
            <div class="inline w-1/2">
              <hs-input-text label="Nome" :error="errors.name" v-model="form.name"></hs-input-text>
            </div>
            <div class="inline w-1/2">
              <hs-input-text label="Email" :error="errors.email" v-model="form.email"></hs-input-text>
            </div>
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
import Spinner from "../../Components/Spinner/Spinner.vue";

export default {
  name: "Agent-Form",
  props:{
    errors:Object,
    agent: Object
  },
  components:{
    AppLayout,
    HsInputText,
    Spinner
  },
  data(){
    return {
      title: 'Adicionar',
      form:{
        name: "",
        email: "",
      },
      saving: false
    }
  },
  methods:{
    saveItem(){
      this.saving = true;

      if(!this.agent){
        this.insert()
      }else{
        this.update();
      }

    },
    insert(){
      this.$inertia.post(route('agents.store'), this.form,{
        onFinish:()=>{
          this.saving = false
        }
      })
    },
    update(){
      this.$inertia.put(route('agents.update', {agent:this.agent.id}), this.form,{
        onFinish:()=>{
          this.saving = false
        }
      })
    },
  },
  beforeMount() {
    if(this.agent){
      this.form = { ...
        this.agent,
      }
      this.title = "Editar"
    }
  }
}
</script>

<style scoped>

</style>