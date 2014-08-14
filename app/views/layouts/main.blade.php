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
		<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					<a class="navbar-brand" href="#">United Green Energy</a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="{{ URL::route('homePage') }}">Home</a></li>
							<li><a href="#">About us</a></li>
							<li><a href="#">Contact</a></li>
							<li><a href="{{ URL::route('monitoring') }}">Monitoring</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							@if (1)
								<li><a href="{{ URL::route('analyzers') }}">Admin Panel</a>
								</li>
							@endif
							<li><a href="{{ URL::route('logout') }}">Log out</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
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
		{{ HTML::script('bower_components/jquery/dist/jquery.js') }}
		{{ HTML::script('bower_components/moment/min/moment-with-locales.min.js') }}
		{{ HTML::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}

		{{ HTML::script('bower_components/datatables/media/js/jquery.dataTables.js') }}
		@yield('main')
		@yield('moreScripts')
	</body>
</html>