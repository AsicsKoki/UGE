@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div>
		<div class="panelContent container col-xs-8">
		<span><h4>Edit Signal (Hub: {{link_to_route('getHub', $hub['name'], ['hubId' => $hub['id']])}})</h4></span>
			{{ Former::open()->class('form-horizontal')->method('POST')->enctype('multipart/form-data')->action(URL::route('postEditSignal', ['sid' => $signal['id'], 'hid'=> $hub['id']]))
				->rules([
					])}}
				{{Former::populate($signal)}}
				{{Former::text('input_position')->label('Input position')->placeholder('Input position')->class('form-control')}}

				{{Former::text('negative_logic')->label('Negative logic')->placeholder('Negative logic')->class('form-control')}}


				{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Submit')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
			{{ Former::close() }}
		</div>
	</div>
@stop
