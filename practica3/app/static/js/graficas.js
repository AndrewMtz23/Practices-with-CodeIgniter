// Función para generar una gráfica de calificaciones
const grafica_calificaciones = (titulo, series) => {

    Highcharts.chart('div-grafica', {
        chart: {
            type: 'spline',
            scrollablePlotArea: {
                minWidth: 600,
                scrollPositionX: 1
            }
        },
        title: {
            text: titulo,
            align: 'center'
        },
        subtitle: {
            text: 'Calificaciones parciales: Curso AWI4 T218',
            align: 'center'
        },
        xAxis: {
            categories: ["Primera", "Segunda", "Tercera", "Cuarta", "Quinta"],
            title: {
                text: 'PERIODOS DE EVALUACIÓN',
                style: {
                    fontSize: "16px"
                }
            },
        },
        yAxis: {
            title: {
                text: 'CALIFICACIONES'
            },
            min: 0,
            max:12,
            minorGridLineWidth: 0,
            gridLineWidth: 0,
            alternateGridColor: null,
            // Define bandas de color para diferentes rangos de calificación
            plotBands: [{ 
                from: 0,
                to: 8,
                color: 'rgba(255, 0, 0, 0.2)',
                label: {
                    text: 'No acreditado',
                    style: {
                        color: '#606060'
                    }
                }
            }, { 
                from: 8,
                to: 8.5,
                color: 'rgba(255, 195, 0, 0.2)',
                label: {
                    text: 'Satisfactorio',
                    style: {
                        color: '#606060'
                    }
                }
            }, { 
                from: 8.5,
                to: 9.5,
                color: 'rgba(0, 255, 0, 0.2)',
                label: {
                    text: 'Destacado',
                    style: {
                        color: '#606060'
                    }
                }
            }, { 
                from: 9.5,
                to: 10,
                color: 'rgba(0, 0, 255, 0.2)',
                label: {
                    text: 'Autónomo',
                    style: {
                        color: '#606060'
                    }
                }
            }]
        },
        plotOptions: {
            spline: {
                lineWidth: 2,
                states: {
                    hover: {
                        lineWidth: 4
                    }
                },
                marker: {
                    enabled: false
                },
            }
        },
        series: series,
        navigation: {
            menuItemStyle: {
                fontSize: '20px'
            }
        }
    });

}

// Función para generar una gráfica de rangos de edad por sexo
const grafica_rangos = series => {
    // Definir una función auxiliar para obtener el valor absoluto
    Highcharts.Templating.helpers.abs = value => Math.abs(value);
    
    // Generar las categorías de rangos de edad
    const categories = [];
    for (let rango = 1; rango <= 10; rango++) {
        categories.push(((rango -1) * 10).toString() + "-" + (rango * 10 - 1).toString());
    }
    categories.push("100+");

    Highcharts.chart('div-grafica', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Rangos de edad por sexo',
            align: 'center'
        },
        subtitle: {
            text: 'Fuente: Curso AWI4 T218',
            align: 'center'
        },
        accessibility: {
            point: {
                valueDescriptionFormat: '{index}. Edad {xDescription}, {value}.'
            }
        },
        xAxis: [{
            categories: categories,
            reversed: false,
            labels: {
                step: 1
            },
            accessibility: {
                description: 'Edad (Masculinos)'
            }
        }, {
            // Eje X opuesto para mostrar etiquetas en ambos lados
            opposite: true,
            reversed: false,
            categories: categories,
            linkedTo: 0,
            labels: {
                step: 1
            },
            accessibility: {
                description: 'Edad (Femeninos)'
            }
        }],
        yAxis: {
            title: {
                text: "ALUMNOS"
            },
            labels: {
                format: '{abs value}'
            },
            accessibility: {
                description: 'Alumnos',
                rangeDescription: 'Rango: 0 to 10'
            },
            tickInterval: 1
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                borderRadius: '50%'
            }
        },
        tooltip: {
            format: '<b>{series.name}, edad {point.category}</b><br/>' +
                'Alumnos: {(abs point.y):.0f}'
        },
        series: series
    });
}

// Función para generar una gráfica de periodos de evaluación
const grafica_periodos = series => {
	Highcharts.chart({
	    chart: {
	    	renderTo : "div-grafica",
	        type: 'area'
	    },
	    title: {
	        useHTML: true,
	        text: 'Evaluaciones Realizadas por Periodo',
	        align: 'center'
	    },
	    subtitle: {
	        text: 'Fuente: Curso Awi_4.0 T-218',
	        align: 'center'
	    },
	    accessibility: {
	        point: {
	            valueDescriptionFormat: '{index}. {point.category}, {point.y:,.1f} alumnos, {point.percentage:.0f}%.'
	        }
	    },
	    yAxis: {
	        labels: {
	            format: '{value}%'
	        },
	        title: {
	            enabled: false
	        }
	    },
	    xAxis : [{
	    	categories : [ "Primera", "Segunda", "Tercera", "Cuarta", "Quinta" ]
	    }], 
	    tooltip: {
	        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.percentage:.1f}%</b> ({point.y:,.0f} alumnos)<br/>',
	        split: true
	    },
	    plotOptions: {
	        area: {
	            stacking: 'percent',
	            marker: {
	                enabled: false
	            }
	        }
	    },
	    series: series
	});
}