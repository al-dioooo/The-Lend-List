<template>
    <app-layout title="Data Report">
        <topbar title="Data Report" />

        <div class="overflow-y-auto">
            <div class="m-10 space-y-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div>
                            <select v-model="params.year" class="py-2 pl-4 pr-8 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white">
                                <template v-for="row in year" :key="row">
                                    <option :value="row" v-html="row"></option>
                                </template>
                            </select>
                        </div>
                        <select v-model="params.month" class="py-2 pl-4 pr-8 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white">
                            <template v-for="row in month" :key="row[1]">
                                <option :value="row[1]" v-html="row[0]"></option>
                            </template>
                        </select>
                        <input type="text" placeholder="Search" v-model="params.search" autocomplete="off" class="px-4 py-2 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white"/>
                        <transition name="pop">
                            <div v-if="params.year || params.month || params.search" @click="reset" class="transition cursor-pointer active:hover:scale-95 dark:text-white">
                                Reset
                            </div>
                        </transition>
                    </div>
                    <button @click="download" :disabled="result == 0" :class="{'opacity-25' : result == 0}" class="px-4 py-2 text-white transition bg-gray-800 rounded-xl active:hover:scale-95">
                        {{ route().params.search || route().params.year || route().params.month ? 'Download ' + result + ' data' : 'Download all data' }}
                    </button>
                </div>
                <table
                    class="min-w-full overflow-hidden divide-y divide-gray-200 shadow rounded-xl dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Item
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Borrower
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Borrowed At
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                Returned At
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-800">
                        <tr class="text-center" v-if="result == 0 && route().params.search == null">
                            <td colspan="7" class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                No data available
                            </td>
                        </tr>

                        <tr class="text-center" v-if="result == 0 && route().params.search != null">
                            <td colspan="7" class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                No result
                            </td>
                        </tr>

                        <tr v-for="datasheet in datasheet.data" :key="datasheet.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 overflow-ellipsis dark:text-white">
                                    {{ datasheet.unique_id }}
                                </div>
                                <div class="space-x-1 overflow-hidden text-sm text-gray-500 w-44 overflow-ellipsis" v-if="datasheet.items">
                                    <span>
                                        {{ datasheet.items[0].name }}
                                    </span>
                                    <span v-if="datasheet.items.length > 1" class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">
                                        {{ (datasheet.items.length - 1) + '+' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="overflow-hidden text-sm font-medium text-gray-900 overflow-ellipsis dark:text-white">
                                    {{ datasheet.borrower.name }}
                                </div>
                                <div class="overflow-hidden text-sm text-gray-500 overflow-ellipsis">
                                    {{ datasheet.borrower.email ? datasheet.borrower.email : datasheet.borrower.contact }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span v-if="datasheet.is_returned != 0" class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                    Returned
                                </span>
                                <span v-else class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">
                                    Borrowed
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ datasheet.borrowed_at }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ datasheet.is_returned != 0 ? datasheet.returned_at : 'Not returned yet' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <a :href="route('report.export', { unique_id: datasheet.unique_id})" class="inline-flex items-center p-2 space-x-4 text-white transition bg-gray-800 rounded-full active:hover:scale-90">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M19 18a3.5 3.5 0 0 0 0 -7h-1a5 4.5 0 0 0 -11 -2a4.6 4.4 0 0 0 -2.1 8.4"></path>
                                        <line x1="12" y1="13" x2="12" y2="22"></line>
                                        <polyline points="9 19 12 22 15 19"></polyline>
                                    </svg>
                                </a>
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
import { InertiaLink } from '@inertiajs/inertia-vue3'

export default defineComponent({
    components: {
        AppLayout,
        Topbar,
        Pagination,
        InertiaLink
    },

    props: {
        datasheet: Object,
        year: Object,
        month: Object,
        result: [String, Number]
    },

    data() {
        return {
            params: {
                search: route().params.search,
                month: route().params.month,
                year: route().params.year
            }
        }
    },

    methods: {
        reset() {
            let params = this.params

            Object.keys(params).forEach(key => {
                delete params[key]
            })
        },

        download() {
            window.location.href = route('report.export', this.params);
        }
    },

    watch: {
        params: {
            handler() {
                let params = this.params

                Object.keys(params).forEach(key => {
                    if (params[key] == "" || params[key] == null) {
                        delete params[key]
                    }
                })

                this.$inertia.get(route('report.index'), this.params, {
                    replace: true,
                    preserveState: true
                })
            },

            deep: true
        }
    }
})
</script>
