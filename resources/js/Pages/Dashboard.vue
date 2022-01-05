<template>
    <app-layout title="Dashboard">
        <topbar title="Dashboard" />

        <div class="overflow-y-auto">
            <div class="m-10 space-y-4">
                <h2 class="text-2xl font-semibold dark:text-white">
                    Stats
                </h2>
                <div class="grid grid-cols-4 gap-6 mb-8">
                    <!-- Card -->
                    <div class="flex items-center p-4 shadow rounded-xl dark:bg-gray-800">
                        <div class="p-3 mr-4 text-gray-800 bg-gray-100 rounded-full">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Data List
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{ datalist != 0 ? datalist : "No data" }}
                            </p>
                        </div>
                    </div>

                    <!-- Card -->
                    <div class="flex items-center p-4 shadow rounded-xl dark:bg-gray-800">
                        <div class="p-3 mr-4 text-gray-800 bg-gray-100 rounded-full">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path><path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Items
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{ item != 0 ? item : "No data" }}
                            </p>
                        </div>
                    </div>

                    <!-- Card -->
                    <div class="flex items-center p-4 shadow rounded-xl dark:bg-gray-800">
                        <div class="p-3 mr-4 text-gray-800 bg-gray-100 rounded-full">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                Borrower
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{ borrower != 0 ? borrower : "No data" }}
                            </p>
                        </div>
                    </div>

                    <!-- Card -->
                    <div class="flex items-center p-4 shadow rounded-xl dark:bg-gray-800">
                        <div class="p-3 mr-4 text-gray-800 bg-gray-100 rounded-full">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                This Month
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{ report != 0 ? report + ' data list' : "No data" }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Shared/Layout/AppLayout'
import Topbar from '@/Shared/Component/Topbar'

export default defineComponent({
    components: {
        AppLayout,
        Topbar
    },

    props: {
        datalist: [String, Number],
        item: [String, Number],
        borrower: [String, Number],
        report: [String, Number],
    }
})
</script>
