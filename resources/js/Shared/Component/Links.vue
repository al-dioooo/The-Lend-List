<template>
    <button @click="openModal" class="inline-flex items-center p-3 text-gray-800 transition-colors duration-150 bg-gray-200 rounded-full hover:text-gray-600 hover:bg-gray-300 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-gray-100" :href="route('index')">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
    </button>

    <modal title="More Links" @close="closeModal" :show="isOpen">
        <div class="grid grid-cols-2 gap-6 mt-8">
            <inertia-link :href="route('report.index')" class="flex items-center p-4 space-x-4 font-medium bg-gray-200 hover:bg-gray-300 rounded-2xl dark:text-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span>
                    Report
                </span>
            </inertia-link>

            <inertia-link :href="route('trash.index')" class="flex items-center p-4 space-x-4 bg-gray-200 hover:bg-gray-300 rounded-2xl dark:text-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                <span>
                    Recycle Bin
                </span>
            </inertia-link>
        </div>
    </modal>
</template>

<script>
import { defineComponent, ref } from 'vue'
import Modal from '@/Shared/Component/Modal'
import { InertiaLink } from '@inertiajs/inertia-vue3'

export default defineComponent({
    components: {
        Modal,
        InertiaLink
    },

    data() {
        return {
            isOpen: ref(false),
        }
    },

    methods: {
        openModal() {
            this.isOpen = true
        },

        closeModal() {
            this.isOpen = false
        }
    }
})
</script>
