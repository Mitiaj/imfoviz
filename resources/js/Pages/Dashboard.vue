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
                <div v-if="dashboards.length === 0">
                    Nothing yet..
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                    <div class="grid-cell col-span-1 p-3" v-for="dashboard in this.dashboards">
                        <div class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

                            <a :href="route('dashboard.preview', {dashboard: dashboard.id})">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ dashboard.name.toString().capitalize() }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                <b>Dataset:</b> {{ dashboard.dataset ? dashboard.dataset.name : 'Not selected' }}<br/>
                                <b>Charts:</b> {{ dashboard.chartCount }}
                            </p>

                            <a :href="route('dashboard.preview', {dashboard: dashboard.id})" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Continue
                                <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

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
