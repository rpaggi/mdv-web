<template>
  <AppLayout title="Agendamento">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Editar Agendamento
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 sm:px-20 bg-white border-b border-gray-200" v-if="form != null">
            <div class="flex gap-6">
              <div class="w-4/12">
                <p class="block text-sm font-medium text-gray-700">Data do Agendamento(*)</p>
                <Datepicker
                    v-model="form.exam_at"
                    locale="pt-BR"
                    :enable-time-picker="true"
                    auto-apply
                    :format="formatDateFull"
                    :clearable="false"
                    class="mt-1"
                />
              </div>
              <div class="w-8/12">
                <hs-input-text
                    v-model="form.person.name"
                    label="Nome completo(*)"
                    :error="errors['person.name']"
                />
              </div>
            </div>
            <div class="flex mt-6 gap-6">

              <div class="w-4/12">
                <hs-input-text
                    v-model="form.person.nickname"
                    label="Apelido"
                />
              </div>
              <div class="w-2/12">
                <hs-input-number
                    v-model="form.person.age"
                    label="Idade(*)"
                    :error="errors['person.age']"
                />
              </div>
              <div class="w-4/12">
                <hs-input-text
                    v-model="form.person.document"
                    label="Documento"
                    masks="###.###.###-##"
                    :error="errors['person.document']"
                />
              </div>
            </div>

            <div class="flex mt-3 gap-6">
              <div class="w-6/12">
                <hs-input-text
                    v-model="form.person.address"
                    label="Endereço(*)"
                    :error="errors['person.address']"
                />
              </div>
              <div class="w-6/12">
                <hs-input-text
                    v-model="form.person.address_reference"
                    label="Ponto de referencia"
                />
              </div>
            </div>

            <div class="flex mt-3 gap-6">
              <div class="w-4/12">
                <hs-input-text
                    v-model="form.person.district"
                    label="Distrito"
                />
              </div>
              <div class="w-4/12">
                <HsAutocomplete
                    label="Cidade/Estado(*)"
                    :list="citiesList"
                    field-label="label"
                    v-model="form.person.cityObject"
                    :error="errors['person.city']"
                ></HsAutocomplete>
              </div>
              <div class="w-4/12">
                <hs-input-text
                    v-model="form.person.phone"
                    label="Telefone(*)"
                    :error="errors['person.phone']"
                    :masks="['(##) ####-####', '(##) #####-####']"
                />
              </div>
            </div>

            <div class="flex mt-3">
              <div class="w-4/12">
                <hs-input-text
                    label="ACS"
                    v-model="exam.person.acs"
                />
              </div>
            </div>


            <div class="w-full flex justify-center space-x-4 mt-6">
              <a @click.stop="save" type="button" class="w-3/12 flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <span>Salvar</span>
              </a>
              <a @click.stop="goBack" type="button" class="w-3/12 flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-400 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <span>Cancelar</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import moment from 'moment';
import HsInputText from "../../Components/Hisoft/HsInputText.vue";
import HsInputNumber from "../../Components/Hisoft/HsInputNumber.vue";
import HsAutocomplete from "../../Components/Hisoft/HsAutocomplete.vue";

export default {
  name: "Exam-Form",
  components:{
    AppLayout,
    Datepicker,
    HsInputText,
    HsInputNumber,
    HsAutocomplete
  },
  props:{
    exam: Object,
    errors: Object,
    cities: Array
  },
  data(){
    return {
      form:null
    }
  },
  methods:{
    formatDateFull(date){
      return moment(date).format('DD/MM/yyyy hh:mm')
    },
    goBack(){
      this.$inertia.visit(route('exams.show', {exam:this.exam.id}))
    },
    save(){
      let data = {
        ...this.form,
        person:{
          ...this.form.person,
          city: this.form.person.cityObject?.value,
          address_city_id: this.form.person.cityObject?.value.id
        }
      }
      this.$inertia.put(route('exams.update', {exam:this.exam.id}), data,{
        onFinish:()=>{
          this.saving = false
        }
      })
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
  mounted() {
    this.form = {
      ...this.exam,
      exam_at: moment(this.exam.exam_at),
      person:{
        ...this.exam.person,
        cityObject: {
          label: `${this.exam.person.city.title} - ${this.exam.person.city.state.letter}`,
          value: this.exam.person.city
        }
      }
    }
  }
}
</script>

<style scoped>

</style>