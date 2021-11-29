<template>
    <div class="flex items-center justify-between px-10 py-6 border-b">
        <div class="text-4xl font-semibold" v-html="title" />

        <div class="flex space-x-6">
            <div>
                <button class="p-3 bg-gray-200 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path>
                    </svg>
                </button>
            </div>

            <div>
                <button class="overflow-hidden rounded-full">
                    <img class="w-10 h-10" src="https://ui-avatars.com/api/?name=Alice+Evergarden&color=ffffff&background=252525&format=svg">
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { InertiaLink } from '@inertiajs/inertia-vue3'

export default defineComponent({
    components: {
        InertiaLink
    },

    props: {
        title: String
    }
})
</script>
