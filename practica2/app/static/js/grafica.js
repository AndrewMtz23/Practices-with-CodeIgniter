// Instancia de la gráfica
var migrafica = Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Temperatura media mensual'
    },
    subtitle: {
        text: 'Fuente: Curso AWI4 T218'
    },
    xAxis: {
        categories: Highcharts.getOptions().lang.shortMonths,
        accessibility: {
            description: 'Meses'
        },
        min:0,
        max:11
    },
    yAxis: {
        title: {
            text: 'Temperatura °C'
        },
        labels: {
            format: '{value}°'
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name:"",
        data: []
    }]
});