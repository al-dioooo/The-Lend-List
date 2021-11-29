<template>
    <app-layout title="Data List">
        <topbar title="Data List" />

        <div class="overflow-y-auto">
            <div class="m-10 space-y-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <input type="text" placeholder="Search" v-model="params.search" autocomplete="off" class="px-4 py-2 transition bg-gray-100 border focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200"/>
                        <transition name="pop">
                            <div v-if="params.search" @click="reset" class="transition cursor-pointer active:hover:scale-95">
                                Reset
                            </div>
                        </transition>
                    </div>

                    <div>
                        <create :item="item" :borrower="borrower" />
                    </div>
                </div>
                {{$props.message}}
                <table
                    class="min-w-full overflow-hidden divide-y divide-gray-200 shadow rounded-xl">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                Item
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                Borrower
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                Borrowed At
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase ">
                                Returned At
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
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!-- <div class="text-sm font-medium text-gray-900 overflow-ellipsis">
                                    {{datasheet.items}}
                                </div> -->
                                <div class="overflow-hidden text-sm text-gray-500 w-44 overflow-ellipsis" v-if="datasheet.items">
                                    <template v-for="item in datasheet.items" :key="item.id">
                                        {{item.name}}
                                    </template>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="overflow-hidden text-sm font-medium text-gray-900 overflow-ellipsis">
                                    {{datasheet.borrower.name}}
                                </div>
                                <div class="overflow-hidden text-sm text-gray-500 overflow-ellipsis">
                                    {{datasheet.borrower.email ? datasheet.borrower.email : datasheet.borrower.contact}}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span v-if="datasheet.is_returned != null" class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                    Returned
                                </span>
                                <span v-if="datasheet.is_returned == null" class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">
                                    Borrowed
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{datasheet.borrowed_at}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{datasheet.is_returned != null ? datasheet.returned_at : 'Not returned yet'}}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <inertia-link :href="route('data-list.show', datasheet)" class="inline-flex items-center p-2 space-x-4 text-white transition bg-gray-800 rounded-full active:hover:scale-90">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </inertia-link>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <pagination :links="datasheet.links" :first="datasheet.from" :last="datasheet.to" :total="datasheet.total" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Shared/Layout/AppLayout'
import Topbar from '@/Shared/Component/Topbar'
import Pagination from '@/Shared/Component/Pagination'
import Create from '@/Pages/List/Create'
import { InertiaLink } from '@inertiajs/inertia-vue3'

export default defineComponent({
    components: {
        AppLayout,
        Topbar,
        Pagination,
        Create,
        InertiaLink
    },

    props: {
        datasheet: Object,
        item: Object,
        borrower: Object,
        result: [String, Number]
    },

    data() {
        return {
            params: {
                search: route().params.search,
                page: route().params.page,
            }
        }
    },

    methods: {
        reset() {
            let params = this.params

            Object.keys(params).forEach(key => {
                delete params[key]
            })
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

                this.$inertia.get(route('data-list.index'), this.params, {
                    replace: true,
                    preserveState: true
                })
            },

            deep: true
        }
    }
})
</script>
