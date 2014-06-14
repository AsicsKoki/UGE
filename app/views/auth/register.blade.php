@extends('layouts/main')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div>
		<div style="left:20%" class="register-form">
			{{ Former::open()->class('form-horizontal')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewUser'))
				->rules([
						'username'              => 'required|min:3',
						'password'              => 'required|min:3',
						'password_confirmation' => 'required|min:3',
						'name'                  => 'required',
						'contact_address'       => 'required',
						'contact_person'        => 'required',
						'contact_phone'         => 'required',
						'contact_sms'           => 'required',
						'account_type_id'       => 'required',
					])}}
				{{Former::text('username')->label('username')->placeholder('Username')->class('form-control')}}
				{{Former::password('password')->label('password')->placeholder('Password')->class('form-control')}}
				{{Former::password('password_confirmation')->label('password')->placeholder('Retype your password')->class('form-control')}}
				{{Former::text('name')->label('Client name')->placeholder('Client name')->class('form-control')}}
				{{Former::text('contact_address')->label('Address')->placeholder('Client Adress')->class('form-control')}}
				{{Former::text('contact_person')->label('Contact person')->placeholder('Contact person')->class('form-control')}}
				{{Former::text('contact_phone')->label('Phone')->placeholder('Client Phone')->class('form-control')}}
				{{Former::text('contact_sms')->label('SMS phone')->placeholder('Client SMS')->class('form-control')}}

				{{Former::select('account_type_id')->options([1=>'Admin', 2=>'User'])->label('Account Type')->class('form-control')}}

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Register')->class('form-control submit-button')}}
			{{ Former::close() }}
		</div>
	</div>
@stop
