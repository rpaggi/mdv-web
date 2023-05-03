<template>
  <div class="relative">
    <div class="cursor-pointer border border-gray shadow-sm focus:ring-system-500 focus:border-system-500 block w-full sm:text-sm border-gray-300 rounded-md px-4 py-2 inline-flex text-gray-400" @click.stop="toggleShow">
      <i class="far fa-clock" style="width: 1rem;padding: 3px 0"></i>
      <span class="px-3" v-if="firstSelected!==null && lastSelected!==null">
        {{items[minSelected]}} - {{items[maxSelected]}}
      </span>
    </div>
    <div class="absolute cursor-pointer btn-clean" @click.stop="cleanData" v-if="firstSelected!==null && lastSelected!==null">
      <i class="far fa-times text-gray-400 hover:text-gray-600"></i>
    </div>
    <div class="absolute border border-gray picker-dialog" v-if="show">
      <div class="arrow-top"></div>
      <ul class="grid grid-cols-3 h-28 overflow-y-auto gap-y-1">
        <li
          class="flex items-center justify-center cursor-pointer hover:text-blue-400"
          :class="{
            'bg-blue-100': minSelected !== null && index > minSelected && index < maxSelected,
            'bg-blue-300 text-blue-600':index==firstSelected || index==lastSelected,
            'rounded-l-md': index==minSelected,
            'rounded-r-md': index==maxSelected
          }"
          v-for="(item, index) in items"
          @click.stop="select(index)"
        >
          {{ item }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "HsTimePicker",
  props:{
    items: Array,
    modelValue:{
      type:Object,
      default: null
    },
  },
  data(){
    return {
      show:false,
      firstSelected: null,
      lastSelected: null
    }
  },
  computed:{
    minSelected(){
      if(this.firstSelected == null && this.lastSelected == null){
        return null
      }

      if(this.firstSelected > this.lastSelected){
        return this.lastSelected
      }

      return this.firstSelected
    },
    maxSelected(){
      if(this.firstSelected == null && this.lastSelected == null){
        return null
      }

      if(this.firstSelected < this.lastSelected){
        return this.lastSelected
      }

      return this.firstSelected
    }
  },
  methods:{
    toggleShow(){
      this.show = !this.show
    },
    closeIfOpen(event){
      if(this.$el == event.target || this.$el.contains(event.target))
        return

      if(this.show)
        this.show = false
    },
    select(index){
      if(this.firstSelected !== null && this.lastSelected !== null){
        this.firstSelected = null
        this.lastSelected = null
      }

      if(this.firstSelected === null){
        this.firstSelected = index
        return
      }

      this.lastSelected = index
      this.$emit('update:modelValue', {first:this.items[this.minSelected], last:this.items[this.maxSelected]})
      this.show = false
    },
    cleanData(){
      this.firstSelected = null
      this.lastSelected = null
      this.$emit('update:modelValue', null)
    }
  },
  mounted() {
    document.body.addEventListener('click', this.closeIfOpen, true)
    setTimeout(()=>{
      if(this.modelValue){
        let first = this.items.indexOf(this.modelValue.first)
        let last = this.items.indexOf(this.modelValue.last)
        this.firstSelected = first > -1 ? first : null
        this.lastSelected = last > -1 ? last : null
      }
    }, 200)
  },
  beforeUnmount() {
    document.body.removeEventListener('click', this.closeIfOpen)
  }
}
</script>

<style scoped>
.picker-dialog{
  width: 100%;
  background: white;
  top: 47px;
  border-radius: 3px;
  padding: 15px 10px;
}

.arrow-top{
  left: 50%;
  top: -1px;
  height: 12px;
  width: 12px;
  background-color: white;
  position: absolute;
  border-left: 1px solid rgb(209 213 219);
  border-top: 1px solid rgb(209 213 219);
  transform: translate(-50%, -50%) rotate(45deg);
}

.btn-clean{
  top:8px;
  right: 12px;
}
</style>