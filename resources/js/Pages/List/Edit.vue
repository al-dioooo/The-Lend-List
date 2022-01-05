<template>
    <app-layout title="Edit Data">
        <topbar title="Edit Data" />

        <div class="h-full overflow-y-auto">
            <div class="m-10">
                <div>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Unique ID {{ datasheet.unique_id }}</h3>
                                <p class="mt-1 text-sm text-gray-600"> Edit data carefully. </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="px-4 py-5 space-y-6 bg-white sm:p-6 dark:bg-gray-900 dark:text-white">
                                    <fieldset>
                                        <legend class="text-base font-medium text-gray-900 dark:text-white">Statuses</legend>
                                        <div class="mt-4">
                                            <div class="flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="is_returned" name="is_returned" type="checkbox" v-model="form.is_returned" class="w-4 h-4 text-gray-700 transition bg-gray-200 border-transparent rounded focus:border-transparent focus:ring focus:ring-offset-0 focus:ring-gray-500" />
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="is_returned"
                                                        class="font-medium text-gray-700 dark:text-gray-400">Is Returned</label>
                                                    <p class="text-gray-500">Check if the item has returned.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-6 gap-6 mt-4" v-if="form.is_returned">
                                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                                <label for="returned_at"
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-400">Returned At</label>
                                                    <input type="date" id="returned_at" class="block w-full px-4 py-2 mt-1 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white">
                                                <input-error :message="form.errors.returned_at" class="mt-1" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="accepted_by"
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-400">Accepted By</label>
                                                <input v-model="form.accepted_by" id="accepted_by" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white">
                                                <input-error :message="form.errors.accepted_by" class="mt-1" />
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div>
                                            <legend class="text-base font-medium text-gray-900 dark:text-white">Data</legend>
                                            <p class="text-sm text-gray-500">These are item and borrower that contains on datasheet.
                                            </p>
                                        </div>
                                        <div class="grid grid-cols-6 gap-6 mt-4">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Item</label>
                                                <v-select v-model="form.item" :filterable="false" @search="searchItem" multiple :reduce="item => item.id" :options="item" label="name" class="mt-1">
                                                    <template v-slot:option="{name, description}">
                                                        <div>{{ name }}</div>
                                                        <div class="text-xs opacity-50">{{ description }}</div>
                                                    </template>
                                                </v-select>
                                                <input-error :message="form.errors.item" class="mt-1" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Borrower</label>
                                                <v-select v-model="form.borrower" :value="datasheet.borrower" :filterable="false" @search="searchBorrower" :reduce="borrower => borrower.id" :options="borrower" label="name" class="mt-1">
                                                    <template v-slot:option="{name, email}">
                                                        <div>{{ name }}</div>
                                                        <div class="text-xs opacity-50">{{ email }}</div>
                                                    </template>
                                                </v-select>
                                                <input-error :message="form.errors.borrower" class="mt-1" />
                                            </div>
                                            <div class="col-span-6">
                                                <label for="note" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Note</label>
                                                <textarea v-model="form.note" id="note" rows="8" class="block w-full px-4 py-2 mt-1 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white" />
                                                <input-error :message="form.errors.note" class="mt-1" />
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6 dark:bg-black dark:bg-opacity-30">
                                    <button type="submit" @click="update" class="px-4 py-2 text-white transition bg-gray-800 rounded-xl active:hover:scale-95">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent, ref } from 'vue'
import AppLayout from '@/Shared/Layout/AppLayout'
import Topbar from '@/Shared/Component/Topbar'
import InputError from '@/Shared/Component/InputError'
import VSelect from 'vue-select'

export default defineComponent({
    components: {
        AppLayout,
        Topbar,
        InputError,
        VSelect
    },

    props: {
        datasheet: Object
    },

    data() {
        return {
            item: [],
            borrower: [],
            form: this.$inertia.form({
                item: this.datasheet.items,
                borrower: this.datasheet.borrower.id,
                note: this.datasheet?.note,
                is_returned: this.datasheet.is_returned == 1 ? true : false,
                returned_at: this.datasheet.returned_at ? Date.parse(this.datasheet.returned_at) : ref(new Date()),
                accepted_by: this.datasheet?.accepted_by
            })
        }
    },

    created() {
        this.getItem()
        this.getBorrower()
    },

    methods: {
        update() {
            this.form.put(route('data-list.update', this.datasheet))
        },

        searchBorrower(search) {
            this.getBorrower(search)
        },

        searchItem(search) {
            this.getItem(search)
        },

        getBorrower(query) {
            axios.get(route('api.borrower', {
                search: query
            })).then(response => {
                this.borrower = response.data
            }).catch(error => {
                console.log(error)
            })
        },

        getItem(query) {
            axios.get(route('api.item', {
                search: query
            })).then(response => {
                this.item = response.data
            }).catch(error => {
                console.log(error)
            })
        }
    }
})
</script>
