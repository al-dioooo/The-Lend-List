<template>
    <app-layout title="Data Detail">
        <topbar title="Data Detail" />

        <div class="overflow-y-auto">
            <div class="m-10">
                <div>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ datasheet.note }}</h3>
                                <p class="mt-1 text-sm text-gray-600"> Use a permanent address where you can receive mail. </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="overflow-hidden shadow sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label class="block text-sm font-medium text-gray-700">Item</label>
                                            <v-select v-model="form.item" :filterable="false" @search="searchItem" multiple :reduce="item => item.id" :options="item" label="name" class="mt-1">
                                                <template v-slot:option="{name, description}">
                                                    <div>{{ name }}</div>
                                                    <cite>{{ description }}</cite>
                                                </template>
                                            </v-select>
                                            <input-error :message="form.errors.item" class="mt-1" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3">
                                            <label class="block text-sm font-medium text-gray-700">Borrower</label>
                                            <v-select v-model="form.borrower" :value="datasheet.borrower" :filterable="false" @search="searchBorrower" :reduce="borrower => borrower.id" :options="borrower" label="name" class="mt-1">
                                                <template v-slot:option="{name, email}">
                                                    <div>{{ name }}</div>
                                                    <cite>{{ email }}</cite>
                                                </template>
                                            </v-select>
                                            <input-error :message="form.errors.borrower" class="mt-1" />
                                        </div>
                                        <div class="col-span-6">
                                            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                                            <textarea v-model="form.note" id="note" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm" />
                                            <input-error :message="form.errors.note" class="mt-1" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                            <label for="city"
                                                class="block text-sm font-medium text-gray-700">City</label>
                                            <input type="text"
                                                name="city"
                                                id="city"
                                                autocomplete="address-level2"
                                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="region"
                                                class="block text-sm font-medium text-gray-700">State / Province</label>
                                            <input type="text"
                                                name="region"
                                                id="region"
                                                autocomplete="address-level1"
                                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="postal-code"
                                                class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                                            <input type="text"
                                                name="postal-code"
                                                id="postal-code"
                                                autocomplete="postal-code"
                                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                                    <button type="submit"
                                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Save </button>
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
import { defineComponent } from 'vue'
import AppLayout from '@/Shared/Layout/AppLayout'
import Topbar from '@/Shared/Component/Topbar'
import InputError from '@/Shared/Component/InputError'
import VSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

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
                note: this.datasheet?.note
            })
        }
    },

    created() {
        this.getItem()
        this.getBorrower()
    },

    methods: {
        update() {
            this.form.patch(route('data-list.update'), {
                onSuccess: () => this.closeModal()
            })
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
