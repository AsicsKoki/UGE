@extends('layouts/main')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent">
		<a class="btn btn-primary" href="{{ URL::route('registerMeasure') }}">New Measure</a>
		<table id="analyzersTable" class="table table-hover display">
			<thead>
				<th>id</th>
				<th>Name</th>
				<th>Unit</th>
				<th>Status</th>
			</thead>
			<tbody>
			@foreach($data as $measure)
				<tr>
					<td>{{$measure['id']}}</td>
					<td>{{$measure['name_en']}}</td>
					<td>{{$measure['unit']}}</td>
					<td>
						@if($measure['active']==1)
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