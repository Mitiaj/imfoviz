<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Card from "@/Components/Page/Card.vue";
import LineChart from "@/Components/Chart/LineChart";
import ColumnChart from "@/Components/Chart/ColumnChart";
import BarChart from "@/Components/Chart/BarChart";
import PieChart from "@/Components/Chart/PieChart";
import Button from "@/Components/Button";
import AreaChart from "@/Components/Chart/AreaChart";


defineProps({
    dashboard: Object,
    dataset: Object
});
</script>

<template>
    <Head title="Create new chart"/>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                [{{ this.dashboard.name.capitalize() }}] Add New Chart
            </h2>
        </template>

        <Card>
          <template #header>
              Choose chart (dataset: {{ this.dataset.name.capitalize() }})
          </template>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 cursor-pointer">

                <div @click="select(chart)" v-for="chart in chartsAvailable" class="grid-cell col-span-1 p-3">
                    <div :class="form.chart.id === chart.id ? 'shadow-2xl border' : ''" class="max-w-sm rounded overflow-hidden shadow-lg hover:shadow-2xl">
                        <div style="width: 100%; height: 216px; overflow: hidden; display: table-cell; vertical-align: middle;">
                            <img class="w-full" :src="chart.logo" alt="line chart">
                        </div>
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ chart.name }}</div>
                        </div>
                    </div>
                </div>

            </div>
        </Card>

        <Card>
            <template #header>
                Preview
            </template>
            <div v-if="this.showPreview">
                <ColumnChart v-if="this.form.chart.id === 'column'" :data="this.form"></ColumnChart>
                <BarChart v-if="this.form.chart.id === 'bar'" :data="this.form"></BarChart>
                <PieChart v-if="this.form.chart.id === 'pie'" :data="this.form"></PieChart>
                <LineChart v-if="this.form.chart.id === 'line'" :data="this.form"></LineChart>
                <AreaChart v-if="this.form.chart.id === 'area'" :data="this.form"></AreaChart>
            </div>
        </Card>

        <Card v-if="form.chart.id">
            <template #header>
                Configure
            </template>
            <h3>{{ this.form.chart.id }}</h3>

            <div class="grid grid-cols-1 md:grid-cols-2">
                <div v-for="(value,field) in form.chart.fields" class="col-span-1">
                    <div v-if="value.type === String" class="relative z-0 w-1/2 mb-6 group">
                        <input v-model="form.chart_data[field]" type="text" :id="field" :name="field" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label :for="field" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Enter {{ field }}</label>
                    </div>
                </div>


                <div class="my-5 col-span-1">
                    <h4 class="my-3">Aggregation</h4>
                    <div class="flex justify-left">
                        <div class="mb-3 xl:w-96">
                            <select v-model="form.chart_data.aggregation" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Select">
                                <option value="min">Min</option>
                                <option value="max">Max</option>
                                <option value="sum">Sum</option>
                                <option value="avg">Avg</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="my-5 col-span-1">
                    <h4 class="my-3">Aggregation Field</h4>
                    <div class="flex justify-left">
                        <div class="mb-3 xl:w-96">
                            <select v-model="form.chart_data.aggregation_field" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Select">
                                <option v-for="headline in dataset.headlines" :value="headline">{{ headline }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="my-5 col-span-1">
                    <h4 class="my-3">Group By</h4>
                    <div class="flex justify-left">
                        <div class="mb-3 xl:w-96">
                            <select v-model="form.chart_data.group_by_field" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Select">
                                <option v-for="headline in dataset.headlines" :value="headline">{{ headline }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="my-5 col-span-1">
                    <h4 class="my-3">Group By Aggregation (time series)</h4>
                    <div class="flex justify-left">
                        <div class="mb-3 xl:w-96">
                            <select v-model="form.chart_data.group_by_field_aggregation" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Select">
                                <option value=""></option>
                                <option value="MONTH"> Month </option>
                                <option value="YEAR"> Year </option>
                                <option value="DAY"> Day </option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>


            <div class="relative z-0 w-1/2 mb-6 group">
                <Button type="button" @click="preview">
                    <i class="fas fa-sync-alt"></i>&nbsp;
                    Preview
                </Button>
            </div>

            <div class="relative z-0 w-1/2 mb-6 group">
                <Button type="button" @click="save">
                    Save
                </Button>
            </div>
        </Card>

    </BreezeAuthenticatedLayout>
</template>
<script>

import charts from "@/ChartsConfig";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

export default {
    data() {
        return {
            form: useForm({
                chart: {},
                chart_data: {},
                dataset: this.dataset
            }),
            chartsAvailable: charts.charts,
            showPreview: false
        }
    },

    mounted() {
        console.log('hey!');
    },

    methods: {
        save() {
            axios.post(route('chart.save', {
                dashboard: this.dashboard.id,
                dataset: this.dataset.id
            }), {
                type: this.form.chart.id,
                data: this.form
            }).then(function () {
                Inertia.visit(route('dashboard.preview', {dashboard: this.dashboard.id}))
            }.bind(this));
        },

        select(chart) {
            this.form.chart = chart;
        },

        preview() {
            var self = this;
            if (this.showPreview) {
                this.showPreview = false;
                setTimeout(function () {
                    self.showPreview = true;
                }.bind(this), 500);
            } else {
                this.showPreview = true;
            }

        }
    }
}
</script>
