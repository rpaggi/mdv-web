<template>
  <AppLayout title="Agendamentos">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Agendamentos
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

            <div class="flex space-x-4">
              <div class="mb-5 w-6/12">
                <input
                    type="text"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-4 py-2 inline-flex"
                    placeholder="Pesquisar..."
                    v-model="term"
                    @keydown.enter.stop="search"
                >
              </div>
              <div class="mb-5 w-6/12">
                <Datepicker
                    v-model="dateRange"
                    range
                    locale="pt-BR"
                    :enable-time-picker="false"
                    :format="datepickerFormater"
                    auto-apply
                    @update:modelValue="search"
                />
              </div>
            </div>

            <hs-table
                @rowClick="rowClick"
                :columns="columns"
                :items="exams.data"
            >
              <template v-slot:document="data">
                {{ formatDocument(data.item.person.document) }}
              </template>
              <template v-slot:examAt="data">
                {{ formatDate(data.item.exam_at) }}
              </template>
            </hs-table>

            <hs-paginate :paginate="exams"></hs-paginate>

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
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

export default {
  name: "Exam-List",
  components:{
    AppLayout,
    HsTable,
    HsPaginate,
    Datepicker
  },
  props:{
    exams: Array
  },
  data(){
    return{
      term: '',
      dateRange:null,
      columns:[
        {
          class:'w-4/12',
          name: 'Nome',
          field: 'person.name'
        },
        {
          class:'w-4/12',
          name: 'Documento',
          field: 'document'
        },
        {
          class:'w-4/12',
          name: 'Data do Exame',
          field: 'examAt'
        },
      ],
    }
  },
  methods:{
    search(){
      let searchString = "?"

      if(this.term){
        searchString = `${searchString}term=${this.term}`
      }

      if(this.dateRange){
        searchString = `${searchString}&startDate=${moment(this.dateRange[0]).format('yyyy-MM-DD')}&endDate=${moment(this.dateRange[1]).format('yyyy-MM-DD')}`
      }

      this.$inertia.visit(`${route('exams.index')}${searchString}`)
    },
    formatDate(date){
      return moment(date).format('DD/MM/yyyy')
    },
    formatDocument(cpf){
      if(!cpf) return ""
      return `${cpf.substr(-11, 3)}.${cpf.substr(-8, 3)}.${cpf.substr(-5, 3)}-${cpf.substr(-2)}`
    },
    rowClick(item){
      return
      this.$inertia.visit(route('exams.show', item.id))
    },
    datepickerFormater(date){
      let formDate = '';
      if (date[0]) {
        formDate = `${this.formatDate(date[0])}`;
      }

      if (date[1]) {
        formDate = `${formDate} - ${this.formatDate(date[1])}`;
      }

      return formDate;
    }
  },
  mounted() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if(urlParams.get("term")){
      this.term = urlParams.get("term")
    }
    if(urlParams.get("startDate")){
      this.dateRange = []
      this.dateRange[0] = moment(urlParams.get("startDate"))
      this.dateRange[1] = moment(urlParams.get("endDate"))
    }
  }
}
</script>

<style scoped>

</style>