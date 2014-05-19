@extends('layouts/main')
@section('main')
	<div class="content">
		<div class="login-form">
			{{ Former::open()->method('POST') }}
				{{Former::text('username')->required()->label('username')->placeholder('Username')}}
				{{Former::password('password')->required()->label('password')->placeholder('Password')}}
				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Sign in')}}
			{{ Former::close() }}
		</div>
	</div>