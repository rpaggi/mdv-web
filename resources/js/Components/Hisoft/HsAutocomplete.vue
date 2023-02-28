<template>
  <label :for="name" class="block text-sm font-medium text-gray-700">{{label}}</label>
  <div>
    <input
        type="text"
        name="description"
        :id="name"
        v-model="displayValue"
        @input="onInput"
        :class="$attrs.class"
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md px-4 py-2"
        :placeholder="placeholder"
        @keydown.down.stop="keyDown"
        @keydown.up.stop="keyUp"
        @keydown.enter.stop="select(selected)"
        @keydown.esc.stop="showOptions=false"
        @focus="showOptions=true"
        @click.stop="showOptions=true"
        @blur="showOptions=false"
        autocomplete="off"
        :disabled="disabled"
    />
    <ul v-if="showOptions" class="bg-white border-gray-300 border shadow-sm absolute w-1/3 py-2 rounded-md z-50 hs-autocomplete-list">
      <li
          v-for="(item, index) in displayList"
          :key="index"
          :class="{'bg-gray-100':selected===index}"
          class="hover:bg-gray-100 px-3 cursor-pointer"
          @mouseover="selected=index"
          @mousedown.stop="select(index)"
      >
        {{ item[fieldLabel] }}
      </li>
      <li v-if="displayList.length === 0" class="text-gray-300 px-3">Nenhum item encontrado</li>
    </ul>
  </div>
  <div v-if="error">
    <p class="text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>

<script>
export default {
  name: "HsAutocomplete",
  props: {
    name:String,
    label:String,
    error:String,
    modelValue:{
      type:Object,
      default: null
    },
    disabled: Boolean,
    placeholder:String,
    list:{
      type:Array,
      default:()=>[]
    },
    fieldLabel:String,
    listSize:{
      type:Number,
      default: 10
    }
  },
  emits: ['update:modelValue'],
  data(){
    return {
      showOptions: false,
      selected: -1,
      displayValue: '',
      displayList: []
    }
  },
  methods:{
    onInput(){
      this.selected = -1
      this.$emit('update:modelValue', null)
      this.displayList = this.list.filter((item)=>{
        return item[this.fieldLabel].toUpperCase().includes(this.displayValue.toUpperCase())
      })
      this.displayList = this.displayList.slice(0,this.listSize)
      this.showOptions = true
    },
    keyDown(){
      if(this.selected > this.displayList.length-2){
        return
      }
      this.selected++
    },
    keyUp(){
      if(this.selected < 1){
        return
      }
      this.selected--
    },
    select(index){
      this.displayValue = this.displayList[index][this.fieldLabel]
      this.$emit('update:modelValue', this.displayList[index])
      this.showOptions = false
    }
  },
  mounted() {
    setTimeout(()=>{
      if(this.modelValue){
        this.displayValue = this.modelValue[this.fieldLabel];
      }
    }, 200)
    this.displayList = this.list.slice(0,this.listSize)
  },
  beforeUpdate() {
    if(!this.displayValue){
      this.displayList = this.list.slice(0,this.listSize)
    }
    if(this.modelValue){
      if(this.displayValue !== this.modelValue[this.fieldLabel]){
        this.displayValue = this.modelValue[this.fieldLabel]
      }
    }
  },
  start(){
    setTimeout(()=>{
      if(this.modelValue){
        this.displayValue = this.modelValue[this.fieldLabel];
      }
    }, 200)
    this.displayList = this.list.slice(0,this.listSize)
  }
}
</script>

<style lang="scss">

</style>
