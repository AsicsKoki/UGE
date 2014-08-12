<!doctype html>
<html>
	<head>
		{{-- STYLES --}}
		{{HTML::style('css/main.css')}}
		{{HTML::style('css/sidebar.css')}}
		{{HTML::style('js/bootstrap/dist/css/bootstrap.min.css')}}
		{{HTML::style('js/bootstrap/dist/css/bootstrap-theme.min.css')}}
		{{HTML::style('js/datatables/media/css/jquery.dataTables.css')}}
		@yield('moreStyles')
	</head>
	<body>
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<li><a href="{{ URL::route('getTemperature') }}">Temperatura</a>
				</li>
				<li><a href="{{ URL::route('getHumidity') }}">Vlažnost</a>
				</li>
				<li><a href="{{ URL::route('getCo') }}">CO</a>
				</li>
				<li><a href="{{ URL::route('getCo2') }}">CO2</a>
				</li>
				<li><a href="{{ URL::route('getPm10') }}">PM10</a>
				</li>
				<li><a href="{{ URL::route('getPm25') }}">PM2.5</a>
				</li>
				<li><a href="{{ URL::route('getPm03') }}">PM0.3</a>
				</li>
			</ul>
		</div>
		@include('partials.status')
		{{-- SCRIPTS --}}
		{{ HTML::script('js/jquery/dist/jquery.js') }}
		{{ HTML::script('js/momentjs/min/moment.min.js') }}
		{{ HTML::script('js/bootstrap/dist/js/bootstrap.min.js') }}
		{{ HTML::script('js/highcharts-release/highcharts.js') }}
		{{ HTML::script('js/highcharts-release/modules/exporting.js') }}
		{{ HTML::script('js/highcharts-release/highcharts-more.js') }}
		{{ HTML::script('js/highstock-release/highstock.js') }}
		{{ HTML::script('js/highstock-release/modules/exporting.js') }}
		{{ HTML::script('js/highcharts-release/modules/solid-gauge.src.js') }}
		{{ HTML::script('js/datatables/media/js/jquery.dataTables.js') }}
		@yield('main')
		@yield('moreScripts')
	</body>
</html>