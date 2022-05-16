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
                chart: {
                    type: 'area'
                },

                title: {
                    text: this.chartData.title
                },
                subtitle: {
                    text: this.chartData.subtitle,
                },
                xAxis: {
                    title: this.chartData.xAxisTitle,
                    allowDecimals: false,
                    labels: {
                        formatter: function () {
                            return this.value; // clean, unformatted number for year
                        }
                    }
                },
                yAxis: {
                    title: {
                        text: this.chartData.yAxisTitle
                    },
                    labels: {
                        formatter: function () {
                            return this.value / 1000 + 'k';
                        }
                    }
                },
                plotOptions: {
                    area: {
                        pointStart: this.chartData.start,
                        marker: {
                            enabled: false,
                            symbol: 'circle',
                            radius: 2,
                            states: {
                                hover: {
                                    enabled: true
                                }
                            }
                        }
                    }
                },
                series: series
            });
        }
    }
}
</script>
