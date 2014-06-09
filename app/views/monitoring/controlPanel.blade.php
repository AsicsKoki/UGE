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
        <div>
            <div class="widget" id="voltage"></div>
            <div class="widget" id="power"></div>
            <div class="widget" id="powerMax"></div>
        </div>
@stop
@section('moreScripts')
<script type="text/javascript">
$(function () {
    var data = {{json_encode($latestVoltage[0]['measures'][0]['vrednost'])}};
    console.log(data);
    $('#voltage').highcharts({
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Latest Voltage'
        },
        pane: {
            startAngle: -130,
            endAngle: +130,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
        // the value axis
        yAxis: {
            min: 160,
            max: 280,
            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',
            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'V'
            },
            plotBands: [{
                from: 160,
                to: 200,
                color: '#DF5353' // red
            }, {
                from: 200,
                to: 240,
                color: '#55BF3B' // green
            }, {
                from: 240,
                to: 280,
                color: '#DF5353' // red
            }]
        },
        series: [{
            name: 'Speed',
            data: [data],
            tooltip: {
                valueSuffix: ' V'
            }
        }]
    },
    // Add some life
    function (chart) {
            // setInterval(function () {
            //     $.AJAX({
            //         url:"/voltageUpdate.php",
            //         type: "GET",
            //         success: function(data){
            //             // data.update(newVal);
            //         }
            //     })
            // }, 3000);
    });
});
</script>
@stop