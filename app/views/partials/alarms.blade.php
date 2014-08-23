<div class="col-md-12">
	<table id="alarmTableHidden" class="table table-hover hide">
		<tbody>
			@foreach($alarms as $key => $alarm)
				<tr>
					<td>
						<input type="hidden" name="alarm_types_id[]" value="{{$alarm}}"> {{$key}}</td>
					<td class="text-center">
						<input type="checkbox" name="alarm_level[]" value="1"><br>
						<input type="hidden" name="alarm_level[]" value="0">
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col-md-12">
	<table id="measureTable" class="table table-hover display">
		<thead>
			<th>Alarm Type</th>
			<th>Alarm Level <br><input type="checkbox"></th>
		</thead>
		<tbody>
			@foreach($alarms as $key => $alarm)
				<tr>
					<td>
						<input type="hidden" name="alarm_types_id[]" value="{{$alarm}}"> {{$key}}</td>
					<td class="text-center">
						<input type="checkbox" name="alarm_level[]" value="1"><br>
						<input type="hidden" name="alarm_level[]" value="0">
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>