<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import SetupDataset from "@/Pages/Partials/Dashboard/SetupDataset";


defineProps({
    dashboard: Object,
    datasets: Array,
    charts: Array
});

</script>

<template>
    <Head :title="'Preview ' + this.dashboard.name ?? '' "/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Preview {{ this.dashboard.name }}
            </h2>
        </template>

<!--        <SetupDataset :dashboard="dashboard" :datasets="datasets"></SetupDataset>-->

    </BreezeAuthenticatedLayout>
</template>

<script>
export default {
    mounted() {
        if (this.dashboard.dataset === null) {
            window.location.href = route('dashboard.setup', {
                dashboard: this.dashboard.id
            })
        }
    },
    methods: {}
}
</script>
