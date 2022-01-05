<template>
    <app-layout title="Data Detail">
        <topbar title="Data Detail" />

        <div class="overflow-y-auto">
            <div class="m-10 divide-y dark:divide-gray-700">
                <div class="pb-8">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Data</h3>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-white">
                                    <div class="flex flex-col divide-y dark:divide-gray-700">
                                        <div class="pb-2">
                                            <div class="font-medium">
                                                Unique ID
                                            </div>
                                            <div class="text-gray-500">
                                                {{ datasheet.unique_id }}
                                            </div>
                                        </div>

                                        <div class="pt-2">
                                            <div class="font-medium">
                                                Note
                                            </div>
                                            <div class="text-gray-500">
                                                {{ datasheet.note }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-8">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Items</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"> List of items. </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-white">
                                    <div class="flex flex-col divide-y dark:divide-gray-700">
                                        <template v-for="(row, index) in datasheet.items" :key="row.id">
                                            <div :class="index == 0 ? 'pb-2' : index == datasheet.items.length -1 ? 'pt-2' : 'py-2'">
                                                <div class="font-medium">
                                                    {{ row.name }}
                                                </div>
                                                <div class="text-gray-500">
                                                    {{ row.description }}
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-8">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Borrower</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"> The borrower of item. </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-white">
                                    <div class="flex flex-col">
                                        <div>
                                            <div class="font-medium">
                                                {{ datasheet.borrower.name }}
                                            </div>
                                            <div class="text-gray-500">
                                                {{ datasheet.borrower.email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-8">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Timestamp</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"> The timestamp of data. </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-white">
                                    <div class="flex flex-col divide-y dark:divide-gray-700">
                                        <div class="pb-2">
                                            <div class="font-medium">
                                                Borrowed At
                                            </div>
                                            <div class="text-gray-500">
                                                {{ datasheet.borrowed_at }}
                                            </div>
                                        </div>

                                        <div class="py-2">
                                            <div class="font-medium">
                                                Returned At
                                            </div>
                                            <div class="text-gray-500">
                                                {{ datasheet.returned_at ? datasheet.returned_at + ' by ' + datasheet.accepted_by : 'Not returned yet' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-8">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Actions</h3>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6 dark:bg-gray-900 dark:text-white">
                                    <div class="flex flex-col divide-y dark:divide-gray-700">
                                        <div class="pb-4">
                                            <inertia-link :href="route('data-list.edit', datasheet)" class="px-4 py-2 text-white transition bg-gray-800 rounded-xl active:hover:scale-95">
                                                Edit data
                                            </inertia-link>
                                        </div>

                                        <div class="pt-2">
                                            <button @click="destroy(datasheet)" class="px-4 py-2 text-white transition bg-red-800 rounded-xl active:hover:scale-95">
                                                Delete data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <delete :datasheet="modalData" :show="isOpen" @close="closeModal" />
    </app-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import AppLayout from '@/Shared/Layout/AppLayout'
import Topbar from '@/Shared/Component/Topbar'
import Delete from '@/Pages/List/Delete'
import { InertiaLink } from '@inertiajs/inertia-vue3'

export default defineComponent({
    components: {
        AppLayout,
        Topbar,
        Delete,
        InertiaLink
    },

    props: {
        datasheet: Object
    },

    data() {
        return {
            form: this.$inertia.form({
                is_returned: false,
                accepted_by: null
            }),

            modalData: null,
            isOpen: ref(false)
        }
    },

    methods: {
        destroy(data) {
            this.modalData = data
            this.isOpen = true
        },

        closeModal() {
            this.isOpen = false
        }
    }
})
</script>
