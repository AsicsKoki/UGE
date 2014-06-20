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
            </ul>
        </div>
        <div id="consumtion">
            
        </div>
@stop
@section('moreScripts')
{{HTML::style('js/bootstrap-daterangepicker/daterangepicker-bs3.css')}}
{{HTML::script('js/momentjs/min/moment.min.js')}}
{{HTML::script('js/bootstrap-daterangepicker/daterangepicker.js')}}
<script type="text/javascript">
$(function () {

        $(function() {
    $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=aapl-v.json&callback=?', function(data) {
        // create the chart
        $('#container').highcharts('StockChart', {
            chart: {
                alignTicks: false
            },

            rangeSelector: {
                inputEnabled: $('#container').width() > 480,
                selected: 1
            },

            title: {
                text: ''
            },

            series: [{
                type: 'column',
                name: '',
                data: data,
                dataGrouping: {
                    units: [[
                        'week', // unit name
                        [1] // allowed multiples
                    ], [
                        'month',
                        [1, 2, 3, 4, 6]
                    ]]
                }
            }]
        });
    });
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