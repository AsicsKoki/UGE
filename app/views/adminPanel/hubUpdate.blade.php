@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
	<div class="panelContent panelContent container col-xs-8">
		<ul class="tab-margin nav nav-tabs" role="tablist">
			<li class="active"><a href="#section1">Hub details</a></li>
			<li><a href="#section2">Signals</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active in fade" id="section1">
			<h4>Update Hub</h4>
				<div class='col-md-6'>
					{{ Former::open()->class('form')->method('POST')->enctype('multipart/form-data')->action(URL::route('postHub', ['hubId'=>$hub->id]))
						->rules([
								'name'                  => 'required|min:3',
								'interface_type'        => 'required',
								'ip_address'            => 'required',
								'active'                => 'required',
								'port'                  => 'required',
								'rc_address'            => 'required',
								'serial_port_speed'     => 'required',
								'serial_port_parity'    => 'required',
								'serial_port_speed'     => 'required',
								'serial_port_stop_bits' => 'required',
							])}}
						{{Former::populate($hub)}}
							{{Former::text('name')->label('name')->placeholder('Hub Name')->class('form-control')}}

						{{Former::text('description')->label('Description')->placeholder('Description')->class('form-control')}}

						{{Former::text('comment')->label('Comment')->placeholder('Comment')->class('form-control')}}
						{{Former::text('postal_address')->label('Address')->placeholder('Address')->class('form-control')}}

						{{Former::text('interface_type')->label('Interface Type')->placeholder('Interface Type')->class('form-control')}}
						{{Former::text('ip_address')->label('IP')->placeholder('Enter IP')->class('form-control')}}
						<div class="control-group">
							<a class="form-control submit-button submit-button-margin-bottom btn btn-danger" href="{{ URL::route('cancelHubAction')}}">Cancel</a>
						</div>
				</div>
				<div class='col-md-6'>
						{{Former::text('port')->label('Port')->placeholder('Enter port')->class('form-control')}}

						{{Former::text('rc_address')->label('RC Address')->placeholder('RC Address')->class('form-control')}}

						{{Former::text('serial_port_speed')->label('Serial Port Speed')->placeholder('Serial Port Speed')->class('form-control')}}

						{{Former::text('serial_port_parity')->label('Serial Port parity')->placeholder('Serial Port parity')->class('form-control')}}

						{{Former::text('serial_port_stop_bits')->label('Serial Port stop_bits')->placeholder('Serial Port stop_bits')->class('form-control')}}

						{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}
						{{Former::hidden()->name('_token')->value(csrf_token())}}
						{{Former::submit('Submit')->class('form-control submit-button submit-button-margin-bottom btn btn-info')}}
				</div>
				{{ Former::close() }}
			</div>
			<div class="tab-pane active in fade" id="section2">
				<a class="btn btn-primary new-entry" href="{{ URL::route('getAssignSignal',['hid'=> $hub->id ]) }}">New signal</a>
				<table id="signalTable" class="table table-hover display">
					<thead>
						<th>Name en</th>
						<th>Name SRB</th>
						<th>Action</th>
					</thead>
					<tbody>
					@foreach($signalTypes as $signalType)
						<tr>
							<td>{{$signalType['signal_type']['name_en']}}</td>
							<td>{{$signalType['signal_type']['name_sr']}}</td>
							<td>
								<a class="btn btn-primary" href="{{ URL::route('getEditSignal', ['sid' => $signalType['id'], 'hid'=> $hub->id ]) }}">Edit</a>
								<a class="btn btn-danger" href="{{ URL::route('removeSignalType', ['sid'=> $signalType['id'], 'hid'=> $hub->id ]) }}">Delete</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop
@section('moreScripts')
<script type="text/javascript">
$('#signalTable').dataTable();
$('.nav-tabs li a').click(function (e) {
	e.preventDefault()
	$(this).tab('show')
})
</script>
@stop
