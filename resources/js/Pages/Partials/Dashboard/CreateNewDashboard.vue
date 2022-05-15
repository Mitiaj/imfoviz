<script setup>
import Card from "@/Components/Page/Card";
import Button from "@/Components/Button";

defineProps({
    user: Object
})

</script>
<template>
    <Card>
        <template #header>
            Start New Work
        </template>

        <div>
            <div class="relative z-0 w-1/2 mb-6 group">
                <input v-model="form.name" type="text" id="dashboard_name" name="dashboard_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label for="dashboard_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Enter name</label>
            </div>
            <div class="relative z-0 w-1/2 mb-6 group">
                <Button type="button" :disabled="form.processing" @click="createDashboard">
                    <i class="fas fa-plus"></i>&nbsp;
                    Create
                </Button>
            </div>
        </div>
    </Card>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    data() {
        return {
            form: useForm({
                name: ''
            })
        }
    },
    mounted() {
        console.log('mounted');
        console.log(this.user);
    },

    methods: {
        createDashboard() {
            this.form.post(route('dashboard.store'), {
                onSuccess: function (response) {
                    console.log('success');
                    console.log(response);
                }
            });
        }
    }
}
</script>
