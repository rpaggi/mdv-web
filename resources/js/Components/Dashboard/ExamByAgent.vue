<template>
  <div class="my-10">
    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-3">Agendamentos por Agente</h3>
    <div class="w-full py-3 px-1">
      <Datepicker
          v-model="dateRange"
          range
          locale="pt-BR"
          :enable-time-picker="false"
          :format="datepickerFormater"
          auto-apply
          @update:modelValue="load"
      />
    </div>
    <hs-table
        :columns="columns"
        :items="agents"
    />
  </div>
</template>

<script>
import HsTable from "../Hisoft/HsTable.vue";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import moment from "moment";

export default {
  name: "ExamByAgent",
  components: {HsTable, Datepicker},
  data(){
    return{
      agents:[],
      dateRange:[new Date(), new Date()],
      columns:[
        {
          class:'w-8/12',
          name: 'Nome',
          field: 'name'
        },
        {
          class:'w-4/12',
          name: 'Quantidade de Agendamentos',
          field: 'count'
        }
      ],
    }
  },
  methods:{
    async load(){
      let url = route('dashboard.exam-by-agent')
      if(this.dateRange){
        url = `${url}?startDate=${moment(this.dateRange[0]).format('yyyy-MM-DD')}&endDate=${moment(this.dateRange[1]).format('yyyy-MM-DD')}`
      }

      const result = await this.$axios.get(url)
      this.agents = result.data;
    },
    formatDate(date){
      return moment(date).format('DD/MM/yyyy')
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
  beforeMount() {
    this.load()
  }
}
</script>

<style scoped>

</style>