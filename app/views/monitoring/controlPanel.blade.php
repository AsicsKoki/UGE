@extends('layouts/main')
@section('main')
	<div id="wrapper">
		<!-- Sidebar -->
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li><a href="{{ URL::route('controlPanel') }}">Control Panel</a>
				</li>
				<li><a href="{{ URL::route('measurements') }}">Current Measurements</a>
				</li>
				<li><a href="{{ URL::route('consumption') }}">Consumption</a>
				</li>
			</ul>
		</div>
		<div class='row'>
			<div class="widget" id="voltage"></div>
			<div class="widget" id="power"></div>
			<div class="widget" id="powerMax"></div>
			<div class="widget" id="">
				<div class="measureBox"><span id="Hz">50.00</span> Hz</div>
				<div class="measureBox"><span id="kWh">6371</span> kWh</div>
				<div class="measureBox"><span id="kVArh">6636</span> kVArh</div>
			</div>
		</div>
@stop
@section('moreScripts')
<script type="text/javascript">
"use strict"
	$(function () {
    var gaugeOptions = {
	    chart: {
	        type: 'solidgauge'
	    },

	    title: null,

	    pane: {
	    	center: ['50%', '85%'],
	    	size: '140%',
	        startAngle: -90,
	        endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
	    },

	    tooltip: {
	    	enabled: false
	    },

	    // the value axis
	    yAxis: {
			stops: [
				[0.1, '#DF5353'], // green
	        	[0.5, '#55BF3B'], // yellow
	        	[0.9, '#DF5353'] // red
			],
			lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
	        title: {
                y: -70
	        },
            labels: {
                y: 16
            }
	    },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };

var gaugeOptionsPower = {
    chart: {
        type: 'solidgauge'
    },

    title: null,

    pane: {
    	center: ['50%', '85%'],
    	size: '140%',
        startAngle: -90,
        endAngle: 90,
        background: {
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
            innerRadius: '60%',
            outerRadius: '100%',
            shape: 'arc'
        }
    },

    tooltip: {
    	enabled: false
    },

    // the value axis
    yAxis: {
		stops: [
			[0.1, '#DF5353'], // green
        	[0.5, '#55BF3B'], // yellow
        	[0.9, '#DF5353'] // red
		],
		lineWidth: 0,
        minorTickInterval: null,
        tickPixelInterval: 400,
        tickWidth: 0,
        title: {
            y: -70
        },
        labels: {
            y: 16
        }
    },

    plotOptions: {
        solidgauge: {
            dataLabels: {
                y: 5,
                borderWidth: 0,
                useHTML: true
            }
        }
    }
};

    // The speed gauge
    $('#voltage').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
	        min: 160,
	        max: 280,
	        title: {
	            text: 'Napon'
	        }
	    },

	    credits: {
	    	enabled: false
	    },

	    series: [{
	        name: 'Napon',
	        data: [219],
	        dataLabels: {
	        	format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                   	'<span style="font-size:12px;color:black">trentunti napon (V)</span></div>'
	        },
	        tooltip: {
	            valueSuffix: 'V'
	        }
	    }]

	}));

    // The RPM gauge
    $('#power').highcharts(Highcharts.merge(gaugeOptionsPower, {
        yAxis: {
        	min: 0,
        	max: 5,
	        title: {
	            text: 'Power'
	        }
	    },

	    series: [{
	        name: 'Power',
	        data: [1],
	        dataLabels: {
	        	format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' +
                   	'<span style="font-size:12px;color:black">Trentuntna snaga (kW)</span></div>'
	        },
	        tooltip: {
	            valueSuffix: ' Maximum Power'
	        }
	    }]

	}));
var gaugeOptionsPowerMax = {
    chart: {
        type: 'solidgauge'
    },

    title: null,

    pane: {
    	center: ['50%', '85%'],
    	size: '140%',
        startAngle: -90,
        endAngle: 90,
        background: {
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
            innerRadius: '60%',
            outerRadius: '100%',
            shape: 'arc'
        }
    },

    tooltip: {
    	enabled: false
    },

    // the value axis
    yAxis: {
		stops: [
			[0.1, '#DF5353'], // green
        	[0.5, '#55BF3B'], // yellow
        	[0.9, '#DF5353'] // red
		],
		lineWidth: 0,
        minorTickInterval: null,
        tickPixelInterval: 400,
        tickWidth: 0,
        title: {
            y: -70
        },
        labels: {
            y: 16
        }
    },

    plotOptions: {
        solidgauge: {
            dataLabels: {
                y: 5,
                borderWidth: 0,
                useHTML: true
            }
        }
    }
};

    // The speed gauge
    $('#powerMax').highcharts(Highcharts.merge(gaugeOptionsPowerMax, {
        yAxis: {
	        min: 0,
	        max: 5,
	        title: {
	            text: 'Power'
	        }
	    },

	    credits: {
	    	enabled: false
	    },

	    series: [{
	        name: 'Max Power',
	        data: [3.1],
	        dataLabels: {
	        	format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                   	'<span style="font-size:12px;color:black">Maksimalna snaga(kW)</span></div>'
	        },
	        tooltip: {
	            valueSuffix: 'kW'
	        }
	    }]

	}));

    // Bring life to the dials
    setInterval(function () {
    	// Speed
        var chart = $('#voltage').highcharts();
        if (chart) {
            var point = chart.series[0].points[0],
                newVal,
                value = Math.round((Math.random() * (240 - 180)+ 180));
            point.update(value);
        }

        // RPM
        chart = $('#power').highcharts();
        if (chart) {
            var point = chart.series[0].points[0],
                newVal,
                inc = Math.random() - 0.5;

            newVal = point.y + inc;
            if (newVal < 0 || newVal > 5) {
                newVal = point.y - inc;
            }

            point.update(newVal);
        }
        var value = Number($('#kWh').text());
    	var increment = Math.round(Math.random() * 15);
    	$('#kWh').html(value + increment);

        var value2 = Number($('#kVArh').text());
    	var increment2 = Math.round(Math.random() * 15);
    	$('#kVArh').html(value2 + increment2);

    	var value3 = Number($('#Hz').text());
    	var increment3 = Math.random()*2;
    	if(value3 > 51){
    		$('#Hz').html((value3 - increment3).toFixed(2));
    	} else {
    		$('#Hz').html((value3 + increment3).toFixed(2));
    	}
    }, 20000);
});
</script>
@stop