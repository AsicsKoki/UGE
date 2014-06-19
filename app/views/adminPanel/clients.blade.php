@extends('layouts/main')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent">
		<a class="btn btn-primary" href="{{ URL::route('registerClient') }}">New Client</a>
		<table id="clientsTable" class="table table-hover display">
			<thead>
				<th>id</th>
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
							{{$user['name']}}</td>
						@endforeach
					<td>{{$customer['contact_person']}}</td>
					<td>
						<a class="btn btn-primary" href="{{ URL::route('getClient', array('clientId'=>$customer['id'])) }}">Edit</a>
					</td>
					<td>
						@if($customer['active']==1)
							<button type="button" class="btn btn-danger">Deactivate</button>
						@else
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
	$('#clientsTable').dataTable();
</script>
@stop