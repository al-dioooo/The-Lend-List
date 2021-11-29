<template>
    <div class="flex h-screen overflow-hidden bg-gray-100">
        <Head :title="title"></Head>
        <sidebar />

        <div class="flex flex-col flex-1 w-full overflow-hidden bg-white rounded-tl-3xl rounded-bl-3xl shadow-left">
            <banner />
            <slot/>
        </div>
    </div>

    <slot name="modal" />
</template>

<script>
import { defineComponent } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import Sidebar from '@/Shared/Component/Sidebar'
import Banner from "@/Shared/Component/Banner.vue";

export default defineComponent({
    components: {
        Head,
        Sidebar,
        Banner
    },

    props: {
        title: String,
        subtitle: String,
    },
});
</script>

<style>
    .pop-enter-active,
    .pop-leave-active {
        transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .pop-enter-from {
        transform: scale(.8);
        opacity: .6;
    }

    .pop-leave-to {
        opacity: 0;
    }
</style>
