@extends('layouts/main')
@section('moreStyles')
	<title>{{$title}}</title>
@stop
@section('main')
	<div id="wrapper">
		{{ Former::open()->class('form-inline date-pick')->method('GET')}}
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
		<div class="chart-container">
			<div id="chart"></div>
			<div class="no-data hide alert alert-warning" role="alert">Nema dostupnih podataka za odabrani period.</div>
		</div>
@stop
@section('moreScripts')
{{HTML::style('bower_components/bootstrap-daterangepicker/daterangepicker-bs3.css')}}
{{HTML::script('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}
{{ HTML::script('bower_components/highstock-release/highstock.js') }}
{{ HTML::script('bower_components/highcharts-release/modules/exporting.js') }}

<script type="text/javascript">
$(function () {
	var dataSet = {{json_encode($dataSet)}};

	var analizator1 = [], length = 0;;

	for (var key in dataSet) {
		analizator1.push({
			data: dataSet[key].map(function(item){
				/*return {
					x: new Date(item['vreme_iz_analizatora'] * 1000), 
					y: item['vrednost']
				};*/
				return [item['vreme_iz_analizatora'] * 1000, item['vrednost']]
			}),
			name: 'Merač ' + key,
			tooltip: {
				valueDecimals: 2
			}
		});
		length += dataSet[key].length;
	}

	if (!length) {
		$('#chart').addClass('hide');
		$('.no-data').removeClass('hide');
	}

	$('#chart').highcharts('StockChart', {
		/*rangeSelector: {
			inputEnabled: $('#chart').width() > 480,
			selected: 4
		},
		yAxis: {
			labels: {
				formatter: function () {
					return (this.value > 0 ? ' + ' : '') + this.value + '%';
				}
			},
			plotLines: [{
				value: 0,
				width: 2,
				color: 'silver'
			}]
		},
		plotOptions: {
			series: {
				compare: 'percent'
			}
		},
		tooltip: {
			pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
			valueDecimals: 2
		},*/
		series : analizator1
	});

	console.log(analizator1[0]);

	moment.locale('sr');

	 $('input.date-range').daterangepicker({locale: {
                applyLabel: 'Primeni',
                cancelLabel: 'Otkaži',
                fromLabel: 'Od',
                toLabel: 'Do',
                weekLabel: 'N',
                customRangeLabel: 'Manuelni opseg',
                daysOfWeek: moment.weekdaysMin(),
                monthNames: moment.monthsShort(),
                firstDay: moment.localeData()._week.dow
            }
        });
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