<div class="col-md-12">
	<table id="measureTableHidden" class="table table-hover hide">
		<tbody>
			@foreach($measures as $key => $measure)
				<tr>
					<td>
						<input type="hidden" name="measure_types_in_analyzers_id[]" value="{{$measure['id']}}"> {{$measure['measure_type']['name_en']}}</td>
					<td class="text-center">
						@if($measure['long_message_position'] == 1)
						    <input type="checkbox" name="long_message_position[]" value="1" checked>
							<input type="hidden" name="long_message_position[]" value="0">
						@else
							<input type="checkbox" name="long_message_position[]" value="1">
							<input type="hidden" name="long_message_position[]" value="0">
						@endif
					</td>
					<td class="text-center">
						@if($measure['short_message_position'] == 1)
						    <input type="checkbox" name="short_message_position[]" value="1" checked>
							<input type="hidden" name="short_message_position[]" value="0">
						@else
							<input type="checkbox" name="short_message_position[]" value="1">
							<input type="hidden" name="short_message_position[]" value="0">
						@endif
					</td>
					<td class="text-center">
						@if($measure['current_message_position'] == 1)
						    <input type="checkbox" name="current_message_position[]" value="1" checked>
							<input type="hidden" name="current_message_position[]" value="0">
						@else
							<input type="checkbox" name="current_message_position[]" value="1">
							<input type="hidden" name="current_message_position[]" value="0">
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col-md-12">
	<table id="measureTable" class="table table-hover display">
		<thead>
			<th>Measure type</th>
			<th>Long message postition <br><input type="checkbox"></th>
			<th>Short message position <br><input type="checkbox"></th>
			<th>Current message postition <br><input type="checkbox"></th>
			<th>Assign alarm</th>
			<th>Status</th>
		</thead>
		<tbody>
			@foreach($measures as $key => $measure)
				<tr>
					<td>
						<input type="hidden" name="measure_types_in_analyzers_id[]" value="{{$measure['id']}}"> {{$measure['measure_type']['name_en']}}</td>
					<td class="text-center">
						@if($measure['long_message_position'] == 1)
						    <input type="checkbox" name="long_message_position[]" value="1" checked>
							<input type="hidden" name="long_message_position[]" value="0">
						@else
							<input type="checkbox" name="long_message_position[]" value="1">
							<input type="hidden" name="long_message_position[]" value="0">
						@endif
					</td>
					<td class="text-center">
						@if($measure['short_message_position'] == 1)
						    <input type="checkbox" name="short_message_position[]" value="1" checked>
							<input type="hidden" name="short_message_position[]" value="0">
						@else
							<input type="checkbox" name="short_message_position[]" value="1">
							<input type="hidden" name="short_message_position[]" value="0">
						@endif
					</td>
					<td class="text-center">
						@if($measure['current_message_position'] == 1)
						    <input type="checkbox" name="current_message_position[]" value="1" checked>
							<input type="hidden" name="current_message_position[]" value="0">
						@else
							<input type="checkbox" name="current_message_position[]" value="1">
							<input type="hidden" name="current_message_position[]" value="0">
						@endif
					</td>
					<td>
						<a class="btn btn-primary" href="{{ URL::route('analyzerMeasureAlarmTypes', array('aid'=>$analyzerId, 'mid' => $measure['id'])) }}">Add alarm</a>
					</td>
					<td>
						@if($measure['active'] ==1 )
							<button data-id="{{$measure['id']}}" name="active[]" type="button" class="status btn btn-danger">Deactivate</button>
						@else
							<button data-id="{{$measure['id']}}" name="active[]" type="button" class="status btn btn-success">Activate</button>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>