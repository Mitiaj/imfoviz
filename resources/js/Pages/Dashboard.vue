<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Card from "@/Components/Page/Card";
import CreateNewDashboard from "@/Pages/Partials/Dashboard/CreateNewDashboard";


defineProps({
    dashboards: Array
});

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <Card>
            <template #header>
                Your Works
            </template>
            <div id="dashboards" class="my-5">
                Nothing yet..
            </div>
        </Card>

        <CreateNewDashboard
            :user="$page.props.auth.user"
        ></CreateNewDashboard>


    </BreezeAuthenticatedLayout>
</template>

<script>
export default {
    mounted() {
        console.log(this.dashboards);
    },
    methods: {

    }
}
</script>
