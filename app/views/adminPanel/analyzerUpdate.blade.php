@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
	<div class="panelContent container col-xs-8">
		<div class='new-analyzer register-form'>
			{{ Former::open()->class('form-horizontal')->method('PUT')->enctype('multipart/form-data')->action(URL::route('putAnalyzer', ['analyzerId'=>$analyzer->id]))
				->rules([
						'name'                   => 'required|min:3',
						'modbus_slave_address'   => 'required',
						'current_message_period' => 'required',
						'short_message_period'   => 'required',
						'alarm_message_period'   => 'required',
						'measures_before_alarm'  => 'required',
						'hubs_id'                => 'required',
						'customers_id'           => 'requiresd',
						'active'                 => 'required',
					])}}
				<div class="col-md-6">
					{{Former::populate($analyzer)}}
						{{Former::text('name')->label('name')->placeholder('Analyzer name')->class('form-control')}}

					{{Former::text('description')->label('Description')->placeholder('Analyzer description')->class('form-control')}}

					{{Former::text('comment')->label('Comment')->placeholder('Comment')->class('form-control')}}

					{{Former::text('modbus_slave_address')->label('Modbus Slave Address')->placeholder('Modbus Slave Address')->class('form-control')}}

					{{Former::text('current_measure_period')->label('Current Measure Period')->placeholder('Analyzer Current Measure Period')->class('form-control')}}

					{{Former::text('short_message_period')->label('Short Message Period')->placeholder('Short Message Period')->class('form-control')}}
				</div>
				<div class="col-md-6">
					{{Former::text('analyzer_types_id')->label('Analyzer type')->placeholder('Analyzer type id')->class('form-control')}}

					{{Former::text('alarm_message_period')->label('Alarm Message Period')->placeholder('Alarm Message Period')->class('form-control')}}

					{{Former::text('measures_before_alarm')->label('Short Message Period')->placeholder('Short Message Period')->class('form-control')}}

					{{Former::text('hubs_id')->label('Hub Id')->placeholder('Enter Id')->class('form-control')}}

					{{Former::text('input_position')->label('Input Position')->placeholder('Nullable')->class('form-control')}}

					{{Former::text('customers_id')->label('Customer Id')->placeholder('Enter Customer Id')->class('form-control')}}

					{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}
					{{Former::hidden()->name('_token')->value(csrf_token())}}
				</div>
				<div class="col-md-12">
					<table id="measureTable" class="table table-hover display">
						<thead>
							<th>Measure type</th>
							<th>Long message postition <br><input type="checkbox"></th>
							<th>Short message position <br><input type="checkbox"></th>
							<th>Current message postition <br><input type="checkbox"></th>
						</thead>
						<tbody>
							@foreach($measures as $measure)
								<tr>
									<td>
										<input type="hidden" name="measure_types_id[]" value="{{$measure['id']}}"> {{$measure['name_en']}}</td>
									<td class="text-center">
										@if($measure['long_message_position'] = 1)
										    <input type="checkbox" name="long_message_position[]" value="1" checked><br>
											<input type="hidden" name="long_message_position[]" value="0">
										@else
											<input type="checkbox" name="long_message_position[]" value="1"><br>
											<input type="hidden" name="long_message_position[]" value="0">
										@endif
									</td>
									<td class="text-center">
										@if($measure['short_message_position'] = 1)
										    <input type="checkbox" name="short_message_position[]" value="1" checked><br>
											<input type="hidden" name="short_message_position[]" value="0">
										@else
											<input type="checkbox" name="short_message_position[]" value="1"><br>
											<input type="hidden" name="short_message_position[]" value="0">
										@endif
									</td>
									<td class="text-center">
										@if($measure['current_message_position'] = 1)
										    <input type="checkbox" name="current_message_position[]" value="1" checked><br>
											<input type="hidden" name="current_message_position[]" value="0">
										@else
											<input type="checkbox" name="current_message_position[]" value="1"><br>
											<input type="hidden" name="current_message_position[]" value="0">
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{Former::submit('Update customer')->class('form-control btn btn-info submit-button')}}
			{{ Former::close() }}
		</div>
	</div>
@stop
@section('moreScripts')
<script>
	$('#measureTable').dataTable();
</script>
@stop