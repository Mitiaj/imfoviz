<script>
import Chart from "@/Components/Chart/Chart";
import * as Highcharts from "highcharts";

export default {
    extends: Chart,
    methods: {
        draw() {
            Highcharts.chart(this.container, {
                chart: {
                    type: 'bar'
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

                series: this.chartData.series,

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
                        // pointStart: 2010
                    }
                },
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
