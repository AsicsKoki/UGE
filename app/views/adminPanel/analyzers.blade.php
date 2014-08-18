@extends('layouts/admin')
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
							<button data-id="{{$analyzer['id']}}" type="button" class="status btn btn-danger">Deactivate</button>
						@else
							<button data-id="{{$analyzer['id']}}" type="button" class="status btn btn-success">Activate</button>
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
		url: "analyzers/changeAnalyzerState",
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