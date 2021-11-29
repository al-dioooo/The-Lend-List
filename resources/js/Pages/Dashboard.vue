<template>
    <app-layout title="Dashboard">
        <topbar title="Dashboard" />

        <div class="grid grid-cols-2 p-10">
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Shared/Layout/AppLayout'
import Topbar from '@/Shared/Component/Topbar'

export default defineComponent({
    components: {
        AppLayout,
        Topbar
    }
})
</script>
