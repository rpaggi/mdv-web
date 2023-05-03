<template>
  <div class="mt-4 px-2 ">
    <!-- This example requires Tailwind CSS v2.0+ -->
    <nav class="border-t border-gray-300 px-4 flex items-center justify-between sm:px-0">
      <div class="-mt-px w-0 flex-1 flex">
        <inertia-link v-if="paginate.prev_page_url" :href="term ? `${paginate.prev_page_url}&term=${term}` : paginate.prev_page_url" class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
          <!-- Heroicon name: solid/arrow-narrow-left -->
          <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
          </svg>
          Anterior
        </inertia-link>
      </div>
      <div class="hidden md:-mt-px md:flex">
        <inertia-link
            v-for="link in cleanLinks" :key="link.label"
            :href="link.url"
            :class="{'border-system-500 text-system-600':link.active}"
            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"
        >
          {{ link.label }}
        </inertia-link>
      </div>
      <div class="-mt-px w-0 flex-1 flex justify-end">
        <inertia-link v-if="paginate.next_page_url" :href="term ? `${paginate.next_page_url}&term=${term}` : paginate.next_page_url" class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
          Próximo
          <!-- Heroicon name: solid/arrow-narrow-right -->
          <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </inertia-link>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "HsPaginate",
  props:{
    paginate: Object
  },
  data(){
    return {
      filters: {}
    }
  },
  computed:{
    cleanLinks(){
      const cleanLinks = [ ...this.paginate.links ]
      cleanLinks.shift()
      cleanLinks.pop()

      let filters = ''
      Object.keys(this.filters).forEach(key=>{
        filters = `${filters}&${key}=${this.filters[key]}`
      })

      return cleanLinks.map(link=>({
        ...link,
        url: `${link.url}${filters}`
      }))
    }
  },
  beforeMount() {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    Object.keys(params).forEach(param=>{
      if(param == "page") return
      this.filters[param] = params[param]
    })
  }
}
</script>

<style scoped>

</style>