<script setup>
defineProps({
    data: Object
});
</script>

<template>
    <div>
        <div class="grid-cell col-span-1 p-3">
            <div class="border rounded">
                <figure class="highcharts-figure">
                    <div :id="this.container"></div>
                </figure>
            </div>
        </div>
    </div>

</template>
<style>
.highcharts-figure,
.highcharts-data-table table {
    min-width: 360px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>

<script>
import {chart} from "highcharts";
import * as Highcharts from 'highcharts/highcharts';

export default {
    data() {
        return {
            loaded: false,
            chartData: {},
            container: (Math.random() + 1).toString(36).substring(7)
        }
    },
    async mounted() {
        console.log(this.container);
        await this.prepareData();
        if (this.loaded) {
            this.draw();
        }
    },
    methods: {
        prepareData() {
            return axios.post(route('dataset.query', {dataset: this.data.dataset.id}), this.data.chart_data)
            .then(function (response) {
                this.chartData = this.data.chart_data;
                this.chartData.series = response.data;
                console.log(response.data);
                this.loaded = true;

            }.bind(this))
            .catch(function (error) {
                console.log(error);
            })

        },

        draw() {
            Highcharts.chart(this.container, {
                title: {
                    text: this.chartData.title
                },

                subtitle: {
                    text: this.chartData.subtitle
                },

                yAxis: {
                    title: {
                        text: this.chartData.yAxisTitle
                    }
                },

                xAxis: {
                    accessibility: {
                        rangeDeription: this.chartData.xAxisTitle
                    }
                },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        },
                        pointStart: 2010
                    }
                },

                series: this.chartData.series,

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                },

                exporting: {
                    menuItemDefinitions: {
                        fullscreen: {
                            onclick: function() {
                                Highcharts.FullScreen.prototype.init(this.renderTo);
                            },
                            text: 'Full screen'
                        }
                    },
                    buttons: {
                        contextButton: {
                            menuItems: ['downloadPNG', 'downloadSVG', 'separator', 'fullscreen']
                        }
                    }
                },
            });
        }
    }
}
</script>
