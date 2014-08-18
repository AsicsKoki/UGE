@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div>
		<div style="left:20%" class="register-form">
			{{ Former::open()->class('form-horizontal')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewClient'))
				->rules([
						'name'           => 'required|min:3',
						'address'        => 'required',
						'contact_person' => 'required',
						'active'         => 'required',
					])}}
				{{Former::text('name')->label('name')->placeholder('Client name')->class('form-control')}}
				{{Former::text('contact_person')->label('Contact person')->placeholder('Contact person')->class('form-control')}}
				{{Former::text('address')->label('Address')->placeholder('Client Adress')->class('form-control')}}
				{{Former::text('contact_phone')->label('Phone')->placeholder('Client Phone')->class('form-control')}}
				{{Former::text('contact_email')->label('Contact Email')->placeholder('Contact Email')->class('form-control')}}

				{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Register')->class('form-control submit-button')}}
			{{ Former::close() }}
		</div>
	</div>
@stop
