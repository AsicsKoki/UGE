<!doctype html>
<html>
	<head>
		{{-- STYLES --}}
		{{HTML::style('css/main.css')}}
		{{HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css')}}
		{{HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css')}}
		@yield('moreStyles')
	</head>
	<body>
		<div>
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
							<li><a href="#">Charts</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							@if (Auth::user()->account_type_id)
								<li><a href="{{ URL::route('register') }}">Admin Panel</a>
								</li>
								<li><a href="{{ URL::route('register') }}">Users</a>
								</li>
							@endif
							<li><a href="{{ URL::route('logout') }}">Log out</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</div>
		{{-- SCRIPTS --}}
		{{ HTML::script('js/jquery/dist/jquery.js') }}
		{{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js') }}
		{{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.9/angular.min.js') }}
		{{ HTML::script('js/main.js') }}
		{{ HTML::script('js/highcharts/highcharts.js') }}
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		@yield('main')
		@yield('moreScripts')
	</body>
</html>