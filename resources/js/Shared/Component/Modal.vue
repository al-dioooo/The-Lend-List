<template>
    <TransitionRoot :show="isOpen" appear as="template">
        <Dialog as="div">
            <div class="fixed inset-0 z-10 overflow-hidden">
                <div class="min-h-screen px-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                        <DialogOverlay class="fixed inset-0 bg-black bg-opacity-50 backdrop-filter backdrop-blur" />
                    </TransitionChild>

                    <span class="inline-block h-screen align-middle" aria-hidden="true">&#8203;</span>

                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                        <div class="inline-block w-full max-w-md p-6 my-8 text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl dark:bg-gray-900">

                            <DialogTitle class="text-2xl font-medium leading-6 text-gray-900 dark:text-gray-50">
                                {{title}}
                            </DialogTitle>

                            <slot />
                        </div>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogOverlay,
    DialogTitle,
} from "@headlessui/vue"

export default {
    components: {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogOverlay,
        DialogTitle,
    },

    props: {
        title: String,
        isOpen: false
    },

    setup() {

        return {
            closeModal() {
                this.$emit('close')
            },
        };
    },
};
</script>
