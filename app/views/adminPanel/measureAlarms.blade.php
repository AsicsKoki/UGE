@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
	<div class="panelContent container col-xs-8">
		<span><h4>Add new alarm</h4></span>
		{{ Former::open()->class('form')->method('post')->enctype('multipart/form-data')
			->rules([
				])}}
				<div class="col-md-6">
					<div class="control-group">
						<label for="alarm_id" class="control-label">Select alarm<sup>*</sup>
						</label>
						<select name="alarm_id" class="form-control">
							@foreach ($alarmTypes as $alarmType)
								<option value="{{$alarmType['id']}}">{{$alarmType['name_en']}}</option>
							@endforeach
						</select>
					</div>
					<div class="control-group">
						<label for="active" class="control-label">Select state<sup>*</sup>
						</label>
						<select name="active" class="form-control">
								<option value="1">Active</option>
								<option value="0">Inactive</option>
						</select>
					</div>

					{{Former::number('alarm_level')->label('Alarm level')->class('form-control')->step('any')}}

					{{Former::hidden()->name('_token')->value(csrf_token())}}
					{{Former::button('Update Analyzer')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
				</div>
		{{ Former::close() }}
	</div>
@stop
@section('moreScripts')
{{ HTML::script('js/measures.js') }}
@stop