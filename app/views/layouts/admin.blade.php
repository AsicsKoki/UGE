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
		<header>
			<div class="row">
				<img class="col-xs-4 col-md-4" src="img/baner.png" alt="United Green Energy" />
				<address class="col-xs-8 col-md-8">
				  <strong class="name text-uppercase">United <span class="green">Green</span> Energy </strong><br>
				  <label>Vaša potrošnja, naša briga!</label><br>
				  <a href="http://www.uge.rs">www.uge.rs</a>
			  	</address>
			</div>
		</header>
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
						<ul class="nav navbar-nav navbar-right">
							<li><a href="{{ URL::route('homePage') }}">Home</a></li>
							<li><a href="#">About us</a></li>
							<li><a href="#">Contact</a></li>
							<li><a href="{{ URL::route('monitoring') }}">Monitoring</a></li>
							@if (Auth::user()->account_types_id)
								<li><a href="{{ URL::route('analyzers') }}">Admin Panel</a>
								</li>
							@endif
							<li><a href="{{ URL::route('logout') }}">Log out</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>

		@include('partials.status')
		{{-- SCRIPTS --}}
		{{ HTML::script('bower_components/jquery/dist/jquery.js') }}
		{{ HTML::script('bower_components/moment/min/moment-with-locales.min.js') }}
		{{ HTML::script('bower_components/bootstrap/dist/js/bootstrap.min.js') }}

		{{ HTML::script('bower_components/datatables/media/js/jquery.dataTables.js') }}

		@yield('main')
		@yield('moreScripts')
		<footer id="footer" class="panel-footer">
			<address>
			  <strong class="text-uppercase">United Green Energy DOO Niš</strong><br>
			  Generala Milojka Lešjanina 43/15<br>
			  PIB 106741513<br>
			  <abbr title="Phone">Tel:</abbr> (+381) 064-236-31-31 <br>
			  Email: <a href="mailto:info@uge.rs">info@uge.rs</a>
		  	</address>
		</footer>
	</body>
</html>