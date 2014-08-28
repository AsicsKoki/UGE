@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
	<div class="panelContent container col-xs-8">
		<ul class="tab-margin nav nav-tabs" role="tablist">
			<li class="active"><a href="#section1">Alarms</a></li>
			<li><a href="#section2">Analyzer alarms</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active in fade" id="section1">
				<a class="btn btn-primary new-entry" href="{{ URL::route('getRegisterAlarm') }}">New Alarm</a>
				<table id="analyzersTable" class="table table-hover display">
					<thead>
						<th>id</th>
						<th>Name</th>
						<th>Name</th>
						<th>Action</th>
						<th>Status</th>
					</thead>
					<tbody>
					@foreach($alarms as $alarm)
						<tr>
							<td>{{$alarm['id']}}</td>
							<td>{{$alarm['name_en']}}</td>
							<td>{{$alarm['name_sr']}}</td>
							<td>
								<a class="btn btn-primary" href="{{ URL::route('getEditAlarm', ['aid' => $alarm['id']])}}">Edit</a>
								<a class="btn btn-danger" href="{{ URL::route('removeAlarmType', ['aid'=> $alarm['id']]) }}">Delete</a>
							</td>
							<td>
								@if($alarm['active']==1)
									<button type="button" class="btn btn-danger">Deactivate</button>
								@else;
									<button type="button" class="btn btn-success">Activate</button>
								@endif
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="section2">
				<div class="analyzerAlarms">
					123
				</div>
			</div>
		</div>
	</div>
@stop
@section('moreScripts')
<script type="text/javascript">
$('#analyzersTable').dataTable();
$('.status').on("click",function(e){
	e.preventDefault();
	if($(this).hasClass('btn-danger')){
		var state = 0;
	} else {
		var state = 1;
	}
	var id = $(this).data('id');
	var self = this;
	$.ajax({
		url: "alarmManagement/changeAlarmState",
		type: "post",
		data: {
			state: state,
			id: id
		},
		success: function(data){
			if(data == 1){
				if($(self).hasClass('btn-danger')){
					$(self).removeClass('btn-danger');
					$(self).addClass('btn-success').text('Activate');
				} else {
					$(self).removeClass('btn-success');
					$(self).addClass('btn-danger').text('Deactivate');
				}
			}
		}
	});
});
</script>
{{ HTML::script('js/alarms.js') }}
@stop