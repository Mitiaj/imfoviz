<script>
import Chart from "@/Components/Chart/Chart";
import * as Highcharts from "highcharts";

export default {
    extends: Chart,
    methods: {
        draw() {

            let sum = this.chartData.series.map(el => el.data[0]).reduce((a, b) => a + b, 0);

            console.log(sum);

            let data = this.chartData.series.map(function (el) {
                return {
                    name: el.name,
                    y: el.data[0] / sum * 100
                }
            });

            Highcharts.chart(this.container, {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
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
                    // accessibility: {
                    //     rangeDeription: this.chartData.xAxisTitle
                    // }
                },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },

                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },

                series: [{
                        data: data

                    }
                ],

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
