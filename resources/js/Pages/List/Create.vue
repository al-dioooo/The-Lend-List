<template>
    <button @click="openModal" class="px-4 py-2 text-white transition bg-gray-800 rounded-xl active:hover:scale-95">
        Create new
    </button>

    <modal trigger="Create new" title="Create New Data" @close="closeModal" :show="isOpen">
        <div class="mt-8 space-y-2">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Item</label>
                <v-select v-model="form.item" :filterable="false" @search="searchItem" multiple :reduce="item => item.id" :options="item" label="name" class="mt-1">
                    <template v-slot:option="{name, description}">
                        <div>{{ name }}</div>
                        <div class="text-xs opacity-50">{{ description }}</div>
                    </template>
                </v-select>
                <input-error :message="form.errors.item" class="mt-1" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Borrower</label>
                <v-select v-model="form.borrower" :filterable="false" @search="searchBorrower" :reduce="borrower => borrower.id" :options="borrower" label="name" class="mt-1">
                    <template v-slot:option="{name, email}">
                        <div>{{ name }}</div>
                        <div class="text-xs opacity-50">{{ email }}</div>
                    </template>
                </v-select>
                <input-error :message="form.errors.borrower" class="mt-1" />
            </div>

            <div>
                <label for="note" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Note</label>
                <textarea v-model="form.note" id="note" class="block w-full px-4 py-2 mt-1 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white" />
                <input-error :message="form.errors.note" class="mt-1" />
            </div>
        </div>

        <div class="mt-8">
            <button @click="store" type="button" :disabled="form.processing" :class="{'opacity-25': form.processing}" class="px-4 py-2 text-white transition bg-gray-800 rounded-xl active:hover:scale-95">
                Create
            </button>
        </div>
    </modal>
</template>

<script>
import { defineComponent, ref } from 'vue'
import Modal from '@/Shared/Component/Modal'
import InputError from '@/Shared/Component/InputError'
import VSelect from 'vue-select'
import axios from 'axios'

export default defineComponent({
    components: {
        Modal,
        InputError,
        VSelect
    },

    data() {
        return {
            isOpen: ref(false),

            item: [],
            borrower: [],

            form: this.$inertia.form({
                item: null,
                borrower: null,
                note: null
            })
        }
    },

    mounted() {
        this.getItem()
        this.getBorrower()
    },

    methods: {
        openModal() {
            this.isOpen = true
        },

        closeModal() {
            this.isOpen = false
            setTimeout(() => this.form.reset(), 200)
            setTimeout(() => this.form.clearErrors(), 200)
        },

        store() {
            this.form.post(route('data-list.store'), {
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
