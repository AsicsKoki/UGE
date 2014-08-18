@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div>
		<div style="left:20%" class="register-form">
			{{ Former::open()->class('form-horizontal')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewMeasure'))
				->rules([
						'name_en' => 'required|min:3',
						'name_sr' => 'required',
						'unit'    => 'required',
						'active'  => 'required',
					])}}
				{{Former::text('name_en')->label('Name EN')->placeholder('Measure name EN')->class('form-control')}}

				{{Former::text('name_sr')->label('Name SRB')->placeholder('Name SRB')->class('form-control')}}

				{{Former::text('unit')->label('Unit')->placeholder('Unit')->class('form-control')}}

				{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Submit')->class('form-control submit-button')}}
			{{ Former::close() }}
		</div>
	</div>
@stop
