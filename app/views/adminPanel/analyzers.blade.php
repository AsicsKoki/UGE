@extends('layouts/main')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent">
		<a class="btn btn-primary" href="{{ URL::route('registerAnalyzer') }}">New Analyzer</a>
		<table id="analyzersTable" class="table table-hover display">
			<thead>
				<th>id</th>
				<th>Analyzer</th>
				<th>Hub</th>
				<th>Client</th>
				<th>Edit</th>
				<th>Status</th>
			</thead>
			<tbody>
			@foreach($data as $analyzer)
				<tr>
					<td>{{$analyzer['id']}}</td>
					<td>{{$analyzer['name']}}</td>
					<td>{{$analyzer['hub']['name']}}</td>
					<td>{{$analyzer['customer']['name']}}</td>
					<td>
						<a class="btn btn-primary" href="{{ URL::route('getAnalyzer', array('analyzerId'=>$analyzer['id'])) }}">Edit</a>
					</td>
					<td>
						@if($analyzer['active']==1)
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