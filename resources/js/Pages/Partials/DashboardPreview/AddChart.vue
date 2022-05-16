<script setup>
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
    dashboard: Object
});

</script>
<template>
    <Link :href="route('chart.create', {dashboard: dashboard.id})" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mt-5 ml-2">
        <i class="fill-current w-4 h-4 mr-2 fas fa-plus"></i>&nbsp;
        <span>Add</span>
    </Link>
</template>
<script>
export default {
    methods: {

    }
}
</script>
