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
                    auto-apply
                    :format="datepickerFormater"
                    @update:modelValue="search"
                />
              </div>

              <div class="mb-5 w-6/12">
                <hs-time-picker
                    :items="hours"
                    v-model="timeRange"
                    @update:modelValue="search"
                />
              </div>

              <div class="mb-5 w-6/12 relative">
                <HsAutocomplete
                    placeholder="Cidade"
                    :list="citiesList"
                    field-label="label"
                    v-model="city"
                    @update:modelValue="searchCity"
                ></HsAutocomplete>
                <div class="cursor-pointer" style="position:absolute;top:8px;right: 10px" @click="cleanCity">
                  <i class="fad fa-eraser"></i>
                </div>
              </div>
            </div>

            <div class="flex space-x-4 justify-end mb-4">
              <a @click.stop="print()" type="button" class="w-4/12 flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="ml-2">Imprimir todas as fichas</span>
              </a>
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
import HsAutocomplete from "../../Components/Hisoft/HsAutocomplete.vue";
import moment from 'moment';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import HsSwitch from "../../Components/Hisoft/HsSwitch.vue";
import HsTimePicker from "../../Components/Hisoft/HsTimePicker.vue";
import hours from '../../hours.json'

export default {
  name: "Exam-List",
  components:{
    AppLayout,
    HsTable,
    HsPaginate,
    Datepicker,
    HsAutocomplete,
    HsSwitch,
    HsTimePicker
  },
  props:{
    exams: Array,
    cities: Array
  },
  data(){
    return{
      term: '',
      dateRange:null,
      timeRange: null,
      city: null,
      select: false,
      hours: hours,
      columns:[
        {
          class:'w-4/12',
          name: 'Nome',
          field: 'person.name'
        },
        {
          class:'w-3/12',
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
  computed:{
    citiesList(){
      return this.cities.map(city => {
        return {
          label: `${city.title} - ${city.state.letter}`,
          value: city
        }
      })
    }
  },
  methods:{
    getSearchString(){
      let searchString = "?"

      if(this.term){
        searchString = `${searchString}term=${this.term}`
      }

      if(this.dateRange){
        searchString = `${searchString}&startDate=${moment(this.dateRange[0]).format('yyyy-MM-DD')}&endDate=${moment(this.dateRange[1]).format('yyyy-MM-DD')}`
      }

      if(this.city){
        searchString = `${searchString}&cityId=${this.city.value.id}`
      }
      console.log(this.timeRange)
      if(this.timeRange){
        searchString = `${searchString}&startTime=${this.timeRange.first}&endTime=${this.timeRange.last}`
      }

      return searchString;
    },
    search(){
      let searchString = this.getSearchString()

      this.$inertia.visit(`${route('exams.index')}${searchString}`)
    },
    searchCity(){
      if(this.city){
        this.search()
      }
    },
    cleanCity(){
      this.city = null
      this.search()
    },
    formatDate(date){
      return moment(date).format('DD/MM/yyyy')
    },
    formatDocument(cpf){
      if(!cpf) return ""
      return `${cpf.substr(-11, 3)}.${cpf.substr(-8, 3)}.${cpf.substr(-5, 3)}-${cpf.substr(-2)}`
    },
    rowClick(item){
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
    },
    print(){
      let searchString = this.getSearchString()
      window.open(`${route('exams.multi-print')}${searchString}`, '_blank');
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
    if(urlParams.get("startTime")){
      this.timeRange = {
        first:urlParams.get("startTime"),
        last:urlParams.get("endTime")
      }
    }
    if(urlParams.get("cityId")){
      let city = this.citiesList.find(city=>{
        return city.value.id == urlParams.get("cityId")
      })
      this.city = city
    }
  }
}
</script>

<style>
.hs-autocomplete-list{
  width: 100%;
}
</style>