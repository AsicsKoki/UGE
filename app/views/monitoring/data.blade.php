@extends('layouts/main')
@section('main')
	<div id="wrapper">
        {{ Former::open()->class('form-inline')->method('GET')}}
        <div>
            <div class="form-group">
                <label for="daterange">Opseg datuma</label>
            </div>
            <div class="form-group">
                {{Former::text('daterange')->label('')->class('form-control date-range')}}
            </div>
            <div class="form-group">
               {{Former::hidden('date-start')}}
               {{Former::hidden('date-end')}}
               {{Former::button('Osveži')->class('form-control btn btn-primary submit')}}
               {{Former::button('Resetuj')->class('form-control btn btn-primary reset')}}
            </div>
        </div>
        {{ Former::close() }}
        <div id="chart"></div>
@stop
@section('moreScripts')
{{HTML::style('js/bootstrap-daterangepicker/daterangepicker-bs3.css')}}
{{HTML::script('js/bootstrap-daterangepicker/daterangepicker.js')}}
<script type="text/javascript">
$(function () {
    var dataSet = {{json_encode($dataSet)}};

    var analizator1 = [];
    for (var key in dataSet)
        analizator1.push({data: dataSet[key].map(function(item){
            return {
                x: new Date(item['vreme_iz_analizatora'] * 1000), // mnozi se sa 1000 da bi se pretvorilo u milisekunde, jer u JS se tako pisu timestamp-ovi
                y: item['vrednost']
            };
        })});

        $('#chart').highcharts({
            title: {
                text: '',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20 //center
            },
            yAxis: {
                title: {
                    text: ''
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
                valueSuffix: ''
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