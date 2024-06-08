<template>
  <Head title="Ficha de impreessão" />
  <div class="book">
    <div v-for="exam in exams" class="page">
      <div class="subpage">
        <!-- CADASTRO -->
        <div class="flex justify-between items-end">
          <h1 class="font-bold">CADASTRO</h1>
          <img src="/assets/img/logo.svg" style="height: 70px">
          <p class="font-bold"><span>OS: {{ exam.id }}</span><span class="mx-4 inline">Data: {{formatedDate(exam.exam_at)}}</span> <span class="mr-4">Horário: {{ formatedHour(exam.exam_at) }}</span></p>
        </div>
        <div class="border border-gray-700">
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-8/12">
              <span class="bg-gray-200 cell-a font-bold">Nome: </span>
              <span class="px-2">{{exam.person.name}}</span>
            </div>
            <div class="inline-block w-4/12">
              <span class="bg-gray-200 cell-a font-bold">Telefone: </span>
              <span class="px-2">{{formatedPhone(exam.person.phone)}}</span>
            </div>
          </div>

          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-8/12">
              <span class="bg-gray-200 cell-a font-bold">Endereço: </span>
              <span class="px-2">{{exam.person.address}}</span>
            </div>
            <div class="inline-block w-4/12">
              <span class="bg-gray-200 cell-a font-bold">CPF: </span>
              <span class="px-2">{{formatedDocument(exam.person.document)}}</span>
            </div>
          </div>

          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-6/12">
              <span class="bg-gray-200 cell-a font-bold">Cidade/UF: </span>
              <span class="px-2">{{exam.person.city.title}} / {{exam.person.city.state.letter}}</span>
            </div>
            <div class="inline-block w-4/12">
              <span class="bg-gray-200 cell-a font-bold">Apelido: </span>
              <span class="px-2">{{exam.person.nickname}}</span>
            </div>
            <div class="inline-block w-2/12">
              <span class="bg-gray-200 cell-a font-bold" style="width: 70px">Idade: </span>
              <span class="px-2">{{exam.person.age}}</span>
            </div>
          </div>

          <!--ROW-->
          <div>
            <div class="inline-block w-8/12">
              <span class="bg-gray-200 cell-b font-bold">Ponto de Referência: </span>
              <span class="px-2">{{exam.person.address_reference}}</span>
            </div>
            <div class="inline-block w-4/12">
              <span class="bg-gray-200 cell-a font-bold">ACS: </span>
              <span class="px-2">{{exam.person.acs}}</span>
            </div>
          </div>
        </div>

        <hr style="border-top: 2px dashed rgba(0,0,0,0.7); width: 100%; margin: 15px 0px 5px">

        <!-- RECEITA -->
        <div class="flex items-end">
          <h1 class="font-bold mr-32">RECEITA</h1>
          <img src="/assets/img/logo.svg" style="height: 70px">
          <!-- p><span class="mr-4 inline">Data:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class="mr-4">Horário:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span>Atendimento: {{ exam.id }}</span></p -->
        </div>
        <div class="border border-gray-700 mt-2">
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-12/12">
              <span class="cell-a font-bold">Obs: </span>
              <span class="px-2">{{exam.notes}}</span>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-6/12">
              <div class="w-4/12 px-3 inline-block">
                <div class="font-10 flex items-center gap-2">
                  Diabetes <i class="far fa-square font-18"></i>
                </div>
              </div>
              <div class="w-4/12 px-3 font-10 inline-block">
                <div class="font-10 flex items-center gap-2">
                  Hipertensão <i class="far fa-square font-18"></i>
                </div>
              </div>
              <div class="w-4/12 px-3 font-10 inline-block">
                <div class="font-10 flex items-center gap-2">
                  Grávida <i class="far fa-square font-18"></i>
                </div>
              </div>
            </div>
            <div class="inline-block w-6/12">
              <div class="inline-block">
                <span class="font-bold">PIO</span>
              </div>
              <div class="px-3 inline-block">
                <span style="margin-right: 100px">OD</span>
                <span class="cell-a">OE</span>
              </div>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-6/12">
              <div class="inline-block">
                <span class="cell-a font-bold">HGT: </span>
              </div>
              <div class="inline-block">

              </div>
            </div>
            <div class="inline-block w-6/12">
              <div class="inline-block">
                <span class="cell-a font-bold">Cirurgia: </span>
              </div>
              <div class="inline-block">
                <div class="px-3 font-10 inline-block">
                  <div class="font-10 flex items-center gap-2">
                    Sim <i class="far fa-square font-18 ml-2"></i>
                  </div>
                </div>
                <div class="px-3 font-10 inline-block" style="margin-left: 40px">
                  <div class="font-10 flex items-center gap-2">
                    Não <i class="far fa-square font-18 ml-2"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-6/12">
              <div class="inline-block">
                <span class="cell-a font-bold">Usa Óculos? </span>
              </div>
              <div class="inline-block">
                <div class="px-3 font-10 inline-block">
                  <div class="font-10 flex items-center gap-2">
                    Sim <i class="far fa-square font-18 ml-2"></i>
                  </div>
                </div>
                <div class="px-3 font-10 inline-block" style="margin-left: 40px">
                  <div class="font-10 flex items-center gap-2">
                    Não <i class="far fa-square font-18 ml-2"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="inline-block w-6/12">
              <div class="inline-block">
                <span class="cell-a font-bold">Parou? </span>
              </div>
              <div class="inline-block">
                <div class="px-3 font-10 inline-block">
                  <div class="font-10 flex items-center gap-2">
                    Sim <i class="far fa-square font-18 ml-2"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-full font-bold text-center py-1">
              &nbsp
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-2/12 border-r border-gray-700 py-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1 font-bold text-center">
              ESFÉRICO
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1 font-bold text-center uppercase">
              Cilíndrico
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1 font-bold text-center uppercase">
              Eixo
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1 font-bold text-center uppercase">
              DNP
            </div>
            <div class="inline-block w-2/12 p-1 font-bold text-center uppercase">
              Altura
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-2/12 border-r border-gray-700 py-1 px-2 font-bold text-center">
              OD
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 p-1">
              &nbsp
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-2/12 border-r border-gray-700 py-1 px-2 font-bold text-center">
              OE
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 p-1">
              &nbsp
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700 py-2 flex justify-center">
            <div class="inline-block w-6/12">
              <div class="flex items-center">
                <span class="cell-a font-bold uppercase">Adição</span>
                <div class="border border-black border-2 inline-block" style="width: 200px; height: 50px"></div>
              </div>
            </div>
            <div class="inline-block w-6/12">
              <div class="border border-black border-2 inline-block" style="width: 120px; height: 50px">
                <div class="flex items-center justify-center" style="height: 50px">
                  <span class="font-bold uppercase">Responsável</span>
                </div>
              </div>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-12/12">
              <span class="cell-a font-bold">Tipo de Lente: </span>
            </div>
          </div>
        </div>
        <p class="mt-1" style="font-size: 11.7px">Durante o período de 15 dias de adaptação podem ocorrer os seguintes sintomas: Dor de cabeça, náuseas, tonturas e outros incômodos</p>

        <hr style="border-top: 2px dashed rgba(0,0,0,0.7); width: 100%; margin: 15px 0px 5px">

        <!-- DECLARACAO -->
        <div class="flex justify-between items-end">
          <h1 class="font-bold">DECLARAÇÃO</h1>
          <img src="/assets/img/logo.svg" style="height: 70px">
          <p class="font-bold"><span>OS: {{ exam.id }}</span> <span class="mx-4 inline">Data: {{ formatedDate(exam.exam_at) }}</span> <span class="">Horário: {{ formatedHour(exam.exam_at) }}</span></p>
        </div>
        <div class="border border-gray-700 mt-2">
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-7/12">
              <span class="bg-gray-200 cell-a font-bold">Nome: </span>
              <span class="px-2">{{exam.person.name}}</span>
            </div>
            <div class="inline-block w-5/12">
              <span class="bg-gray-200 cell-a font-bold">CPF: </span>
              <span class="px-2">{{formatedDocument(exam.person.document)}}</span>
            </div>
          </div>

          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-7/12">
              <span class="bg-gray-200 cell-a font-bold">Endereço: </span>
              <span class="px-2">{{exam.person.address}}</span>
            </div>
            <div class="inline-block w-5/12">
              <span class="bg-gray-200 cell-a font-bold">Cidade/UF: </span>
              <span class="px-2">{{exam.person.city.title}} / {{exam.person.city.state.letter}}</span>
            </div>
          </div>

        </div>

        <div class="mt-8">
          <p class="w-full text-center font-bold" style="font-size: 13px">
            Declaro para todos os fins, estar ciente da livre escolha, na aquisição de qualquer medicamento, produtos, óculos, lentes e suas variadas marcas e modelos. Não tendo assim, a obrigatoriedade por qualquer estabelecimento que venha a ser indicado por terceiros. Autorizo a utilização da minha imagem por foto ou vídeo pela Associação Melhor de Ver.
          </p>

          <p class="w-full text-center font-bold" style="font-size: 14px">
            "Declaro para todos os fins, que recebi o exame oftalmológico de forma gratuita pela Associação Melhor de Ver".
          </p>

          <p class="w-full text-center font-bold" style="font-size: 14px">
            Autorizo a Associação Melhor De Ver tratar meus Dados Pessoais de acordo com a LGPD e autorizo e concordo com seu arquivamento digital de acordo com o Decreto 10.278/2020.
          </p>
        </div>

        <div class="flex justify-center" style="margin-top: 60px;">
          <div class="border-t border-gray-700 w-7/12 mt-8 font-bold text-center pt-1">
            ASSINATURA
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import {Head} from "@inertiajs/inertia-vue3";

