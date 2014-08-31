<div class="col-md-12">
	<table id="alarmMeasuresTable" class="table table-hover display">
		<thead>
			<th>Id</th>
			<th>Name</th>
			<th>Measure Type Name</th>
			<th>Modbus Measure Function</th>
			<th>Modbus Alarm State Register</th>
			<th>Action</th>
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
					<td>
						{{$alarm['measure_type_in_analyzer_type']['measure_type']['name_en']}}
					</td>
					<td class="text-center">
						{{$alarm['modbus_alarm_state_function']}}
					</td>
					<td class="text-center">
						{{$alarm['modbus_alarm_state_register']}}
					</td>
					<td class="text-center">
						<a class="btn btn-primary" href="{{ URL::route('analyzerMeasureAlarmTypesEdit', ['alid' => 6, 'mid' => 5, 'aid' => 4 ])}}">Edit</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>