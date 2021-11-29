<template>
    <app-layout title="Edit Data">
        <topbar title="Edit Data" />

        <div class="h-full overflow-y-auto">
            <div class="m-10">
                <div>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ datasheet.note }}</h3>
                                <p class="mt-1 text-sm text-gray-600"> Edit data carefully. </p>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="shadow">
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
                                                class="block text-sm font-medium text-gray-700">Borrowed At</label>
                                            <date-picker :disabled="true" inputFormat="dd-MM-yyyy" v-model="form.borrowed" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                            <label for="city"
                                                class="block text-sm font-medium text-gray-700">Returned At</label>
                                            <date-picker v-model="form.returned" inputFormat="dd-MM-yyyy" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm" />
                                        </div>
                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="region"
                                                class="block text-sm font-medium text-gray-700">State / Province</label>
                                            <t-rich-select :options="options" v-model="form.returned_by">
                                                <template v-slot:option="{ isHighlighted, isSelected, className, option, query }">
                                                    <li :class="[className ? 'text-white bg-gray-800' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9 rounded-md']">
                                                        <div class="flex flex-col">
                                                            <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">
                                                            {{ option.raw.name }}
                                                            </span>
                                                            <span class="text-gray-500">
                                                            {{ option.raw.description }}
                                                            </span>
                                                        </div>

                                                        <span v-if="isSelected" :class="[isHighlighted ? 'text-white' : 'text-grey-800', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </span>
                                                    </li>
                                                </template>
                                            </t-rich-select>
                                        </div>
                                        <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="postal-code"
                                                class="block text-sm font-medium text-gray-700">Returned By</label>
                                            <input v-model="form.returned_by" id="returned_by" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm">
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
import { defineComponent, ref } from 'vue'
import AppLayout from '@/Shared/Layout/AppLayout'
import Topbar from '@/Shared/Component/Topbar'
import InputError from '@/Shared/Component/InputError'
import VSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import DatePicker from 'vue3-datepicker'
import { TRichSelect } from '@variantjs/vue'

export default defineComponent({
    components: {
        AppLayout,
        Topbar,
        InputError,
        VSelect,
        DatePicker,
        TRichSelect
    },

    props: {
        datasheet: Object
    },

    data() {
        return {
            item: [],
            borrower: [],
            options: [
                {
                    id: 1,
                    name: 'Quercus sp.',
                    description: 'BB. 01'
                },

                {
                    id: 2,
                    name: 'Eugenia sp.',
                    description: 'BB. 02'
                }
            ],

            form: this.$inertia.form({
                item: this.datasheet.items,
                borrower: this.datasheet.borrower.id,
                note: this.datasheet?.note,
                borrowed: Date.parse(this.datasheet.borrowed_at),
                returned: ref(new Date()),
                returned_by: this.datasheet?.returned_by
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
