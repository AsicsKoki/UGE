@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent col-xs-8">
		<a class="btn btn-primary" href="{{ URL::route('getRegisterHub') }}">New Hub</a>
		<table id="analyzersTable" class="table table-hover display">
			<thead>
				<th>id</th>
				<th>Name</th>
				<th>Edit</th>
				<th>Status</th>
			</thead>
			<tbody>
			@foreach($data as $hub)
				<tr>
					<td>{{$hub['id']}}</td>
					<td>{{$hub['name']}}</td>
					<td>
						<a class="btn btn-primary" href="{{ URL::route('getHub', array('hubId'=>$hub['id'])) }}">Edit</a>
					</td>
					<td>
						@if($hub['active']==1)
							<button data-id="{{$hub['id']}}" type="button" class="status btn btn-danger">Deactivate</button>
						@else;
							<button data-id="{{$hub['id']}}" type="button" class="status btn btn-success">Activate</button>
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
		url: "hubs/changeHubState",
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