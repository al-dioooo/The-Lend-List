<template>
    <label class="block text-sm font-medium text-gray-700">
        Item
    </label>

</template>

<script>
import axios from 'axios'
import { defineComponent, ref } from 'vue'
import VSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

export default defineComponent({
    components: {
        VSelect
    },

    data() {
        return {
            datasheet: [],
            search: null,
            selected: []
        }
    },

    created() {
        this.getData()
    },

    methods: {
        getData() {
            axios.get(route('item.get', {
                search: this.search
            })).then(response => {
                this.datasheet = response.data
            }).catch(error => {
                console.log(error)
            })
        }
    }
})
</script>
