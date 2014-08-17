<!doctype html>
<html>
	<head>
		{{-- STYLES --}}
		{{HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css')}}
		{{HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css')}}
		{{HTML::style('css/main.css')}}
		@yield('moreStyles')
	</head>
	<body class="login">
		<div class="content">
			<div class="login-form" role="form">
				{{ Former::open()->method('POST')->rules(array(
					'username'              => 'required|min:3',
					'password'              => 'required|min:3',
				)) }}
				{{Former::text('username')->required()->label('username')->placeholder('Username')->class('form-control')}}
				{{Former::password('password')->required()->label('password')->placeholder('Password')->class('form-control')}}
				{{Former::hidden()->name('_token')->value(csrf_token())}}
				<div class="control-group submit-btn">
					{{Former::submit('Sign in')->class('btn btn-info btn-block')}}
				</div>
				{{ Former::close() }}
			</div>
		</div>
		@yield('main')
		{{-- SCRIPTS --}}
		{{ HTML::script('https://code.jquery.com/jquery-1.11.1.min.js') }}
		{{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js') }}
		{{ HTML::script('js/main.js') }}
		@yield('moreScripts')
	</body>
</html>