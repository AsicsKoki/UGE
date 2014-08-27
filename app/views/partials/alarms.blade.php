<div class="col-md-12">
	<table id="alarmTable" class="table table-hover display">
		<thead>
			<th>Alarm Type</th>
			<th>Measure Type</th>
			<th>Alarm Level</th>
			<th>Operation</th>
			<th>Status</th>
		</thead>
		<tbody>
			@foreach($alarms as $alarm)
				<tr>
					<td>
						{{$alarm['alarm_type']['name_en']}}
					</td>
					<td>
						{{$alarm['measure_type_in_analyzer']['measure_type']['name_en']}}
					</td>
					<td class="text-center">
						{{round($alarm['alarm_level'], $precision = 2)}}
					</td>
					<td class="text-center">
						<a class="btn btn-primary" href="{{ URL::route('analyzerMeasureAlarmTypesEdit', ['alid' => $alarm['id'], 'mid' => $alarm['measure_type_in_analyzer']['id'], 'aid' => $analyzerId ])}}">Edit</a>
						<a class="btn btn-danger" href="{{ URL::route('deleteMeasureTypeAlarm', array('alid'=> $alarm['id'] )) }}">Delete</a>
					</td>
					<td class="text-center">
						@if($alarm['active'] ==1 )
							<button data-id="{{$alarm['id']}}" name="active[]" type="button" class="status btn btn-danger">Deactivate</button>
						@else
							<button data-id="{{$alarm['id']}}" name="active[]" type="button" class="status btn btn-success">Activate</button>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>