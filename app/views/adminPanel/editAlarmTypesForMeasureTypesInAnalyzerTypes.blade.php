@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div>
		<div class="panelContent container col-xs-8">
			<h4>Edit Alarm Type in Measure Type for Analyzer Type</h4>
			{{ Former::open()->class('form-horizontal')->method('POST')->action(URL::route('postAlarmTypesForMeasureTypesInAnalyzer', ['atid'=> $atmtat->alarm_types_id, 'mid' => $atmtat->id]))
				->rules([
						'name_sr' => 'required',
						'active'  => 'required',
					])}}
				{{Former::populate($atmtat)}}
				<div class="control-group">
					<label for="active" class="control-label">Alarm Type<sup>*</sup>
					</label>
					<select name="alarm_types_id" class="form-control">
						@foreach ($alarmTypes as $alarm)
							<option {{$alarm->id == $atmtat->alarm_types_id ? 'selected' : ''}} value="{{$alarm->id}}">{{$alarm->name_en}}</option>
						@endforeach
					</select>
				</div>

				<div class="control-group">
					<label for="active" class="control-label">Measure Type<sup>*</sup>
					</label>
					<select name="measure_types_in_analyzer_types_id" class="form-control">
						@foreach ($measureTypes as $measure)
							<option {{$measure->id == $atmtat->measure_types_in_analyzer_types_id ? 'selected' : ''}} value="{{$measure->id}}">{{$measure->measure_type->name_en}}</option>
						@endforeach
					</select>
				</div>

				{{Former::text('modbus_alarm_state_function')->label('Modbus Function')->class('form-control')}}
				{{Former::text('modbus_alarm_state_register')->label('Modbus Register')->class('form-control')}}

				{{Former::hidden()->name('_token')->value(csrf_token())}}
				<div>
					<div class="control-group col-md-6">
						<a href="{{URL::to('alarmManagement')}}" class="form-control submit-button submit-button-margin-bottom btn btn-danger">Cancel</a>
					</div>
					<div class="control-group col-md-6">
						{{Former::submit('Submit')->class('col-xs-6 form-control submit-button submit-button-margin-bottom btn btn-info')}}
					</div>
				</div>
			{{ Former::close() }}
		</div>
	</div>
@stop
