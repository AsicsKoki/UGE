@extends('layouts/admin')
@section('main')
	<div>
	@include('partials.sidebar')
	</div>
	<div class="panelContent container col-md-8">
		<ul class="tab-margin nav nav-tabs" role="tablist">
			<li class="active"><a href="#section1">Measures</a></li>
			<li><a href="#section2">Measure Types in Analyzer Types</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active in fade" id="section1">
				<a class="btn btn-primary new-entry" href="{{ URL::route('registerMeasure') }}">New Measure Type</a>
				<table id="analyzersTable" class="table table-hover display">
					<thead>
						<th>id</th>
						<th>Name</th>
						<th>Unit</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
					@foreach($data as $measure)
						<tr>
							<td>{{$measure['id']}}</td>
							<td>{{$measure['name_en']}}</td>
							<td>{{$measure['unit']}}</td>
							<td>
								@if($measure['active']==1)
									<button data-link="changeMeasureTypeState" data-id="{{$measure['id']}}" type="button" class="status btn btn-danger">Deactivate</button>
								@else
									<button data-link="changeMeasureTypeState" data-id="{{$measure['id']}}" type="button" class="status btn btn-success">Activate</button>
								@endif
							</td>
							<td>
								<a class="btn btn-primary" href="{{ URL::route('getEditMeasureType', ['aid' => $measure['id']])}}">Edit</a>
								<a class="btn btn-danger" href="{{ URL::route('removeMeasureType', ['aid'=> $measure['id']]) }}">Delete</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="tab-pane in fade" id="section2">
				<a class="btn btn-primary new-entry" href="{{ URL::route('getRegisterMeasureTypeInAnalyzer') }}">New Measure Type in Analyzer Type</a>
				<table id="measureTypeInAnalyzerTable" class="table table-hover display">
					<thead>
						<th>Id</th>
						<th>Name</th>
						<th>Analyzer Type</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
					@foreach($measureTypeInAnalyzerType as $measureData)
						<tr>
							<td>{{$measureData['id']}}</td>
							<td>{{$measureData['measure_type']['name_en']}}</td>
							<td>{{$measureData['analyzer_type']['name']}}</td>
							<td>
								@if($measureData['active']==1)
									<button data-id="{{$measureData['id']}}" type="button" data-link="changeMeasureTypeInAnalyzerTypeState" class="status btn btn-danger">Deactivate</button>
								@else
									<button data-id="{{$measureData['id']}}" type="button" data-link="changeMeasureTypeInAnalyzerTypeState" class="status btn btn-success">Activate</button>
								@endif
							</td>
							<td>
								<a class="btn btn-primary" href="{{ URL::route('getEditMeasureTypeInAnalyzer', ['mid' => $measureData['id']])}}">Edit</a>
								<a class="btn btn-danger" href="{{ URL::route('removeMeasureTypeInAnalyzer', ['mid'=> $measureData['id']]) }}">Delete</a>
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
$('#analyzersTable').dataTable({
				  "aoColumns": [
					  null,
					  null,
					  null,
					  { "bSortable": false },
					  { "bSortable": false }
				  ]
				});
$('#measureTypeInAnalyzerTable').dataTable({
				  "aoColumns": [
					  null,
					  null,
					  null,
					  { "bSortable": false },
					  { "bSortable": false }
				  ]
				});
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
		url: "measuresManagement/" + $(self).attr('data-link'),
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