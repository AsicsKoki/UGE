@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
<div class="panelContent col-xs-8">
	<div class='col-md-6'>
		{{ Former::open()->class('form-horizontal')->method('PUT')->enctype('multipart/form-data')->action(URL::route('putUser', ['userId'=>$user->id]))
		->rules([
					'username'              => 'required|min:3',
					'name'                  => 'required',
					'contact_address'       => 'required',
					'contact_person'        => 'required',
					'contact_phone'         => 'required',
					'contact_sms'           => 'required',
					'account_type_id'       => 'required',
				])}}
			{{Former::populate($user)}}
			{{Former::text('username')->label('username')->placeholder('Username')->class('form-control')}}
			{{Former::password('password')->label('password')->placeholder('Password')->class('form-control')}}
			{{Former::password('password_confirmation')->label('password')->placeholder('Retype your password')->class('form-control')}}
			{{Former::text('name')->label('Client name')->placeholder('Client name')->class('form-control')}}
			{{Former::text('contact_email')->label('Email Address')->placeholder('Email Adress')->class('form-control')}}
			{{Former::text('contact_sms')->label('SMS phone')->placeholder('Client SMS')->class('form-control')}}
			{{Former::select('account_type_id')->options([1=>'Admin', 0=>'User'])->label('Account Type')->class('form-control')}}
			{{Former::hidden()->name('_token')->value(csrf_token())}}
			<div class="control-group">
				<a class="form-control submit-button submit-button-margin-bottom btn btn-danger" href="{{ URL::route('cancelUserAction')}}">Cancel</a>
			</div>
			{{Former::submit('Update User')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
		{{ Former::close() }}
		</div>
	</div>
@stop
@section('moreScripts')
@stop