<script setup>
import Card from "@/Components/Page/Card";
import UploadForm from "@/Components/Page/UploadDataset";
import {useForm} from "@inertiajs/inertia-vue3";
import Button from "@/Components/Button";

defineProps({
    datasets: Array,
    dashboard: Object
});

const form = useForm({
    dataset_id: null
});
</script>

<template>
    <Card v-if="datasets.length > 0">
        <template #header>
            Choose Dataset
        </template>

        <div class="my-5">
            <h4 class="my-3">Select from existing:</h4>
            <div class="flex justify-left">
                <div class="mb-3 xl:w-96">
                    <select v-model="form.dataset_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Select">
                        <option value="">Select</option>
                        <option v-for="dataset in datasets" :value="dataset.id">{{ dataset.name }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <Button :disabled="!form.isDirty" type="button" @click="this.process">Continue</Button>
        </div>
    </Card>

    <Card>
        <template #header>
            Upload Dataset
        </template>

        <div id="upload dataset">
            <UploadForm @uploaded="handleUploaded"></UploadForm>
        </div>
    </Card>

</template>

<script>
export default {
    methods: {
        process() {
            this.updateDashboard(this.form.dataset_id);
        },

        handleUploaded(dataset) {
            console.log('uploaded event handler');
            this.updateDashboard(dataset.id);
        },

        updateDashboard(datasetId) {
            axios.post(route('dashboard.update-dataset', {
                dashboard: this.dashboard.id
            }), {dataset_id: datasetId})
            .then((response) => this.redirect())
        },

        redirect() {
            this.$inertia.visit(route('dashboard.preview', {
                dashboard: this.dashboard.id
            }));
        }
    }
}
</script>
