@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
	<div class="panelContent container col-xs-8">
		<span><h4>Edit alarm (Analyzer {{link_to_route('getAnalyzer', $analyzer->name, ['id' => $analyzer->id])}})</h4></span>
		{{ Former::open()->class('form')->method('post')->enctype('multipart/form-data')->action(URL::route('postAnalyzerMeasureAlarmTypesEdit', ['alid' => $alarm['id'], 'aid'=> $analyzer->id]))}}
				<div class="col-md-6">
					<div class="control-group">
						<label for="alarm_id" class="control-label">Select alarm<sup>*</sup>
						</label>
						<select name="alarm_id" class="form-control">
							@foreach ($alarmTypes as $alarmType)
								@if($alarmType['id'] == $alarm['id'])
								<option selected value="{{$alarmType['id']}}">{{$alarmType['name_en']}}</option>
								@else
									<option value="{{$alarmType['id']}}">{{$alarmType['name_en']}}</option>
								@endif
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

					{{Former::number('alarm_level')->label('Alarm level')->class('form-control')->step('any')->value($alarm['alarm_level'])}}

					{{Former::hidden()->name('_token')->value(csrf_token())}}
					{{Former::submit('Save')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
				</div>
		{{ Former::close() }}
	</div>
@stop
@section('moreScripts')
@stop