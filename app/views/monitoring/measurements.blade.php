@extends('layouts/main')
@section('main')
	<div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li><a href="{{ URL::route('controlPanel') }}">Dashboard</a>
                </li>
                <li><a href="{{ URL::route('measurements') }}">Current Measurements</a>
                </li>
                <li><a href="{{ URL::route('consumption') }}">Consumption</a>
                </li>
            </ul>
        </div>
        {{ Former::open()->class('form-inline')->method('GET')->action(URL::route('measurements'))}}
        <div>
            <div class="row col-xs-4">
                <select name="chart-type" id="input" class="form-control" required="required">
                    <option value="1">Prikaz napona</option>
                    <option value="2">Prikaz struje</option>
                    <option value="3">Prikaz aktivna snage</option>
                </select>
            </div>
            <div style="clear:both;"></div>
            <div  id="voltage1"></div>
        </div>
        <div>

                    <div class="form-group">
                        <label for="daterange">Date Range</label>
                    </div>
                    <div class="form-group">
                        {{Former::text('daterange')->label('')->class('form-control date-range')}}
                    </div>
                    <div class="form-group">
                       {{Former::hidden('date-start')}}
                       {{Former::hidden('date-end')}}
                       {{Former::button('Refresh')->class('form-control btn btn-primary submit')}}
                       {{Former::button('Reset')->class('form-control btn btn-primary reset')}}
                    </div>
        </div>
        {{ Former::close() }}
@stop
@section('moreScripts')
{{HTML::style('js/bootstrap-daterangepicker/daterangepicker-bs3.css')}}
{{HTML::script('js/momentjs/min/moment.min.js')}}
{{HTML::script('js/bootstrap-daterangepicker/daterangepicker.js')}}
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

         $('input.date-range').daterangepicker();
         $('input.date-range').on('apply.daterangepicker', function(ev, picker) {
          $('input[name=date-start]').val(picker.startDate.valueOf());
          $('input[name=date-end]').val(picker.endDate.valueOf());
        });

        $('button.submit').on('click', function(){
            $(this).parents('form').find('input.date-range').attr('disabled', 'disabled');
            $(this).parents('form').submit();
        });

        $('button.reset').on('click', function(){
            $(this).parents('form').find('input.date-range').attr('disabled', 'disabled');
            $(this).parents('form').find('input[name=date-start], input[name=date-end]').attr('disabled', 'disabled');
            $(this).parents('form').submit();
        });
    });
</script>
@stop