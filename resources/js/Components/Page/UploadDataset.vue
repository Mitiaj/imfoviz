<script setup>
defineEmits({
    uploaded: null
});

</script>

<template>
    <form @submit.prevent="">
        <input type="file" @input="form.dataset = $event.target.files[0]"/>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
        </progress>

        <div class="mt-10">
            <Button :disabled="form.processing" type="button" @click="submit">Continue</Button>
        </div>
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

            let formData = new FormData();
            formData.append('dataset', this.form.data().dataset);
            this.form.processing = true;

            axios.post(
                route('dataset.upload'),
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(function (response) {
                this.form.reset();
                this.$emit('uploaded', response.data);
            }.bind(this)
            ).catch((error) => console.log(error));
        }
    }
}
</script>
