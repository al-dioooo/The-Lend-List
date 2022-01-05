<template>
    <app-layout title="Recycle Bin">
        <topbar title="Recycle Bin" />

        <div class="overflow-y-auto">
            <div class="m-10 space-y-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <input type="text" placeholder="Search" v-model="params.search" autocomplete="off" class="px-4 py-2 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white"/>
                        <transition name="pop">
                            <div v-if="params.search" @click="reset" class="transition cursor-pointer active:hover:scale-95 dark:text-white">
                                Reset
                            </div>
                        </transition>
                    </div>
                    <empty :disabled="result == 0" />
                </div>
                <div class="grid min-w-full grid-cols-3 gap-8">
                    <div class="flex items-center p-4 shadow rounded-xl dark:bg-gray-800 dark:text-white" v-if="result == 0 && route().params.search == null ">
                        <div class="flex-1">
                            <div class="font-semibold">
                                Empty
                            </div>
                            <div class="text-xs">
                                There are no data trashed
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center p-4 shadow rounded-xl dark:bg-gray-800 dark:text-white" v-if="result == 0 && route().params.search != null ">
                        <div class="flex-1">
                            <div class="font-semibold">
                                No result
                            </div>
                            <div class="text-xs">
                                There are no data matching your search query
                            </div>
                        </div>
                    </div>
                    <template v-for="row in datasheet" :key="row.id" v-else>
                        <div class="flex items-center p-4 shadow rounded-xl dark:bg-gray-800 dark:text-white">
                            <div class="flex-1">
                                <div v-if="row['type'] == 'Data List'">
                                    <div class="font-semibold">
                                        {{ row['data'].unique_id }}
                                    </div>
                                    <div class="space-x-1 text-xs">
                                        <span>
                                            {{ row['data'].items[0].name }}
                                        </span>
                                        <span v-if="row['data'].items.length > 1" class="inline-flex px-2 font-semibold leading-5 text-gray-100 bg-gray-800 rounded-full dark:bg-gray-100 dark:text-gray-800">
                                            {{ (row['data'].items.length - 1) + '+' }}
                                        </span>
                                    </div>
                                </div>

                                <div v-if="row['type'] == 'Item'">
                                    <div class="font-semibold">
                                        {{ row['data'].name }}
                                    </div>
                                    <div class="text-xs">
                                        {{ row['data'].description }}
                                    </div>
                                </div>

                                <div v-if="row['type'] == 'Borrower'">
                                    <div class="font-semibold">
                                        {{ row['data'].name }}
                                    </div>
                                    <div class="text-xs">
                                        {{ row['data'].email }}
                                    </div>
                                </div>
                                <span :class="row['type'] == 'Data List' ? 'text-blue-800 bg-blue-100' : row['type'] == 'Item' ? 'text-indigo-800 bg-indigo-100' : 'text-violet-800 bg-violet-100'" class="inline-flex px-2 mt-4 text-xs font-semibold leading-5 rounded-full">
                                    {{ row['type'] }}
                                </span>
                            </div>
                            <div class="space-x-4">
                                <inertia-link :href="route('trash.restore', row)" method="POST" class="inline-flex items-center p-2 space-x-4 text-white transition bg-gray-800 rounded-full active:hover:scale-90 dark:bg-gray-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                </inertia-link>

                                <button @click="destroy(row)" class="inline-flex items-center p-2 space-x-4 text-white transition bg-red-800 rounded-full active:hover:scale-90">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <delete :datasheet="sheet" :show="isOpen" @close="closeModal" />
    </app-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import AppLayout from '@/Shared/Layout/AppLayout'
import Topbar from '@/Shared/Component/Topbar'
import { InertiaLink } from '@inertiajs/inertia-vue3'
import Delete from '@/Pages/Trash/Delete'
import Empty from '@/Pages/Trash/Empty'

export default defineComponent({
    components: {
        AppLayout,
        Topbar,
        InertiaLink,
        Delete,
        Empty
    },

    props: {
        datasheet: Array,
        result: [String, Number]
    },

    data() {
        return {
            isOpen: ref(false),
            sheet: null,

            params: {
                search: route().params.search,
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

        destroy(data) {
            this.isOpen = true
            this.sheet = data
        },

        closeModal() {
            this.isOpen = false
            this.sheet = null
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

                this.$inertia.get(route('trash.index'), this.params, {
                    replace: true,
                    preserveState: true
                })
            },

            deep: true
        }
    }
})
</script>
