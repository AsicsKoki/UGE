@extends('layouts/main')
@section('main')
	<div class='col-md-6'>
		{{ Former::open()->class('form-horizontal')->method('PUT')->enctype('multipart/form-data')->action(URL::route('putUser', ['userId'=>$user->id]))
		/*->rules([
					'username'              => 'required|min:3',
					'password'              => 'required|min:3',
					'password_confirmation' => 'required|min:3',
					'name'                  => 'required',
					'contact_address'       => 'required',
					'contact_person'        => 'required',
					'contact_phone'         => 'required',
					'contact_sms'           => 'required',
					'account_type_id'       => 'required',
				])*/}}
			{{Former::populate($user)}}
			{{Former::text('username')->label('username')->placeholder('Username')->class('form-control')}}
			{{Former::password('password')->label('password')->placeholder('Password')->class('form-control')}}
			{{Former::password('password_confirmation')->label('password')->placeholder('Retype your password')->class('form-control')}}
			{{Former::text('name')->label('Client name')->placeholder('Client name')->class('form-control')}}
			{{Former::text('contact_address')->label('Address')->placeholder('Client Adress')->class('form-control')}}
			{{Former::text('contact_person')->label('Contact person')->placeholder('Contact person')->class('form-control')}}
			{{Former::text('contact_phone')->label('Phone')->placeholder('Client Phone')->class('form-control')}}
			{{Former::text('contact_sms')->label('SMS phone')->placeholder('Client SMS')->class('form-control')}}
			{{Former::text('account_type_id')->label('Account Type')->placeholder('1: Admin 0: User')->class('form-control')}}
			{{Former::hidden()->name('_token')->value(csrf_token())}}
			{{Former::submit('Register')->class('form-control')}}
		{{ Former::close() }}
	</div>
@stop
@section('moreScripts')
{{HTML::style('js/datatables/media/css/jquery.dataTables.css')}}
{{ HTML::script('js/datatables/media/js/jquery.dataTables.js') }}
<script>
	$('div.users-list table').dataTable();
</script>
@stop