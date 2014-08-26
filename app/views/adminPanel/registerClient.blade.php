@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent container col-xs-8">
		<div class="col-md-6">
			{{ Former::open()->class('form')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewClient'))
				->rules([
						'name'           => 'required|min:3',
						'address'        => 'required',
						'contact_person' => 'required',
						'active'         => 'required',
					])}}
				{{Former::text('name')->label('name')->placeholder('Client name')->class('form-control')}}
				{{Former::text('contact_person')->label('Contact person')->placeholder('Contact person')->class('form-control')}}
				{{Former::text('address')->label('Address')->placeholder('Client Adress')->class('form-control')}}
				<div class="control-group">
					<a class="form-control submit-button submit-button-margin-bottom btn btn-danger" href="{{ URL::route('cancelClientAction')}}">Cancel</a>
				</div>
		</div>
		<div class="col-md-6">
				{{Former::text('contact_phone')->label('Phone')->placeholder('Client Phone')->class('form-control')}}
				{{Former::text('contact_email')->label('Contact Email')->placeholder('Contact Email')->class('form-control')}}

				{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Submit')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
		</div>
			{{ Former::close() }}
	</div>
@stop
