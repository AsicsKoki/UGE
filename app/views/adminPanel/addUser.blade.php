@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
<div class="panelContent col-xs-8">
	<div class='col-md-6'>
		{{ Former::open()->class('form-horizontal')->method('post')->enctype('multipart/form-data')->action(URL::route('addUser', ['cid'=>$cid]))
		->rules([
					'username'              => 'required|min:3',
					'password'              => 'required|min:3',
					'password_confirmation' => 'required|min:3',
					'contact_phone'         => 'required',
					'contact_sms'           => 'required',
					'account_type_id'       => 'required',
				])}}
			{{Former::text('username')->label('username')->placeholder('Username')->class('form-control')}}
			{{Former::password('password')->label('password')->placeholder('Password')->class('form-control')}}
			{{Former::password('password_confirmation')->label('password')->placeholder('Retype your password')->class('form-control')}}
			{{Former::text('name')->label('Client name')->placeholder('Client name')->class('form-control')}}
			{{Former::text('customers_id')->label('')->class('hide')->value($cid)}}
			{{Former::text('contact_email')->label('Email')->placeholder('Email')->class('form-control')}}

			{{Former::text('contact_sms')->label('SMS phone')->placeholder('Client SMS')->class('form-control')}}
			<div class="control-group required">
				<label for="account_types_id" class="control-label">Account type</label>
				<select name="account_types_id" id="" class="form-control">
				@foreach ($accountTypes as $accountType)
					<option value="{{$accountType['id']}}">{{$accountType['type']}}</option>
				@endforeach
				</select>
			</div>



			{{Former::hidden()->name('_token')->value(csrf_token())}}
			<div class="control-group">
				<a class="form-control submit-button submit-button-margin-bottom btn btn-danger" href="/clients/{{$cid}}">Cancel</a>
			</div>
			{{Former::submit('Add User')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
		{{ Former::close() }}
		</div>
	</div>
@stop
@section('moreScripts')
@stop