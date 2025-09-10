$(function() {
  'use strict'



  var colors = {
    primary        : "#6571ff",
    secondary      : "#7987a1",
    success        : "#05a34a",
    info           : "#66d1d1",
    warning        : "#fbbc06",
    danger         : "#ff3366",
    light          : "#e9ecef",
    dark           : "#060c17",
    muted          : "#7987a1",
    gridBorder     : "rgba(77, 138, 240, .15)",
    bodyColor      : "#b8c3d9",
    cardBg         : "#0c1427"
  }

  var fontFamily = "'Roboto', Helvetica, sans-serif"


  // Date Picker
  if($('#dashboardDate').length) {
    flatpickr("#dashboardDate", {
      wrap: true,
      dateFormat: "d-M-Y",
      defaultDate: "today",
    });
  }
  // Date Picker - END


  // New User Chart
  if($('#userChart').length) {
    var chartData = monthlyUserRegistrationsData;
    var options1 = {
      chart: {
        type: "line",
        height: 60,
        sparkline: {
          enabled: !0
        }
      },
      series: [{
        name: '',
        data: chartData.map(entry => entry.registrations)
      }],
      xaxis: {
        type: 'datetime',
        categories: chartData.map(entry => entry.month),
      },
      stroke: {
        width: 2,
        curve: "smooth"
      },
      markers: {
        size: 0
      },
      colors: [colors.primary],
    };
    new ApexCharts(document.querySelector("#userChart"),options1).render();
  }
  // New User Chart - END



  // AgentChart Chart
  if($('#agentChart').length) {
    var chartData = monthlyAgentRegistrationsData;
    var options2 = {
      chart: {
        type: "bar",
        height: 60,
        sparkline: {
          enabled: !0
        }
      },
      plotOptions: {
        bar: {
          borderRadius: 2,
          columnWidth: "60%"
        }
      },
      colors: [colors.primary],
      series: [{
        name: '',
        data: chartData.map(entry => entry.registrations)
      }],
      xaxis: {
        type: 'datetime',
        categories: chartData.map(entry => entry.month),
      },
    };
    new ApexCharts(document.querySelector("#agentChart"),options2).render();
  }
  // AgentChart Chart - END

  // Month Revenue Chart
  if ($('#monthlyRevenueChart').length) {
    var lineChartOptions = {
        chart: {
            type: "line",
            height: '400',
            parentHeightOffset: 0,
            foreColor: colors.bodyColor,
            background: colors.cardBg,
            toolbar: {
                show: false
            },
        },
        theme: {
            mode: 'light'
        },
        tooltip: {
            theme: 'light'
        },
        colors: [colors.primary, colors.danger, colors.warning],
        grid: {
            padding: {
                bottom: -4,
            },
            borderColor: colors.gridBorder,
            xaxis: {
                lines: {
                    show: true
                }
            }
        },
        series: [
            {
                name: "Revenue",
                data: monthlyRevenueData
            },
        ],
        xaxis: {
            type: "datetime",
            categories: monthYearLabels,
            lines: {
                show: true
            },
            axisBorder: {
                color: colors.gridBorder,
            },
            axisTicks: {
                color: colors.gridBorder,
            },
            crosshairs: {
                stroke: {
                    color: colors.secondary,
                },
            },
        },
        yaxis: {
            title: {
                text: 'Revenue ( ' + currency_symbol + '1000 x )',
                style:{
                    size: 9,
                    color: colors.muted
                }
            },
            tickAmount: 4,
            tooltip: {
                enabled: true
            },
            crosshairs: {
                stroke: {
                    color: colors.secondary,
                },
            },
        },
        markers: {
            size: 0,
        },
        stroke: {
            width: 2,
            curve: "straight",
        },
    };
    var apexLineChart = new ApexCharts(document.querySelector("#monthlyRevenueChart"), lineChartOptions);
    apexLineChart.render();
  }
  //Month Revenue Chart - END



  // Monthly Sales Chart
  if ($('#monthlySalesChart').length) {
    var options = {
        chart: {
            type: 'bar',
            height: '318',
            parentHeightOffset: 0,
            foreColor: colors.bodyColor,
            background: colors.cardBg,
            toolbar: {
                show: false
            },
        },
        theme: {
            mode: 'light'
        },
        tooltip: {
            theme: 'light'
        },
        colors: [colors.primary],
        fill: {
            opacity: .9
        },
        grid: {
            padding: {
                bottom: -4
            },
            borderColor: colors.gridBorder,
            xaxis: {
                lines: {
                    show: true
                }
            }
        },
        series: [{
            name: 'Sales',
            data: monthlySalesData
        }],
        xaxis: {
            type: 'datetime',
            categories: monthYearLabels,
            axisBorder: {
                color: colors.gridBorder,
            },
            axisTicks: {
                color: colors.gridBorder,
            },
        },
        yaxis: {
            title: {
                text: 'Number of Sales',
                style: {
                    size: 9,
                    color: colors.muted
                }
            },
        },
        legend: {
            show: true,
            position: "top",
            horizontalAlign: 'center',
            fontFamily: fontFamily,
            itemMargin: {
                horizontal: 8,
                vertical: 0
            },
        },
        stroke: {
            width: 0
        },
        dataLabels: {
            enabled: true,
            style: {
                fontSize: '10px',
                fontFamily: fontFamily,
            },
            offsetY: -27
        },
        plotOptions: {
            bar: {
                columnWidth: "50%",
                borderRadius: 4,
                dataLabels: {
                    position: 'top',
                    orientation: 'vertical',
                }
            },
        },
    };

    var apexBarChart = new ApexCharts(document.querySelector("#monthlySalesChart"), options);
    apexBarChart.render();
}
  // Monthly Sales Chart - END

});
