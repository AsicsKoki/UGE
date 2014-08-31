<div class="col-md-12">
	<table id="alarmMeasuresTable" class="table table-hover display">
		<thead>
			<th class="text-center">Id</th>
			<th class="text-center">Alarm Name</th>
			<th class="text-center">Measure Type Name</th>
			<th class="text-center">Modbus Measure Function</th>
			<th class="text-center">Modbus Alarm State Register</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@foreach($alarms as $alarm)
				<tr>
					<td>
						{{$alarm['id']}}
					</td>
					<td>
						{{$alarm['alarm_type']['name_en']}}
					</td>
					<td class="text-center">
						{{$alarm['measure_type_in_analyzer_type']['measure_type']['name_en']}}
					</td>
					<td class="text-center">
						{{$alarm['modbus_alarm_state_function']}}
					</td>
					<td class="text-center">
						{{$alarm['modbus_alarm_state_register']}}
					</td>
					<td class="text-center">
						<a class="btn btn-primary" href="{{ URL::route('getAlarmTypesForMeasureTypesInAnalyzer', ['atid' => $atid, 'mid' => $alarm['id']])}}">Edit</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>