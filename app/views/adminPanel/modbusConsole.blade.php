@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent container col-md-8">
		<ul class="tab-margin nav nav-tabs" role="tablist">
			<li class="active"><a href="#section1">Query</a></li>
			<li><a href="#section2">Response - History</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active in fade" id="section1">
				<div class="row col-md-6" >
					{{ Former::open()->class('form tab-margin')->method('POST')->enctype('multipart/form-data')->action(URL::route('sendModbusQuery'))
					->rules([
						'function' => 'required|max:2|min:2',
						'comment'    => 'required',
						'data_bytes'  => 'required',
						])}}
				      <select name="analyzers_id" id="input" class="form-control" required="required">
				      	@foreach($analyzerData as $analyzer)
				          	<option class="option" value="{{$analyzer['id']}}" data-address="{{$analyzer['modbus_slave_address']}}">{{$analyzer['name']}}</option>
				          @endforeach
				      </select>
					{{Former::hidden('users_id')->value(Auth::user()->id)}}

					{{Former::text('function')->label('Modbus function')->class('form-control')->id('modbusFunction')}}

					{{Former::text('time')->label('')->class('hide form-control')}}

					{{Former::text('comment')->label('Komentar')->class('form-control')}}

					{{Former::text('data_bytes')->label('Modbus command')->class('form-control')}}

					{{Former::hidden()->name('_token')->value(csrf_token())}}
					{{Former::submit('Submit')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
					{{ Former::close() }}
				</div>
			</div>
			<div class="tab-margin tab-pane in fade" id="section2">
				<div class="row col-md-8">
					<table class='table display responsive no-wrap'>
					<thead>
						<th>Analyzer</th>
						<th>User</th>
						<th>Time</th>
						<th>Time ms</th>
						<th>Comment</th>
						<th>Function</th>
						<th>Modbus message</th>
						<th>Response Time</th>
						<th>Response Time ms</th>
						<th>Response function</th>
						<th>Response Modbus Message</th>
						<th>Response Modbus Comment</th>
					</thead>
					<tbody>
						@if (count($modbusData))
							@foreach ($modbusData as $data)
								<tr>
									<td>{{$data['analyzer']['name']}}</td>
									<td>{{$data['user']['username']}}</td>
									<td>{{$data['time']}}</td>
									<td>{{$data['time_ms']}}</td>
									<td>{{$data['comment']}}</td>
									<td>{{$data['function']}}</td>
									<td>{{$data['data_bytes']}}</td>
									<td>{{$data['modbus_response']['time']}}</td>
									<td>{{$data['modbus_response']['time_ms']}}</td>
									<td>{{$data['modbus_response']['function']}}</td>
									<td>{{$data['modbus_response']['data_bytes']}}</td>
									<td>{{$data['modbus_response']['data_bytes']}}</td>
								</tr>
							@endforeach
						@else
						<tr>
							<td colspan="9">There are no records</td>
						</tr>
						@endif
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
@stop
@section('moreScripts')
<script type="text/javascript">
	var responsiveHelper;
	var breakpointDefinition = {
	    tablet: 1024,
	    phone : 480
	};
	$('.table').dataTable();
$('.nav-tabs li a').click(function (e) {
	e.preventDefault()
	$(this).tab('show')
})
</script>
@stop