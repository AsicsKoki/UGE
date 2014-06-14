@extends('layouts/main')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent">
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
</script>
@stop