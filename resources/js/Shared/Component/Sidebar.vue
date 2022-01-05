<template>
    <aside class="py-4 overflow-y-auto">
        <div class="py-4 space-y-16 text-gray-400">
            <ul>
                <li class="flex justify-center">
                    <inertia-link class="inline-flex items-center p-4 text-gray-200 transition-colors duration-150 bg-gray-800 hover:bg-gray-700 rounded-xl"
                        :href="route('index')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 10a6 6 0 0 0 -6 -6h-3v2a6 6 0 0 0 6 6h3"></path>
                            <path d="M12 14a6 6 0 0 1 6 -6h3v1a6 6 0 0 1 -6 6h-3"></path>
                            <line x1="12" y1="20" x2="12" y2="10"></line>
                        </svg>
                    </inertia-link>
                </li>
            </ul>

            <ul class="space-y-12">
                <li class="relative px-12 py-2">
                    <span v-if="route().current('index')" class="absolute inset-y-0 right-0 w-1 bg-gray-800 rounded-full dark:bg-gray-200" aria-hidden="true"></span>
                    <inertia-link class="inline-flex items-center transition duration-150 hover:text-gray-800 dark:hover:text-white" :class="{'text-gray-800 dark:text-white' : route().current('index')}"
                        :href="route('index')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" :fill="route().current('index') ? 'currentColor' : 'none'" stroke="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </inertia-link>
                </li>

                <li class="relative px-12 py-2">
                    <span v-if="route().current('data-list.index')" class="absolute inset-y-0 right-0 w-1 bg-gray-800 rounded-full dark:bg-gray-200" aria-hidden="true"></span>
                    <inertia-link class="inline-flex items-center text-sm transition duration-150 hover:text-gray-800 dark:hover:text-white" :class="{'text-gray-800 dark:text-white' : route().current('data-list.index')}"
                        :href="route('data-list.index')">
                        <svg class="w-6 h-6" v-if="route().current('data-list.index')" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                        <svg class="w-6 h-6" v-else fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </inertia-link>
                </li>

                <li class="relative px-12 py-2">
                    <span v-if="route().current('item.index')" class="absolute inset-y-0 right-0 w-1 bg-gray-800 rounded-full dark:bg-gray-200" aria-hidden="true"></span>
                    <inertia-link class="inline-flex items-center text-sm transition duration-150 hover:text-gray-800 dark:hover:text-white" :class="{'text-gray-800 dark:text-white' : route().current('item.index')}"
                        :href="route('item.index')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" v-if="route().current('item.index')" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" v-else viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </inertia-link>
                </li>

                <li class="relative px-12 py-2">
                    <span v-if="route().current('borrower.index')" class="absolute inset-y-0 right-0 w-1 bg-gray-800 rounded-full dark:bg-gray-200" aria-hidden="true"></span>
                    <inertia-link class="inline-flex items-center text-sm transition duration-150 hover:text-gray-800 dark:hover:text-white" :class="{'text-gray-800 dark:text-white' : route().current('borrower.index')}"
                        :href="route('borrower.index')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" :fill="route().current('borrower.index') ? 'currentColor' : 'none'" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </inertia-link>
                </li>
            </ul>

            <ul>
                <li class="flex justify-center">
                    <links />
                </li>
            </ul>
        </div>
    </aside>

</template>

<script>
import { defineComponent } from 'vue'
import { InertiaLink } from "@inertiajs/inertia-vue3"
import Links from '@/Shared/Component/Links'

export default defineComponent({
    components: {
        InertiaLink,
        Links
    }
})
</script>
