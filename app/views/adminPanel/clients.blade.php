@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent clients container col-xs-8">
		<div class="row col-xs-8">
			<a class="btn btn-primary new-entry" href="{{ URL::route('registerClient') }}">New Client</a>
		</div>
		<table id="clientsTable" class="table table-hover display">
			<thead>
				<th>Id</th>
				<th>Name</th>
				<th>Users</th>
				<th>Contact</th>
				<th>Edit</th>
				<th>Status</th>
			</thead>
			<tbody>
			@foreach($data as $customer)
				<tr>
					<td>{{$customer['id']}}</td>
					<td>{{$customer['name']}}</td>
					<td>
						@foreach($customer['user'] as $user)
							{{$user['name']}}<span class="comma">,</span>
						@endforeach
					</td>
					<td>{{$customer['contact_person']}}</td>
					<td>
						<a class="btn btn-primary" href="{{ URL::route('getClient', array('clientId'=>$customer['id'])) }}">Edit</a>
					</td>
					<td>
						@if($customer['active']==1)
							<button data-id="{{$customer['id']}}" type="button" class="status btn btn-danger">Deactivate</button>
						@else
							<button data-id="{{$customer['id']}}" type="button" class="status btn btn-success">Activate</button>
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
$('#clientsTable').dataTable();
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
		url: "clients/changeClientState",
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