<script>
import Chart from "@/Components/Chart/Chart";
import * as Highcharts from "highcharts";

export default {
    extends: Chart,
    methods: {
        draw() {
            let series = [
                {
                    name: this.chartData.xAxisTitle,
                    data: this.chartData.series.map(el => el.data[0])
                }
            ]
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
                        pointStart: this.chartData.start,
                    }
                },

                series: series,

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
