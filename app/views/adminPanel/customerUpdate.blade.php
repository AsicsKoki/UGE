@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
	<div class="panelContent">
		<div class='col-md-6'>
			{{ Former::open()->class('form-horizontal')->method('PUT')->enctype('multipart/form-data')->action(URL::route('putClient', ['clientId'=>$customer->id]))
				->rules([
						'name'           => 'required|min:3',
						'address'        => 'required',
						'contact_person' => 'required',
						'active'         => 'required',
					])}}
				{{Former::populate($customer)}}
					{{Former::text('name')->label('name')->placeholder('Client name')->class('form-control')}}
					{{Former::text('contact_person')->label('Contact person')->placeholder('Contact person')->class('form-control')}}
					{{Former::text('address')->label('Address')->placeholder('Client Adress')->class('form-control')}}
					{{Former::text('contact_phone')->label('Phone')->placeholder('Client Phone')->class('form-control')}}
					{{Former::text('contact_email')->label('Contact Email')->placeholder('Contact Email')->class('form-control')}}

					{{Former::select('active')->options([1=>'Active', 0=>'Inactive'])->label('Active')->class('form-control')}}
				{{Former::hidden()->name('_token')->value(csrf_token())}}
				{{Former::submit('Update customer')->class('form-control')}}
			{{ Former::close() }}
		</div>
		<div class='col-md-6'>
			<div class="users-list panelContent">
		<div class="form-group pull-right">
			<a href="{{URL::route('postNewUser')}}" class="btn btn-primary">Create New User</a>
		</div>
		<table class='table table-striped'>
			<thead>
				<th>Name</th>
				<th>Account Type</th>
				<th>Edit</th>
				<th>Delete</th>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->username}}</td>
						<td><a class="btn btn-primary" href="{{ URL::route('getUser', array('userId'=>$user->id)) }}">Edit</a></td>
						<td><a class="btn btn-danger" href="{{ URL::route('deleteUser', array('userId'=>$user->id)) }}">Delete</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
		</div>
	</div>
@stop
@section('moreScripts')
<script>
	$('div.users-list table').dataTable();
</script>
@stop