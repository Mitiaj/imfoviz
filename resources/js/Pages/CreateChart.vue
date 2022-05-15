<template>
    <Head title="Create new chart"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard > Create
            </h2>
        </template>

        <Card>
            <div class="datasets">

                <div v-if="true">
                    <UploadForm />
                </div>
            </div>
        </Card>

    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Card from "@/Components/Page/Card.vue";
import UploadForm from "@/Components/Page/UploadDataset";

export default {
    components: {
        UploadForm,
        BreezeAuthenticatedLayout, Head, Card
    },
    mounted() {
        console.log('hey!');
    },
}
</script>
