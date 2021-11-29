<template>
    <button @click="openModal" class="px-4 py-2 text-white transition bg-gray-800 rounded-xl active:hover:scale-95">
        Create new
    </button>

    <modal trigger="Create new" title="Create New Data" @close="closeModal" :show="isOpen">
        <div class="mt-8 space-y-2">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input v-model="form.name" id="name" autocomplete="off" type="text" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm">
                <input-error :message="form.errors.name" class="mt-1" />
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea v-model="form.description" id="description" class="block w-full px-4 py-2 mt-1 transition border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-opacity-60 focus:ring-blue-300 focus:border-blue-500 sm:text-sm" />
                <input-error :message="form.errors.description" class="mt-1" />
            </div>
        </div>

        <div class="mt-8">
            <button @click="store" type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-blue-900 bg-blue-100 border border-transparent rounded-md hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
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
                description: null
            })
        }
    },

    methods: {
        openModal() {
            this.isOpen = true
            this.form.reset()
        },

        closeModal() {
            setTimeout(() => this.form.reset(), 200)
            setTimeout(() => this.form.clearErrors(), 200)
            this.isOpen = false
        },

        store() {
            this.form.post(route('item.store'), {
                onSuccess: () => this.closeModal()
            })
        }
    }
})
</script>
