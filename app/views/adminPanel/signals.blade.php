@extends('layouts/main')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent">
		<a class="btn btn-primary" href="{{ URL::route('getRegisterSignal') }}">New Signal</a>
		<table id="analyzersTable" class="table table-hover display">
			<thead>
				<th>id</th>
				<th>Name</th>
				<th>Name</th>
				<th>Status</th>
			</thead>
			<tbody>
			@foreach($signals as $signal)
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
</script>
@stop