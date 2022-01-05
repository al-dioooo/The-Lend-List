<template>
    <modal title="Delete Data" @close="closeModal" :show="isOpen">
        <div class="mt-8 space-y-2">
            <div class="dark:text-white">
                Are you sure want to delete <span v-if="datasheet['type'] == 'Data List'">data</span> <span class="font-semibold">{{ datasheet['type'] == 'Data List' ? datasheet['data'].unique_id : datasheet['data'].name }}</span>?
            </div>
        </div>

        <div class="mt-8">
            <button @click="destroy" type="button" class="px-4 py-2 text-white transition bg-gray-800 rounded-xl active:hover:scale-95">
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
            setTimeout(() => this.form.reset(), 200)
        },

        destroy() {
            this.$inertia.delete(route('trash.destroy'), {
                data: this.datasheet,
                onSuccess: () => this.$emit('close')
            })
        }
    }
})
</script>
