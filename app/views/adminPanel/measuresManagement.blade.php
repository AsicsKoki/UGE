@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent container col-md-8">
		<ul class="tab-margin nav nav-tabs" role="tablist">
			<li class="active"><a href="#section1">Measures</a></li>
			<li><a href="#section2">Measure types in analyzers</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active in fade" id="section1">
				<a class="btn btn-primary new-entry" href="{{ URL::route('registerMeasure') }}">New Measure</a>
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
									<button data-id="{{$measure['id']}}" type="button" class="status btn btn-danger">Deactivate</button>
								@else;
									<button data-id="{{$measure['id']}}" type="button" class="status btn btn-success">Activate</button>
								@endif
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane active in fade" id="section2">
				<a class="btn btn-primary new-entry" href="{{ URL::route('getRegisterMeasureTypeInAnalyzer') }}">New Measure</a>
				<table id="measureTypeInAnalyzerTable" class="table table-hover display">
					<thead>
						<th>Name</th>
						<th>Analyzer Type</th>
						<th>Active</th>
					</thead>
					<tbody>
					@foreach($measureTypeInAnalyzerType as $measureData)
						<tr>
							<td>{{$measureData['measure_type']['name_en']}}</td>
							<td>{{$measureData['analyzer_type']['name']}}</td>
							<td>
								@if($measureData['active']==1)
									<button data-id="{{$measureData['id']}}" type="button" class="status btn btn-danger">Deactivate</button>
								@else;
									<button data-id="{{$measureData['id']}}" type="button" class="status btn btn-success">Activate</button>
								@endif
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop
@section('moreScripts')
<script type="text/javascript">
$('#analyzersTable').dataTable();
$('#measureTypeInAnalyzerTable').dataTable();
$('.nav-tabs li a').click(function (e) {
	e.preventDefault()
	$(this).tab('show')
})
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
		url: "measuresManagement/changeMeasureTypeState",
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