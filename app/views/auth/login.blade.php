@extends('layouts/main')
@section('main')
	<div class="content">
		<div class="login-form">
			<form role="form" method="post">
				<div class="form-group">
					<label for="username-input">Username</label>
					<input type="text" class="form-control" class="username-input" placeholder="Enter Username">
				</div>
				<div class="form-group">
					<label for="password-input">Password</label>
					<input type="password" class="form-control" class="password-input" placeholder="Password">
				</div>
				<button type="submit" class="btn btn-default">Log in</button>
			</form>
		</div>
	</div>