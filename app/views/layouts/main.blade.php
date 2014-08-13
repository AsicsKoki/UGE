<!doctype html>
<html>
	<head>
		{{-- STYLES --}}
		{{HTML::style('css/main.css')}}
		{{HTML::style('css/sidebar.css')}}
		{{HTML::style('bower_components/bootstrap/dist/css/bootstrap.min.css')}}
		{{HTML::style('bower_components/bootstrap/dist/css/bootstrap-theme.min.css')}}
		{{HTML::style('bower_components/datatables/media/css/jquery.dataTables.css')}}
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
		{{ HTML::script('bower_components/jquery/dist/jquery.js') }}
		{{ HTML::script('bower_components/moment/min/moment-with-locales.min.js') }}
		{{ HTML::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}

		{{ HTML::script('bower_components/datatables/media/js/jquery.dataTables.js') }}
		@yield('main')
		@yield('moreScripts')
	</body>
</html>