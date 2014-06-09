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
            <div id="voltage1"></div>
        </div>
@stop
@section('moreScripts')
<script type="text/javascript">
$(function () {
     var dataSet = {{json_encode($dataSet)}};
     var analizator1 = [];
     for (var key in dataSet['1'])
        analizator1.push({data: dataSet['1'][key]});
        $('#voltage1').highcharts({
            title: {
                text: 'Voltage',
                x: -20 //center
            },
            subtitle: {
                text: 'Voltage across time span',
                x: -20 //center
            },
            yAxis: {
                title: {
                    text: 'Voltage (V)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            xAxis : {
            title: {
                  text: "Time Span"
              },
            type: 'datetime',
            dateTimeLabelFormats: {
                day: '%e of %b'
            }
        },
            tooltip: {
                valueSuffix: 'V'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: analizator1
        });
    });
</script>
@stop