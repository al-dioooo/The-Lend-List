<template>
    <div v-if="links.length > 3" class="flex items-center justify-between w-full">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="px-4 py-3 mb-1 mr-1 text-sm leading-4 text-gray-400 border dark:border-gray-800 rounded-xl"
                    v-html="link.label" />
                <inertia-link v-else
                    class="px-4 py-3 mb-1 mr-1 text-sm leading-4 transition border rounded-xl focus:border-gray-500 focus:text-gray-500 active:hover:scale-95 dark:text-white dark:border-gray-800 dark:focus:border-gray-700"
                    :class="link.active ? 'bg-gray-800 text-white hover:bg-gray-700 dark:bg-gray-200 dark:text-black' : 'hover:bg-gray-100 dark:hover:bg-gray-800' " :href="link.url" v-html="link.label"></inertia-link>
            </template>
        </div>

        <div>
            <p class="text-sm leading-5 text-gray-700 dark:text-gray-400">
                Showing
                <span class="font-medium" v-html="first" />
                to
                <span class="font-medium" v-html="last" />
                of
                <span class="font-medium" v-html="total" />
                results
            </p>
        </div>
    </div>
</template>

<script>
import { InertiaLink } from "@inertiajs/inertia-vue3"

    export default {
        components: {
            InertiaLink
        },

        props: {
            links: Array,
            first: [String, Number],
            last: [String, Number],
            total: [String, Number],
        },
    }
</script>
