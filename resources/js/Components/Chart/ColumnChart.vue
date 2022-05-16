<script>
import Chart from "@/Components/Chart/Chart";
import * as Highcharts from "highcharts";

export default {
    extends: Chart,
    methods: {
        draw() {
            Highcharts.chart(this.container, {
                chart: {
                    type: 'column'
                },
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
                    title: {
                        text: this.chartData.xAxisTitle
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
