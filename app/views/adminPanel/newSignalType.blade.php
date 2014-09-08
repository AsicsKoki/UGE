@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div>
		<div class="panelContent container col-md-8">
			{{ Former::open()->class('form-horizontal')->method('POST')->enctype('multipart/form-data')->action(URL::route('postNewSignal'))
				->rules([
						'name_sr' => 'required',
						'active'  => 'required',
					])}}
				{{Former::text('name_en')->label('Name EN')->placeholder('Measure name EN')->class('form-control')}}

				{{Former::text('name_sr')->label('Name SRB')->placeholder('Name SRB')->class('form-control')}}


				{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				<div class="control-group">
						<a class="form-control submit-button submit-button-margin-bottom btn btn-danger" href="{{ URL::to('signalManagement')}}">Cancel</a>
					</div>
				{{Former::submit('Submit')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
			{{ Former::close() }}
		</div>
	</div>
@stop
