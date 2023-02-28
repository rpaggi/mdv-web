<template>
  <div class="book">
    <div v-for="exam in exams" class="page">
      <div class="subpage">
        <!-- CADASTRO -->
        <div class="flex justify-between items-center">
          <img src="/assets/img/logo.svg" style="height: 50px">
          <h1 class="font-bold">CADASTRO</h1>
          <p><span class="mr-4 inline">Data: {{formatedDate(exam.exam_at)}}</span> <span>Horário: {{ formatedHour(exam.exam_at) }}</span></p>
        </div>
        <div class="border border-gray-700 mt-2">
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-7/12">
              <span class="bg-gray-200 cell-a font-bold">Nome: </span>
              <span class="px-2">{{exam.person.name}}</span>
            </div>
            <div class="inline-block w-5/12">
              <span class="bg-gray-200 cell-a font-bold">Idade: </span>
              <span class="px-2">{{exam.person.age}}</span>
            </div>
          </div>

          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-7/12">
              <span class="bg-gray-200 cell-a font-bold">Telefone: </span>
              <span class="px-2">{{formatedPhone(exam.person.phone)}}</span>
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
              <span class="px-2">{{exam.person.city.title}}/{{exam.person.city.state.letter}}</span>
            </div>
          </div>

          <!--ROW-->
          <div>
            <div class="inline-block w-7/12">
              <span class="bg-gray-200 cell-b font-bold">Ponto de Referencia: </span>
              <span class="px-2">{{exam.person.address_reference}}</span>
            </div>
            <div class="inline-block w-5/12">
              <span class="bg-gray-200 cell-a font-bold">ACS: </span>
              <span class="px-2">{{exam.person.acs}}</span>
            </div>
          </div>
        </div>

        <hr style="border-top: 2px dashed rgba(0,0,0,0.7); width: 100%; margin: 15px 0px 5px">

        <!-- CONSULTA -->
        <div class="flex justify-between items-center">
          <img src="/assets/img/logo.svg" style="height: 50px">
          <h1 class="font-bold">CONSULTA</h1>
          <p><span class="mr-4 inline">Data:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span>Horário: </span></p>
        </div>
        <div class="border border-gray-700 mt-2">
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-6/12">
              <span class="bg-gray-200 cell-a font-bold">Nome: </span>
            </div>
            <div class="inline-block w-6/12">
              <span class="bg-gray-200 cell-a font-bold">CPF: </span>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-6/12">
              <div class="w-4/12 px-3 font-10 inline-block">
                Diabétes <i class="far fa-circle"></i>
              </div>
              <div class="w-4/12 px-3 font-10 inline-block">
                Hipertensão <i class="far fa-circle"></i>
              </div>
              <div class="w-4/12 px-3 font-10 inline-block">
                Grávida <i class="far fa-circle"></i>
              </div>
            </div>
            <div class="inline-block w-6/12">
              <div class="inline-block">
                <span class="bg-gray-200 cell-a font-bold">PIO: </span>
              </div>
              <div class="px-3 inline-block">
                <span class="font-bold" style="margin-right: 100px">OD</span>
                <span class="font-bold">OE</span>
              </div>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-6/12">
              <div class="inline-block">
                <span class="bg-gray-200 cell-a font-bold">Usa Óculos: </span>
              </div>
              <div class="inline-block">
                <div class="px-3 font-10 inline-block">
                  Sim <i class="far fa-circle ml-2"></i>
                </div>
                <div class="px-3 font-10 inline-block" style="margin-left: 40px">
                  Não <i class="far fa-circle ml-2"></i>
                </div>
              </div>
            </div>
            <div class="inline-block w-6/12">
              <div class="inline-block">
                <span class="bg-gray-200 cell-a font-bold">Cirurgia: </span>
              </div>
              <div class="inline-block">
                <div class="px-3 font-10 inline-block">
                  Sim <i class="far fa-circle ml-2"></i>
                </div>
                <div class="px-3 font-10 inline-block" style="margin-left: 40px">
                  Não <i class="far fa-circle ml-2"></i>
                </div>
              </div>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-12/12">
              <span class="bg-gray-200 cell-a font-bold">Observação: </span>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-full bg-gray-200 font-bold text-center py-1">
              RECEITA
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-2/12 border-r border-gray-700 py-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1 font-bold">
              Esférico
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1 font-bold">
              Cilindrico
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1 font-bold">
              Eixo
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1 font-bold">
              DNP
            </div>
            <div class="inline-block w-2/12 p-1 font-bold">
              Altura
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="bg-gray-200 inline-block w-2/12 border-r border-gray-700 py-1 px-2 font-bold">
              OD:
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="bg-gray-200 inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="bg-gray-200 inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 p-1">
              &nbsp
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="bg-gray-200 inline-block w-2/12 border-r border-gray-700 py-1 px-2 font-bold">
              OE:
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="bg-gray-200 inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="bg-gray-200 inline-block w-2/12 border-r border-gray-700 p-1">
              &nbsp
            </div>
            <div class="inline-block w-2/12 p-1">
              &nbsp
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-6/12">
              <span class="bg-gray-200 cell-a font-bold">Adição: </span>
            </div>
            <div class="inline-block w-6/12">
              <span class="bg-gray-200 cell-a font-bold">Responsável: </span>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-12/12">
              <span class="bg-gray-200 cell-a font-bold">Tipo de Lente: </span>
            </div>
          </div>
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-full bg-gray-200 py-1">
              &nbsp
            </div>
          </div>
        </div>
        <p class="mt-1" style="font-size: 11.7px">Durarnte o período de 15 dias de adaptação podem ocorrer os seguintes sintomas: Dor de cabeça, náuseas, tonturas e outros incômodos</p>

        <hr style="border-top: 2px dashed rgba(0,0,0,0.7); width: 100%; margin: 15px 0px 5px">

        <!-- DECLARACAO -->
        <div class="flex justify-between items-center">
          <img src="/assets/img/logo.svg" style="height: 50px">
          <h1 class="font-bold">DECLARAÇÃO</h1>
          <p><span class="mr-4 inline">Data: {{ formatedDate(exam.exam_at) }}</span> <span>Horário: {{ formatedHour(exam.exam_at) }}</span></p>
        </div>
        <div class="border border-gray-700 mt-2">
          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-7/12">
              <span class="bg-gray-200 cell-a font-bold">Nome: </span>
              <span class="px-2">{{exam.person.name}}</span>
            </div>
            <div class="inline-block w-5/12">
              <span class="bg-gray-200 cell-a font-bold">Idade: </span>
              <span class="px-2">{{exam.person.age}}</span>
            </div>
          </div>

          <!--ROW-->
          <div class="border-b border-gray-700">
            <div class="inline-block w-7/12">
              <span class="bg-gray-200 cell-a font-bold">Telefone: </span>
              <span class="px-2">{{ formatedPhone(exam.person.phone) }}</span>
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
              <span class="px-2">{{exam.person.city.title}}/{{exam.person.city.state.letter}}</span>
            </div>
          </div>

          <!--ROW-->
          <div>
            <div class="inline-block w-7/12">
              <span class="bg-gray-200 cell-b font-bold">Ponto de Referencia: </span>
              <span class="px-2">{{exam.person.address_reference}}</span>
            </div>
            <div class="inline-block w-5/12">
              <span class="bg-gray-200 cell-a font-bold">ACS: </span>
              <span class="px-2">{{exam.person.acs}}</span>
            </div>
          </div>
        </div>
        <p class="mt-1 w-full text-center" style="font-size: 11.7px">
          "Declaro para todos os fins, que recebi o exame oftalmológico de forma gratuita pela Associação Melhor de Ver".
        </p>
        <p class="w-full text-center font-bold" style="font-size: 13px">
          "Declaro para todos os fins, estar ciente da livre escolha, na aquisição de qualquer medicamento, produtos, óculos, lentes e suas variadas marcas e modelos. Não tendo assim, a obrigatoriedade por qualquer estabelecimento que venha a ser indicado por terceiros.".
        </p>
        <div class="flex justify-center">
          <div class="border-t border-gray-700 w-7/12 mt-8 font-bold text-center pt-1">
            ASSINATURA
          </div>
        </div>

        <hr style="border-top: 2px dashed rgba(0,0,0,0.7); width: 100%; margin: 10px 0px 5px">
        <h1 class="w-full font-bold text-center">RETORNO</h1>
        <!--ROW-->
        <div>
          <div class="inline-block w-6/12">
            <span class="font-bold pl-2">Nome: </span>
          </div>
          <div class="inline-block w-3/12">
            <span class="font-bold pl-2">Data: </span>
          </div>
          <div class="inline-block w-3/12">
            <span class="font-bold pl-2">Horário: </span>
          </div>
        </div>
        <div>
          <div class="border-l border-t border-b border-gray-700 inline-block w-6/12" style="height: 30px">
          </div>
          <div class="border border-gray-700 inline-block w-3/12" style="height: 30px">
          </div>
          <div class="border-r border-t border-b border-gray-700 inline-block w-3/12" style="height: 30px">
          </div>
        </div>
        <div class="flex justify-center w-full">
          <img src="/assets/img/logo.svg" style="height: 50px">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";

export default {
  name: "Exam-Report",
  props:{
    exams: Object
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
  padding: 0.28rem 0;
  text-align: center;
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
</style>