
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-10 py-8">
                  <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Agendamentos</h3>
                    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                      <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">No Dia</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ (counts.day).toLocaleString('pt-BR') }}</dd>
                      </div>

                      <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">Na Semana</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ (counts.week).toLocaleString('pt-BR') }}</dd>
                      </div>

                      <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                        <dt class="truncate text-sm font-medium text-gray-500">No Mês</dt>
                        <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ (counts.month).toLocaleString('pt-BR') }}</dd>
                      </div>
                    </dl>
                  </div>
                  <exam-by-agent></exam-by-agent>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue';
import ExamByAgent from "../Components/Dashboard/ExamByAgent.vue";

export default {
  name: "Dashboard",
  components:{
    AppLayout,
    ExamByAgent
  },
  props:{
    counts: Object
  }
}
</script>