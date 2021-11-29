<template>
    <modal title="Edit Data" @close="closeModal" :show="isOpen">
        <div class="mt-8 space-y-2">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input v-model="form.name" id="name" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm">
                <input-error :message="form.errors.name" class="mt-1" />
            </div>

            <div>
                <label for="organization" class="block text-sm font-medium text-gray-700">Organization</label>
                <input v-model="form.organization" id="organization" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm">
                <input-error :message="form.errors.organization" class="mt-1" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input v-model="form.email" id="email" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm">
                <input-error :message="form.errors.email" class="mt-1" />
            </div>

            <div>
                <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                <input v-model="form.contact" id="contact" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm">
                <input-error :message="form.errors.contact" class="mt-1" />
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea v-model="form.address" id="description" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm" />
                <input-error :message="form.errors.address" class="mt-1" />
            </div>
        </div>

        <div class="mt-8">
            <button @click="save" type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                Save
            </button>
        </div>
    </modal>
</template>

<script>
import { defineComponent } from 'vue'
import Modal from '@/Shared/Component/Modal'
import InputError from '@/Shared/Component/InputError'

export default defineComponent({
    components: {
        Modal,
        InputError
    },

    props: {
        datasheet: Object,
        isOpen: false
    },

    data() {
        return {
            form: this.$inertia.form({
                name: null,
                organization: null,
                email: null,
                contact: null,
                address: null
            })
        }
    },

    methods: {
        closeModal() {
            this.$emit('close')
        },

        save() {
            this.form.put(route('borrower.update', this.datasheet), {
                onSuccess: () => this.$emit('close')
            })
        }
    },

    watch: {
        datasheet: {
            handler() {
                this.form.name = this.datasheet.name
                this.form.organization = this.datasheet.organization
                this.form.email = this.datasheet.email
                this.form.contact = this.datasheet.contact
                this.form.address = this.datasheet.address
            }
        }
    }
})
</script>
