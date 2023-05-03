<template>
  <AppLayout title="Agendamento">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Agendamento
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="flex">
              <div class="w-4/12">
                <p class="font-bold">Data do Agendamento:</p>
                <p>{{formatDateFull(exam.exam_at)}}</p>
              </div>
              <div class="w-8/12 flex justify-end space-x-4">
                <a @click.stop="edit" type="button" class="w-3/12 flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                  <span>Editar</span>
                </a>
                <a @click.stop="print" type="button" class="w-3/12 flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                  <span>Imprimir Ficha</span>
                </a>
                <a @click.stop="goBack" type="button" class="w-3/12 flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                  <span>Voltar</span>
                </a>
              </div>
            </div>
            <div class="flex mt-6">
              <div class="w-4/12">
                <p class="font-bold">Nome completo:</p>
                <p>{{exam.person.name}}</p>
              </div>
              <div class="w-4/12">
                <p class="font-bold">Apelido:</p>
                <p>{{exam.person.nickname}}</p>
              </div>
              <div class="w-4/12">
                <p class="font-bold">Idade:</p>
                <p>{{exam.person.age}}</p>
              </div>
            </div>

            <div class="flex mt-3">
              <div class="w-4/12">
                <p class="font-bold">Documento:</p>
                <p>{{formatDocument(exam.person.document)}}</p>
              </div>
              <div class="w-4/12">
                <p class="font-bold">Endereço:</p>
                <p>{{exam.person.address}}</p>
              </div>
              <div class="w-4/12">
                <p class="font-bold">Ponto de Referencia:</p>
                <p>{{exam.person.address_reference ?? '-'}}</p>
              </div>
            </div>

            <div class="flex mt-3">
              <div class="w-4/12">
                <p class="font-bold">Distrito:</p>
                <p>{{exam.person.district}}</p>
              </div>
              <div class="w-4/12">
                <p class="font-bold">Cidade:</p>
                <p>{{exam.person.city.title}}</p>
              </div>
              <div class="w-4/12">
                <p class="font-bold">Estado:</p>
                <p>{{exam.person.city.state.title}}</p>
              </div>
            </div>

            <div class="flex mt-3">
              <div class="w-4/12">
                <p class="font-bold">Telefone:</p>
                <p>{{formatPhone(exam.person.phone)}}</p>
              </div>
              <div class="w-4/12">
                <p class="font-bold">ACS:</p>
                <p>{{exam.person.acs ?? '-'}}</p>
              </div>
            </div>

            <div class="flex mt-3">
              <div class="w-full">
                <p class="font-bold">Observações:</p>
                <p>{{exam.notes ?? '-'}}</p>
              </div>
            </div>
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
import moment from 'moment';

export default {
  name: "Exam-Show",
  components:{
    AppLayout
  },
  props:{
    exam: Object
  },
  data(){
    return {}
  },
  methods:{
    formatDateFull(date){
      return moment(date).format('DD/MM/yyyy hh:mm')
    },
    formatDate(date){
      return moment(date).format('DD/MM/yyyy')
    },
    formatDocument(cpf){
      if(!cpf) return ""
      return `${cpf.substr(-11, 3)}.${cpf.substr(-8, 3)}.${cpf.substr(-5, 3)}-${cpf.substr(-2)}`
    },
    formatPhone(phone){
      if(!phone) return ""
      if(phone.length == 11){
        return `(${phone.substr(-11, 2)}) ${phone.substr(-9, 5)}-${phone.substr(-4)}`
      }

      return `(${phone.substr(-10, 2)}) ${phone.substr(-8, 4)}-${phone.substr(-4)}`

    },
    goBack(){
      this.$inertia.visit(route('exams.index'))
    },
    print(){
      window.open(route('exams.print', {id:this.exam.id}), '_blank');
    },
    edit(){
      this.$inertia.visit(route('exams.edit', {exam:this.exam.id}))
    }
  },
  mounted() {
  }
}
</script>

<style scoped>

</style>