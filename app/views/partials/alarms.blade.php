<div class="col-md-12">
	<table id="alarmTableHidden" class="table table-hover">
		<tbody>
			@foreach($alarms as $key => $alarm)
				<tr>
					<td>
						{{$key}}
					</td>
					<td>
						<input type="text" name="measure_type_in_analyzer_id[]" value="">
					</td>
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
	<table id="alarmTable" class="table table-hover display">
		<thead>
			<th>Alarm Type</th>
			<th>Measure Type In Analyzer</th>
			<th>Alarm Level <br><input type="checkbox"></th>
		</thead>
		<tbody>
			@foreach($alarms as $key => $alarm)
				<tr>
					<td>
						<label for="">{{$key}}</label>
						{{Former::hidden()->name('alarm_ids[]')->value($alarm)}}
					</td>
					<td>
						<select class="" type="hidden" name="measure_type_in_analyzer_id[]" >
							@foreach ($measureTypeInAnalyzerIds as $mtiai)
								<option value="{{$mtiai['id']}}">{{$mtiai['id']}} - {{$mtiai['measure_type']['name_en']}}</option>
							@endforeach
						</select>
					</td>
					<td class="text-center">
						<input type="checkbox" name="alarm_level[]" value="1"><br>
						<input type="hidden" name="alarm_level[]" value="0">
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>