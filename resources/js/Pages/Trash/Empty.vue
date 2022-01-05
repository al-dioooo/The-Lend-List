<template>
    <button @click="openModal" :disabled="disabled" :class="{'opacity-25' : disabled}" class="px-4 py-2 text-white transition bg-gray-800 rounded-xl active:hover:scale-95">
        Delete all
    </button>

    <modal title="Empty Recycle Bin" @close="closeModal" :show="isOpen">
        <div class="mt-8 space-y-2">
            <div class="dark:text-white">
                Are you sure want to empty the recycle bin?
            </div>
        </div>

        <div class="mt-8">
            <button @click="empty" type="button" class="px-4 py-2 text-white transition bg-gray-800 rounded-xl active:hover:scale-95">
                Delete all
            </button>
        </div>
    </modal>
</template>

<script>
import { defineComponent, ref } from 'vue'
import Modal from '@/Shared/Component/Modal'

export default defineComponent({
    components: {
        Modal
    },

    props: {
        disabled: Boolean
    },

    data() {
        return {
            isOpen: ref(false)
        }
    },

    methods: {
        openModal() {
            this.isOpen = true
        },

        closeModal() {
            this.isOpen = false
        },

        empty() {
            this.$inertia.delete(route('trash.empty'), {
                onSuccess: () => this.isOpen = false
            })
        }
    }
})
</script>
