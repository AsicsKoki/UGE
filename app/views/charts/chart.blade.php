@extends('layouts/main')
@section('main')
	<div class="chart-content">

	</div>
@stop
@section('moreScripts')
	<script>
		$(function () {
			$('.chart-content').highcharts({
			  title: {
			      text: 'Napon',
			      x: -20 //center
			  },
			  xAxis: {
			      categories: ['19:20', '19:25', '19:30', '19:35', '19:40']
			  },
			  yAxis: {
			      title: {
			          text: 'Napon (V)'
			      },
			      plotLines: [{
			          value: 0,
			          width: 1,
			          color: '#808080'
			      }]
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
			  series: [{
			      name: 'Analyzer 1',
			      data: [224.722, 224.732, 229.722, 224.100, 226.722]
			  }, {
			      name: 'Analyzer 2',
			      data: [234.722, 234.732, 239.722, 236.100, 231.722]
			  }, {
			      name: 'Analyzer 3',
			      data: [221.322, 234.300, 227.701, 221.199, 226.111]
			  }]
			});
		});
	</script>
@stop