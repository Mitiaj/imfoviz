<template>
    <form @submit.prevent="">
        <input type="file" @input="form.dataset = $event.target.files[0]"/>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
        </progress>
        <Button type="button" @click="submit">Upload</Button>
    </form>
</template>

<script>
import {useForm} from '@inertiajs/inertia-vue3'
import Button from "@/Components/Button";

export default {
    components: {Button},

    data() {
        return {
            form: useForm({
                dataset: null,
            })
        }
    },

    methods: {
        submit() {
            this.form.post('/upload-dataset', {
                forceFormData: true,
                onSuccess: function (response) {
                    console.log(response);
                },
                onError: function (response) {
                    console.log(response);
                }
            });
        }
    }
}
</script>
