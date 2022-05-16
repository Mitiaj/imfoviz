import Series from "@/Series";

export default {
    charts: [
        {
            id: 'column',
            name: 'Column Chart',
            logo: '/images/columnchart.png',
            fields: {
                title: {
                    type: String,
                    required: false
                },
                subtitle: {
                    type: String,
                    required: false
                },
                xAxisTitle: {
                    type: String,
                    required: false
                },
                yAxisTitle: {
                    type: String,
                    required: false
                }
            }

        },
        {
            id: 'bar',
            name: 'Bar Chart',
            logo: '/images/barchart.png',
            fields: {
                title: {
                    type: String,
                    required: false
                },
                subtitle: {
                    type: String,
                    required: false
                },
                xAxisTitle: {
                    type: String,
                    required: false
                },
                yAxisTitle: {
                    type: String,
                    required: false
                }
            }

        },
        {
            id: 'pie',
            name: 'Pie Chart',
            logo: '/images/piechart.png',
            fields: {
                title: {
                    type: String,
                    required: false
                },
                subtitle: {
                    type: String,
                    required: false
                },
                xAxisTitle: {
                    type: String,
                    required: false
                },
                yAxisTitle: {
                    type: String,
                    required: false
                }
            }
        },
        {
            id: 'line',
            name: 'Line Chart',
            logo: '/images/linechart.png',
            fields: {
                title: {
                    type: String,
                    required: false
                },
                subtitle: {
                    type: String,
                    required: false
                },
                xAxisTitle: {
                    type: String,
                    required: false
                },
                yAxisTitle: {
                    type: String,
                    required: false
                }
            }
        },
        {
            id: 'area',
            name: 'Area Chart',
            logo: '/images/areachart.png',
            fields: {
                title: {
                    type: String,
                    required: false
                },
                subtitle: {
                    type: String,
                    required: false
                },
                xAxisTitle: {
                    type: String,
                    required: false
                },
                yAxisTitle: {
                    type: String,
                    required: false
                }
            }
        },
        {
            id: 'column_stacked',
            name: 'Stacked Column Chart',
            logo: '/images/columnchart_stacked.png',
            fields: {
                title: {
                    type: String,
                    required: false
                },
                subtitle: {
                    type: String,
                    required: false
                },
                xAxisTitle: {
                    type: String,
                    required: false
                },
                yAxisTitle: {
                    type: String,
                    required: false
                }
            }
        },
        {
            id: 'line_timeseries',
            name: 'Time Series Chart',
            logo: '/images/linechart_timeseries.png',
            fields: {
                title: {
                    type: String,
                    required: false
                },
                subtitle: {
                    type: String,
                    required: false
                },
                xAxisTitle: {
                    type: String,
                    required: false
                },
                yAxisTitle: {
                    type: String,
                    required: false
                }
            }
        },
        {
            id: 'bubble',
            name: 'Bubble Chart',
            logo: '/images/bubblechart.png',
            fields: {
                title: {
                    type: String,
                    required: false
                },
                subtitle: {
                    type: String,
                    required: false
                },
                xAxisTitle: {
                    type: String,
                    required: false
                },
                yAxisTitle: {
                    type: String,
                    required: false
                }
            }
        },
    ]
}
