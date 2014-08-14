@extends('layouts/main')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent">
		<a class="btn btn-primary" href="{{ URL::route('getRegisterAlarm') }}">New Alarm</a>
		<table id="analyzersTable" class="table table-hover display">
			<thead>
				<th>id</th>
				<th>Name</th>
				<th>Name</th>
				<th>Status</th>
			</thead>
			<tbody>
			@foreach($alarms as $alarm)
				<tr>
					<td>{{$alarm['id']}}</td>
					<td>{{$alarm['name_en']}}</td>
					<td>{{$alarm['name_sr']}}</td>
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
@stop