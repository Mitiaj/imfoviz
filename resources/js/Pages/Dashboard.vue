<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Button from "@/Components/Button";
import Card from "@/Components/Page/Card";
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
            <Button type="button" @click="createChart">
                <i class="fas fa-plus"></i>&nbsp;
                Create new chart
            </Button>
        </Card>

    </BreezeAuthenticatedLayout>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";

export default {
    methods: {
        createChart() {
            Inertia.visit(route('dashboard.create'));
        }
    }
}
</script>
