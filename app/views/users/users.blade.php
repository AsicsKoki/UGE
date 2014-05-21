@extends('layouts/main')
@section('main')
	<div class="users-list col-md-10">
		<table class='table table-striped'>
			<thead>
				<th>Name</th>
				<th>Username</th>
				<th>Address</th>
				<th>Contact Person</th>
				<th>Contact Address</th>
				<th>Contact Phone</th>
				<th>Contact SMS</th>
				<th>Edit</th>
				<th>Delete</th>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->username}}</td>
						<td>{{$user->address}}</td>
						<td>{{$user->contact_person}}</td>
						<td>{{$user->contact_address}}</td>
						<td>{{$user->contact_phone}}</td>
						<td>{{$user->contact_sms}}</td>
						<td><a class="btn btn-primary" href="{{ URL::route('getUser', array('userId'=>$user->id)) }}">Edit</a></td>
						<td><button type="button" class="btn btn-danger">Delete</button></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop
@section('moreScripts')
{{HTML::style('js/datatables/media/css/jquery.dataTables.css')}}
{{HTML::script('js/datatables/media/js/jquery.dataTables.js')}}
<script>
	$('div.users-list table').dataTable();
</script>
@stop