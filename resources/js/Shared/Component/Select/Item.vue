<template>
  <Listbox as="div" v-model="selected">
    <ListboxLabel class="block text-sm font-medium text-gray-700">
      Item
    </ListboxLabel>
    <div class="relative mt-1">
      <ListboxButton class="relative w-full py-2 pl-3 pr-10 text-left transition bg-white border border-gray-300 rounded-md shadow-sm cursor-default focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm">
          <span :class="{ 'text-gray-500' : !selected }" class="block truncate" v-html="selected ? selected.name : 'Select item'"></span>
          <span class="block text-gray-500 truncate" v-html="selected ? selected.description : ''"></span>
        <span class="absolute inset-y-0 right-0 flex items-center pr-2 ml-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
        </span>
      </ListboxButton>

      <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">
        <ListboxOptions class="absolute z-10 w-full p-1 mt-1 overflow-hidden text-base bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
            <div class="relative h-auto">
                <input v-model="search" autocomplete="off" type="text" placeholder="Search list" class="block w-full px-3 py-2 mb-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm">
                <div class="absolute inset-0 flex items-center justify-end pr-4 pointer-events-none" v-if="isLoading">
                    <div class="w-4 h-4 border-t border-b border-gray-900 rounded-full animate-spin"></div>
                </div>
            </div>
          <div class="pr-1 overflow-auto max-h-40">
              <ListboxOption as="template" v-for="row in datasheet" :key="row.id" :value="row" v-slot="{ active, selected }">
                <li :class="[active ? 'text-white bg-gray-800' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9 rounded-md']">
                <div class="flex flex-col">
                    <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">
                    {{ row.name }}
                    </span>
                    <span class="text-gray-500">
                    {{ row.description }}
                    </span>
                </div>

                <span v-if="selected" :class="[active ? 'text-white' : 'text-grey-800', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </span>
                </li>
            </ListboxOption>
          </div>
        </ListboxOptions>
      </transition>
    </div>
  </Listbox>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'

export default defineComponent({
  components: {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
  },

  data() {
      return {
          datasheet: null,
          selected: ref(),
          search: null,

          refCount: 0,
          isLoading: false
      }
  },

  mounted() {
      this.getItem()
  },

  watch: {
      search: {
          handler() {
              this.getItem()
          }
      }
  },

  created() {
      axios.interceptors.request.use((config) => {
          this.setLoading(true)
          return config
      }, (error) => {
          this.setLoading(false)
          return Promise.reject(error)
      })

      axios.interceptors.response.use((response) => {
          this.setLoading(false)
          return response
      }, (error) => {
          this.setLoading(false)
          return Promise.reject(error)
      })
  },

  methods: {
      setLoading(isLoading) {
        if (isLoading) {
            this.refCount++;
            this.isLoading = true;
        } else if (this.refCount > 0) {
            this.refCount--;
            this.isLoading = (this.refCount > 0);
        }
        },
      getItem() {
          axios.get(route('item.get', {
              search: this.search
          })).then(response => {
              this.datasheet = response.data
              console.log(response)
          }).catch(error => {
              console.log(error)
          })
      }
  }
})
</script>