export default {
  name: "Exam-Report",
  props:{
    exams: Object
  },
  components:{
    Head
  },
  methods:{
    formatedDate(exam_at){
      return moment(exam_at).format("DD/MM/yyyy")
    },
    formatedHour(exam_at){
      return moment(exam_at).format("hh:mm")
    },
    formatedPhone(phone){
      if(phone.length == 10){
        return phone.replace(/^(\d{2})(\d{4})(\d{4}).*/, '($1) $2-$3')
      }

      return phone.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3')
    },
    formatedDocument(document){
      if(document == null ) return ""

      return document.replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/, '$1.$2.$3-$4')
    }
  },
  mounted(){
    setTimeout(()=>{
      window.print()
    },500)
  }
}
</script>

<style scoped>
.inline-block{
  display: inline-block;
}
.cell-a{
  width: 110px;
  display: inline-block;
  padding: 0.28rem 0 0.28rem 10px;
}
.cell-b{
  width: 150px;
  display: inline-block;
  padding: 0.28rem 0;
  text-align: center;
}
body {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  background-color: #FAFAFA;
  font: 10pt "Arial";
}
* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  font-size: 10pt;
}
.page {
  width: 210mm;
  min-height: 297mm;
  padding: 5mm 10mm;
  margin: 10mm auto;
  border: 1px #D3D3D3 solid;
  border-radius: 5px;
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
  padding: 0cm;
  height: 257mm;
}

@page {
  size: A4;
  margin: 0;
}
@media print {
  *{
    print-color-adjust: exact;
  }
  html, body {
    width: 210mm;
    height: 297mm;
  }
  .page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
  }
}
.font-10{
  font-size: 10px;
}
.font-18{
  font-size: 18px;
}
</style>
