<template>
    <div>
        <div :class="{ 'bg-gray-800': style == 'success', 'bg-red-700': style == 'danger' }" v-if="show && message">
            <div class="max-w-screen-xl px-3 py-2 mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="flex items-center flex-1 w-0 min-w-0">
                        <span class="flex p-2 rounded-lg" :class="{ 'bg-gray-700': style == 'success', 'bg-red-600': style == 'danger' }">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" v-if="style == 'success'">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" v-if="style == 'danger'">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </span>

                        <p class="ml-3 text-sm font-medium text-white truncate">
                            {{ message }}
                        </p>
                    </div>

                    <div class="flex-shrink-0 sm:ml-3">
                        <button
                            type="button"
                            class="flex p-2 -mr-1 transition rounded-md focus:outline-none sm:-mr-2"
                            :class="{ 'hover:bg-gray-700 focus:bg-gray-700': style == 'success', 'hover:bg-red-600 focus:bg-red-600': style == 'danger' }"
                            aria-label="Dismiss"
                            @click.prevent="show = false">
                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" st7oke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        data() {
            return {
                show: true,
            }
        },

        computed: {
            style() {
                return this.$page.props.flash?.messageStyle || 'success'
            },

            message() {
                return this.$page.props.flash?.message || ''
            },
        }
    })
</script>
