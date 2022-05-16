<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import Card from "@/Components/Page/Card";
import Chart from "@/Pages/Partials/Dashboard/Chart";
import AddChart from "@/Pages/Partials/DashboardPreview/AddChart";


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

        <Card>
            <template #header>
                Dataset: {{ this.dashboard.dataset? this.dashboard.dataset.name.capitalize() : "Not set" }}
            </template>
            <div v-if="charts.length === 0">
                Nothing yet..
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div v-for="chart in this.charts" class="grid-cell col-span-1 p-3">
                    <Chart :type="chart.chart_type" :data="chart.data"></Chart>
                </div>
            </div>

            <AddChart :dashboard="dashboard"></AddChart>
        </Card>

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
