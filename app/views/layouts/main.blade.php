<!doctype html>
<html>
	<head>
		{{-- STYLES --}}
		{{HTML::style('css/main.css')}}
		{{HTML::style('css/sidebar.css')}}
		{{HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css')}}
		{{HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css')}}
		{{HTML::style('//cdn.datatables.net/1.10.0/css/jquery.dataTables.css')}}
		@yield('moreStyles')
	</head>
	<body>
		<div>
			<img class="imgThumb" style="width:250; height:150px;" src="/img/nis.jpg"/>Benzinska stanica: Ledena Stena, Nis
			<img class="pull-right" src="/img/analizator.png"/>
		</div>
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li><a href="{{ URL::route('controlPanel') }}">Control Panel</a>
				</li>
				<li><a href="{{ URL::route('measurements') }}">Current Measurements</a>
				</li>
			</ul>
		</div>
		@include('partials.status')
		{{-- SCRIPTS --}}
		{{ HTML::script('js/jquery/dist/jquery.js') }}
		{{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js') }}
		{{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.9/angular.min.js') }}
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/highcharts-more.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		<script src="http://code.highcharts.com/modules/solid-gauge.src.js"></script>
		<script src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
		@yield('main')
		@yield('moreScripts')
	</body>
</html>