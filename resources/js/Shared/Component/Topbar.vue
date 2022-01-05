<template>
    <div class="flex items-center justify-between px-10 py-6 border-b dark:border-gray-800">
        <div class="text-4xl font-semibold dark:text-white" v-html="title" />

        <button @click="toggleMode()" class="flex items-center space-x-4 group">
            <div :class="mode == 'dark' ? 'text-black bg-gray-200' : 'text-white bg-gray-800'" class="p-3 transition rounded-full group-active:hover:scale-90">
                <svg v-if="mode == 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div :class="mode == 'dark' ? 'text-gray-200' : 'text-gray-800'" class="font-semibold">
                {{ mode == 'dark' ? 'Dark' : 'Light' }}
            </div>
        </button>
    </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    props: {
        title: String
    },

    data() {
        return {
            mode: localStorage.getItem('mode'),
        }
    },

    mounted() {
        if (this.mode == 'dark') {
            document.querySelector('html').classList.add('dark')
        } else {
            document.querySelector('html').classList.remove("dark")
        }
    },

    methods: {
        toggleMode() {
            if (this.mode == 'dark') {
                this.mode = 'light'
            } else {
                this.mode = 'dark'
            }
        }
    },

    watch: {
        mode: {
            handler() {
                localStorage.setItem('mode', this.mode)

                if (localStorage.getItem('mode') == 'dark') {
                    document.querySelector('html').classList.add('dark')
                } else {
                    document.querySelector('html').classList.remove("dark")
                }
            }
        }
    }
})
</script>
