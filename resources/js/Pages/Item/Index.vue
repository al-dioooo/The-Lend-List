<template>
    <app-layout title="Item List">
        <topbar title="Item List" />

        <div class="overflow-y-auto">
            <div class="m-10 space-y-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <input type="text" placeholder="Search" v-model="params.search" autocomplete="off" class="px-4 py-2 transition bg-gray-100 border focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200"/>
                        <transition name="pop">
                            <button v-if="params.search" @click="reset" class="transition active:hover:scale-95">
                                Reset
                            </button>
                        </transition>
                    </div>

                    <div>
                        <create />
                    </div>
                </div>
                <table
                    class="min-w-full overflow-hidden divide-y divide-gray-200 shadow rounded-xl">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                Created At
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                Updated At
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="text-center" v-if="result == 0 && route().params.search == null">
                            <td colspan="7" class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                No list available
                            </td>
                        </tr>

                        <tr class="text-center" v-if="result == 0 && route().params.search != null">
                            <td colspan="7" class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                No result
                            </td>
                        </tr>

                        <tr v-for="datasheet in datasheet.data" :key="datasheet.id">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                {{datasheet.name}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{datasheet.description}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{datasheet.created_at}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{datasheet.updated_at}}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <div class="inline-flex items-center space-x-4">
                                    <button @click="edit(datasheet)" class="text-blue-600 hover:text-blue-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>

                                    <button @click="destroy(datasheet)" class="text-red-600 hover:text-red-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <pagination :links="datasheet.links" :first="datasheet.from" :last="datasheet.to" :total="datasheet.total" />
            </div>
        </div>

        <edit :datasheet="modalData" :show="isOpen && isEditing" @close="closeModal" />
        <delete :datasheet="modalData" :show="isOpen && isDeleting" @close="closeModal" />
    </app-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import AppLayout from '@/Shared/Layout/AppLayout'
import Topbar from '@/Shared/Component/Topbar'
import Pagination from '@/Shared/Component/Pagination'
import Create from '@/Pages/Item/Create'
import Edit from '@/Pages/Item/Edit'
import Delete from '@/Pages/Item/Delete'

export default defineComponent({
    components: {
        AppLayout,
        Topbar,
        Pagination,
        Create,
        Edit,
        Delete
    },

    props: {
        datasheet: Object,
        result: [String, Number]
    },

    data() {
        return {
            params: {
                search: route().params.search
            },

            modalData: null,
            isOpen: ref(false),
            isEditing: ref(false),
            isDeleting: ref(false)
        }
    },

    methods: {
        reset() {
            let params = this.params

            Object.keys(params).forEach(key => {
                delete params[key]
            })
        },

        edit(data) {
            this.modalData = data,
            this.editing()
        },

        destroy(data) {
            this.modalData = data,
            this.deleting()
        },

        editing() {
            this.isEditing = true
            this.isOpen = true
        },

        deleting() {
            this.isDeleting = true
            this.isOpen = true
        },

        closeModal() {
            this.isOpen = false
            this.isEditing = false
            this.isDeleting = false
        }
    },

    watch: {
        params: {
            handler() {
                let params = this.params

                Object.keys(params).forEach(key => {
                    if (params[key] == '') {
                        delete params[key]
                    }
                })

                this.$inertia.get(route('item.index'), this.params, {
                    replace: true,
                    preserveState: true
                })
            },

            deep: true
        }
    }
})
</script>
