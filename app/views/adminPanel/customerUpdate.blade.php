@extends('layouts/admin')
@section('main')
@include('partials.sidebar')
	<div class="panelContent container col-xs-8">
		<div class='row col-xs-8'>
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
				<div class="control-group submit-btn">
				{{Former::submit('Update customer')->class('form-control btn btn-info')}}
				</div>
			{{ Former::close() }}
		</div>
		<div class="row col-xs-10">
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
				@if (count($users))
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
							<td><a class="btn btn-danger" href="{{ URL::route('deleteUser', array('userId'=>$user->id)) }}">Delete</a></td>
						</tr>
					@endforeach
				@else
				<tr>
					<td colspan="9">There are no users currently assigned to this client</td>
				</tr>
				@endif
			</tbody>
		</table>
		</div>
	</div>
@stop
@section('moreScripts')
@stop