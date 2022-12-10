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
            {{exam}}
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
    formatDate(date){
      return moment(date).format('DD/MM/yyyy')
    },
    formatDocument(cpf){
      if(!cpf) return ""
      return `${cpf.substr(-11, 3)}.${cpf.substr(-8, 3)}.${cpf.substr(-5, 3)}-${cpf.substr(-2)}`
    }
  },
  mounted() {
  }
}
</script>

<style scoped>

</style>