<template>
    <button @click="openModal" class="px-4 py-2 text-white transition bg-gray-800 rounded-xl active:hover:scale-95">
        Create new
    </button>

    <modal title="Create New Data" @close="closeModal" :show="isOpen">
        <div class="mt-8 space-y-2">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Name</label>
                <input v-model="form.name" id="name" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white">
                <input-error :message="form.errors.name" class="mt-1" />
            </div>

            <div>
                <label for="organization" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Organization</label>
                <input v-model="form.organization" id="organization" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white">
                <input-error :message="form.errors.organization" class="mt-1" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                <input v-model="form.email" id="email" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white">
                <input-error :message="form.errors.email" class="mt-1" />
            </div>

            <div>
                <label for="contact" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Contact</label>
                <input v-model="form.contact" id="contact" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white">
                <input-error :message="form.errors.contact" class="mt-1" />
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Address</label>
                <textarea v-model="form.address" id="address" class="block w-full px-4 py-2 mt-1 transition bg-gray-100 border border-gray-200 focus:outline-none rounded-xl focus:border-gray-400 focus:ring focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-700 dark:focus:ring-gray-600 dark:text-white" />
                <input-error :message="form.errors.address" class="mt-1" />
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

export default defineComponent({
    components: {
        Modal,
        InputError
    },

    data() {
        return {
            isOpen: ref(false),

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
        openModal() {
            this.isOpen = true
        },

        closeModal() {
            setTimeout(() => this.form.reset(), 200)
            setTimeout(() => this.form.clearErrors(), 200)
            this.isOpen = false
        },

        store() {
            this.form.post(route('borrower.store'), {
                onSuccess: () => this.closeModal()
            })
        }
    }
})
</script>
