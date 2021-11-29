<template>
    <modal title="Delete Data" @close="closeModal" :show="isOpen">
        <div class="mt-8 space-y-2">
            <div>
                Are you sure want to delete {{datasheet.name}}?
            </div>
        </div>

        <div class="mt-8">
            <button @click="destroy" type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-red-900 bg-red-100 border border-transparent rounded-md hover:bg-red-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-red-500">
                Delete
            </button>
        </div>
    </modal>
</template>

<script>
import { defineComponent } from 'vue'
import Modal from '@/Shared/Component/Modal'

export default defineComponent({
    components: {
        Modal
    },

    props: {
        datasheet: Object,
        isOpen: false
    },

    methods: {
        closeModal() {
            this.$emit('close')
        },

        destroy() {
            this.$inertia.delete(route('borrower.destroy', this.datasheet), {
                onSuccess: () => this.$emit('close')
            })
        }
    }
})
</script>
